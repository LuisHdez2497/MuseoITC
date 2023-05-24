<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/', 'HomeController@museoIndex')->name('home');

Route::get('/museo', 'HomeController@museoIndex')->name('museo.index');
Route::get('/museo/crear', 'HomeController@museoCreate')->name('museo.create');
Route::post('/museo/crear', 'HomeController@museoStore')->name('museo.store');
Route::get('/museo/editar/{id}', 'HomeController@museoEdit')->name('museo.edit');
Route::patch('/museo/editar/{id}', 'HomeController@museoUpdate')->name('museo.update');
Route::get('/museo/eliminar/{id}', 'HomeController@museoEliminar')->name('museo.delete');
Route::get('/museo/generarqr/{id}', 'HomeController@generarQR')->name('museo.generarqr');

Route::get('/ver/{titulo}/{id}', function ($titulo, $id){
    $museo = \App\Models\Museo::findOrFail($id);
    $data['titulo'] = $museo->titulo;
    $data['descripcion'] = $museo->descripcion;
    setlocale(LC_ALL, 'es_MX.UTF-8');
    $fechaObj = new DateTime($museo->fecha);
    $fechaFormateada = strftime('%d/%B/%Y', $fechaObj->getTimestamp());
    $data['fecha'] = $fechaFormateada;
    $data['url'] = $museo->url_imagen;

    $museo->getFirstMedia();
    if (count($museo->media) > 0){
        $path = URL::to('/').'/img/'.$museo->media[0]->id.'/'.$museo->media[0]->file_name;
    }else{
        $path = URL::to('/').'/img/torneos/logo-itc.svg';
    }

    $data['path'] = $path;

    return view('vista', ['data' => $data]);
})->name('verMuseo');
