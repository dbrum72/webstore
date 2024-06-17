<?php

namespace App\Http\Controllers;

use App\Models\PedidoProduto;
use App\Http\Requests\PedidoProdutoSaveRequest;
use App\Http\Resources\PedidoProdutoResource;
use App\Repositories\PedidoProdutoRepository;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller {

    public function __construct(PedidoProduto $pedido_produto) {

        $this->pedido_produto = $pedido_produto;
    }

    /********************************************************************************************************/

    public function index(Request $request) {
        
        $pedido_produtoRepository = new PedidoProdutoRepository($this->pedido_produto);

        if($request->has('atributos')) {

            $pedido_produtoRepository->selectAtributos($request->atributos);
        }

        if($request->has('with')) {

            $pedido_produtoRepository->selectWith($request->with);
        }

        if($request->has('filtro')) {

            $pedido_produtoRepository->filtro($request->filtro);
        }

        if($pedidos = $pedido_produtoRepository->getResultado()) {   

            return new PedidoProdutoResource($pedidos);            
        }

        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    /********************************************************************************************************/

    public function store(PedidoProdutoSaveRequest $request) {

        if($store = $this->pedido_produto->create($request->all())) {

            return response()->json([ 'errors' => [], 'msg' => 'Registro criado com sucesso!'], 201);
        }

        return response()->json(['errors' => ['error' => 'Erro ao criar o registro']], 404); 
    }

    /********************************************************************************************************/

    public function update(PedidoProdutoSaveRequest $request, $pedido_produto) {
        
        if($update = $this->pedido_produto->find($pedido_produto)) {

            if($update->update($request->all())) {

                return response()->json([ 'errors' => [], 'msg' => 'Registro atualizado com sucesso!'], 200);
            }

            return response()->json(['errors' => ['error' => 'Erro ao gravar o registro']], 404);
        }
        
        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    /********************************************************************************************************/
    
    public function destroy($pedido_produto) {

        if($destroy = $this->pedido_produto->find($pedido_produto)) {      
            
            if($destroy->delete()) {

                return response()->json(['msg' => 'Registro removido com sucesso!'], 200);
            }
            
            return response()->json([ 'errors' => ['error' => 'Erro ao excluir o registro']], 404);
        }

        return response()->json(['errors' => ['erro' => 'O registro não foi localizado.']], 404);
    }
}
