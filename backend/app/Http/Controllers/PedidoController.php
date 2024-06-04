<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\PedidoSaveRequest;
use App\Http\Resources\PedidoResource;
use App\Repositories\PedidoRepository;
use Illuminate\Http\Request;

class PedidoController extends Controller {

    public function __construct(Pedido $pedido) {

        $this->pedido = $pedido;
    }

    /********************************************************************************************************/

    public function index(Request $request) {

        $pedidoRepository = new PedidoRepository($this->pedido);

        if($request->has('atributos')) {

            $pedidoRepository->selectAtributos($request->atributos);
        }

        if($request->has('filtro')) {

            $pedidoRepository->filtro($request->filtro);
        }

        if($pedidos = $pedidoRepository->getResultado()) {   

            return new PedidoResource($pedidos);            
        }

        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    /********************************************************************************************************/

    public function store(PedidoSaveRequest $request) {

        if($store = $this->pedido->create($request->all())) {

            return response()->json([ 'errors' => [], 'msg' => 'Registro criado com sucesso!'], 201);
        }

        return response()->json(['errors' => ['error' => 'Erro ao criar o registro']], 404); 
    }

    /********************************************************************************************************/

    public function update(PedidoSaveRequest $request, $pedido) {

        if($update = $this->pedido->find($pedido)) {

            if($update->update($request->all())) {

                return response()->json([ 'errors' => [], 'msg' => 'Registro atualizado com sucesso!'], 200);
            }       

            return response()->json(['errors' => ['error' => 'Erro ao gravar o registro']], 404);
        }
    }

    /********************************************************************************************************/
    
    public function destroy($pedido) {

        if($destroy = $this->pedido->find($pedido)) {      
            
            if($destroy->delete()) {

                return response()->json(['msg' => 'Registro removido com sucesso!'], 200);
            }
            
            return response()->json([ 'errors' => ['error' => 'Erro ao excluir o registro']], 404);
        }

        return response()->json(['errors' => ['erro' => 'O registro não foi localizado.']], 404);
    }
}
