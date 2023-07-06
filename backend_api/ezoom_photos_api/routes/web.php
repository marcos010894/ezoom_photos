<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return ['status' => 'Ok'];
});


// Route::get('/packs', function (Request $request) {
//     // dd($request->headers->all());
//     $response = new \Illuminate\Http\Response(json_encode(['msg' => 'rota de foto']));
//     $response->headers->set('Content-Type', 'application/json');
//     $response->headers->set('Accept', 'application/json');
//     $response->headers->set('Authorization', 'Bearer your_token');

//     return $response;
// });


// Route::get('/packsAll', function () {
//     // dd($request->headers->all());
//     return App\Models\Pack::all();
// });
