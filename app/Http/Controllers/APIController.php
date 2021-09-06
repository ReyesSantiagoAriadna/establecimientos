<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //metodo para obtener todas las categorias
    public function categorias(){
        $categorias = Categoria::all();

        return response()->json($categorias);
    }

    //muestra los establecimientos d ela categoria en especifico
    public function categoria(Categoria $categoria){
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)
                            ->with('categoria')
                            ->get();
        return response()->json($establecimientos);
    }
}
