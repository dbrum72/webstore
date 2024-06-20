<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\CategoriaSaveRequest;
use App\Http\Resources\CategoriaResource;
use App\Repositories\CategoriaRepository;
use Illuminate\Http\Request;

class CategoriaController extends Controller {

    public function __construct(Categoria $categoria) {

        $this->categoria = $categoria;
    }
    
    public function index(Request $request) {

        $categoriaRepository = new CategoriaRepository($this->categoria);

        if($request->has('atributos')) {

            $categoriaRepository->selectAtributos($request->atributos);
        }

        if($request->has('with')) {

            $categoriaRepository->selectWith($request->with);
        }        

        if($request->has('filtro')) {

            $categoriaRepository->filtro($request->filtro);
        }

        if($categorias = $categoriaRepository->getResultado()) {   

            return new CategoriaResource($categorias);            
        }

        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    
    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    public function destroy(Categoria $categoria)
    {
        //
    }
}
