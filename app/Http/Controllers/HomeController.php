<?php

namespace App\Http\Controllers;

use App\Models\Museo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function museoIndex(){
        $data = Museo::all();
        return view('museo.index', ['data' => $data]);
    }

    public function museoCreate(){
        return view('museo.create');
    }

    public function museoStore(Request $request){
        $reglas = [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:1500',
            'fecha' => 'required|date',
            'imagen' => 'required|image|max:5120',
        ];
        $mensajes = [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe tener un formato válido.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
            'imagen.required' => 'La imagen es requerida.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede superar los 5MB de tamaño.',
        ];
        $request->validate($reglas, $mensajes);
        $data['titulo'] = $request->titulo;
        $data['descripcion'] = $request->descripcion;
        $data['fecha'] = $request->fecha;
        $museo = Museo::create($data);
        $this->generarQR($museo->id);
        if (isset($request['imagen'])){
            $museo->addMediaFromRequest('imagen')->toMediaCollection();
        }
        return Redirect::to('museo');
    }

    public function museoEdit($id){
        $data = Museo::findOrFail($id);
        return view('museo.edit', ['data' => $data]);
    }

    public function museoUpdate(Request $request, $id){
        // Reglas de validación
        $reglas = [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:1500',
            'fecha' => 'required|date',
            'imagen' => 'required|image|max:5120',
        ];
        $mensajes = [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe tener un formato válido.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede superar los 1500 caracteres.',
            'imagen.required' => 'La imagen es requerida.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede superar los 5MB de tamaño.',
        ];
        $request->validate($reglas, $mensajes);
        $data['titulo'] = $request->titulo;
        $data['descripcion'] = $request->descripcion;
        $data['fecha'] = $request->fecha;
        $museo = Museo::findOrFail($id);
        if (isset($request['imagen'])){
            $museo->clearMediaCollection();
            $museo->addMediaFromRequest('imagen')->toMediaCollection();
        }
        $museo->update($data);
        return Redirect::to('museo');
    }

    public function museoEliminar($id){
        $data = Museo::findOrFail($id);
        $data->clearMediaCollection();
        $data->delete();
        return response()->json('Eliminado');
    }

    public function generarQR($id)
    {
        $museo = Museo::findOrFail($id);
        $nombre = str_replace(' ', '', $museo->titulo);
        $urlMuseo = url('ver/'.strtolower($nombre).'/'.$id);
        $nombre = $id.'-'.strtolower($nombre);
        $nombreArchivo = $nombre.'.svg';
        $rutaArchivo = public_path('img/' . $nombreArchivo);
        $rutaMuseo = route('museo.generarqr', $id);
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }
        $renderer = new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new \BaconQrCode\Writer($renderer);
        $codigoQR = $writer->writeString($urlMuseo);
        file_put_contents($rutaArchivo, $codigoQR);

        $museo->update(['url_imagen'=>asset('img/'.$nombreArchivo)]);
    }
}
