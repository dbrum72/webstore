<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Requests\ProdutoSaveRequest;
use App\Http\Resources\ProdutoResource;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;

class ProdutoController extends Controller {

    public function __construct(Produto $produto) {

        $this->produto = $produto;
    }

    /********************************************************************************************************/
    
    public function index(Request $request) {

        $produtoRepository = new ProdutoRepository($this->produto);

        if($request->has('atributos')) {

            $produtoRepository->selectAtributos($request->atributos);
        }

        if($request->has('with')) {

            $produtoRepository->selectWith($request->with);
        }

        if($request->has('filtro')) {

            $produtoRepository->filtro($request->filtro);
        }

        if($produtos = $produtoRepository->getResultado()) {   

            return new ProdutoResource($produtos);            
        }

        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    /********************************************************************************************************/

    public function store(ProdutoSaveRequest $request) {

        if($store = $this->produto->create($request->all())) {

            return response()->json([ 'errors' => [], 'msg' => 'Registro criado com sucesso!'], 201);
        }

        return response()->json(['errors' => ['error' => 'Erro ao criar o registro']], 404);
    }

    /********************************************************************************************************/

    public function update(ProdutoSaveRequest $request, $produto) {

        if($update = $this->produto->find($produto)) {

            if($update->update($request->all())) {

                return response()->json([ 'errors' => [], 'msg' => 'Registro atualizado com sucesso!'], 200);
            }       

            return response()->json(['errors' => ['error' => 'Erro ao gravar o registro']], 404);
        }

        return response()->json(['errors' => ['error' => 'O registro não foi localizado.']], 404);

    }

    /********************************************************************************************************/

    public function destroy($produto) {

        if($destroy = $this->produto->find($produto)) {      
            
            if($destroy->delete()) {

                return response()->json(['msg' => 'Registro removido com sucesso!'], 200);
            }
            
            return response()->json([ 'errors' => ['error' => 'Erro ao excluir o registro']], 404);
        }

        return response()->json(['errors' => ['erro' => 'O registro não foi localizado.']], 404);
    }
}
