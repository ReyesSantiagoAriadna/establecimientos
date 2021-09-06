<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller{

    public function store(Request $request)
    {
        //leer la imagen
         $ruta_imagen = $request->file('file')->store('establecimientos','public');

        //reSIZE A LA IMAGEN
        $image = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800,450);
        $image->save();

        //almacenar con modelo
        $imageDB = new Imagen;
        $imageDB->id_establecimientos = $request['uuid'];
        $imageDB->ruta_imagen = $ruta_imagen;
        $imageDB->save();

        //retornar respuesta
        $respuesta = [
            'archivo' => $ruta_imagen
        ];

        return response()->json($respuesta);
    }


    public function destroy(Request $request)
    {
        $imagen = $request->get('imagen');

        if(File::exists('storage/'.$imagen)){
            File::delete('storage/'.$imagen);
        }

        $respuesta  = [
            'mensaje' => 'Imagen eliminado',
            'imagen' => $imagen
        ];

        //Imagen::where('ruta_imagen', '=', $imagen)->delete();
        $imagenEliminar = Imagen::where('ruta_imagen','=',$imagen)->firstOrFail();
        Imagen::destroy($imagenEliminar->id);

        return response()->json($request);
    }
}
