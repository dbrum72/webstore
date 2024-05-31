<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Resources\ProdutoResource;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;

class ProdutoController extends Controller {

    public function __construct(Produto $produto) {

        $this->produto = $produto;
    }
    
    public function index(Request $request) {

        $produtoRepository = new ProdutoRepository($this->produto);

        if($request->has('atributos')) {

            $produtoRepository->selectAtributos($request->atributos);
        }

        if($request->has('filtro')) {

            $produtoRepository->filtro($request->filtro);
        }

        if($produtos = $produtoRepository->getResultado()) {   

            return new ProdutoResource($produtos);            
        }

        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    public function store(Request $request) {

        if($produto = $this->produto->create($request->all())) {

            return response()->json([ 'errors' => [], 'msg' => 'Registro criado com sucesso!'], 201);
        }

        return response()->json(['errors' => ['error' => 'Erro ao criar o registro']], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
