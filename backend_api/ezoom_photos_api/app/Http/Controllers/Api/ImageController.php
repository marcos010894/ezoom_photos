<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }
    public function delete($id)
    {
        $image = $this->image->find($id);

        if (!$image) {
            return response()->json(['error' => 'Imagem não encontrada'], 404);
        }

        $image->delete();

        return response()->json(['success' => 'Imagem excluída com sucesso']);
    }
}
