<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pack;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackController extends Controller
{
    private $pack;
    private $image;

    public function __construct(Pack $pack, Image $image)
    {
        $this->pack = $pack;
        $this->image = $image;
    }

    public function index()
    {
        $packs = $this->pack->all();

        $packs->transform(function ($pack) {
            $pack->images = $this->image->where('id_pack', $pack->id)->get();
            return $pack;
        });

        return response()->json($packs)->header('Access-Control-Allow-Origin', '*');
    }

    public function show($id)
    {
        $pack = $this->pack->find($id);

        if (!$pack) {
            return response()->json(['error' => 'Pacote não encontrado'], 404);
        }
        $pack->images = $this->image->where('id_pack', $pack->id)->get();

        return response()->json($pack)->header('Access-Control-Allow-Origin', '*');
    }

    public function save(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->json()->all();
            $title = $data['title'];
            $description = $data['description'];
            $images = $data['images'];


            $pack = $this->pack->create([
                'title' => $title,
                'description' => $description,
            ]);


            foreach ($images as $url) {
                $this->image->create([
                    'url_img' => $url,
                    'id_pack' => $pack->id,
                ]);
            }

            DB::commit();

            return response()->json($pack);
        } catch (\Exception $e) {
            // Rollback da transação em caso de erro
            DB::rollback();

            return response()->json(['error' => 'Ocorreu um erro ao criar o pacote.'], 500);
        }
    }

    public function delete($id)
    {
        $pack = $this->pack->find($id);

        if (!$pack) {
            return response()->json(['error' => 'pack não encontrada'], 404);
        }
        $pack->delete();

        return response()->json(['success' => 'Pack excluído com sucesso']);
    }

    public function put(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->json()->all();
            $title = $data['title'];
            $description = $data['description'];
            $images = $data['images'];

            $pack = $this->pack->find($id);

            if (!$pack) {
                return response()->json(['error' => 'Pack não encontrado'], 404);
            }

            $pack->title = $title;
            $pack->description = $description;
            $pack->save();

            if ($images) {


                foreach ($images as $url) {
                    $this->image->create([
                        'url_img' => $url,
                        'id_pack' => $id,
                    ]);
                }
            }

            // Commit da transação
            DB::commit();

            return response()->json($pack);
        } catch (\Exception $e) {
            // Rollback da transação em caso de erro
            DB::rollback();

            return response()->json(['error' => 'Ocorreu um erro ao atualizar o pacote.'], 500);
        }
    }
}
