<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteSaveRequest;
use App\Http\Resources\ClienteResource;
use App\Repositories\ClienteRepository;

use Illuminate\Http\Request;

class ClienteController extends Controller {

    public function __construct(Cliente $cliente) {

        $this->cliente = $cliente;
    }

    /**************************************************/
    
    public function index(Request $request) {
        
        $clienteRepository = new ClienteRepository($this->cliente);

        if($request->has('atributos')) {

            $clienteRepository->selectAtributos($request->atributos);
        }

        if($request->has('filtro')) {

            $clienteRepository->filtro($request->filtro);
        }

        if($clientes = $clienteRepository->getResultado()) {   

            return new ClienteResource($clientes);            
        }

        return response()->json(['errors' => ['error' => 'Nenhum registro localizado.']], 404);
    }

    /**************************************************/
    
    public function store(ClienteSaveRequest $request) {

        if($store = $this->cliente->create($request->all())) {

            return response()->json([ 'errors' => [], 'msg' => 'Registro criado com sucesso!'], 201);
        }

        return response()->json(['errors' => ['error' => 'Erro ao criar o registro']], 404);        
    }

    /**************************************************/
    
    public function update(ClienteSaveRequest $request, $cliente) {
        
        if($update = $this->cliente->find($cliente)) {            

            if($update->update($request->all())) {

                return response()->json([ 'errors' => [], 'msg' => 'Registro atualizado com sucesso!'], 200);
            }       

            return response()->json(['errors' => ['error' => 'Erro ao gravar o registro']], 404);
        }

        return response()->json(['errors' => ['error' => 'O registro não foi localizado.']], 404);        
    }

    /**************************************************/
    
    public function destroy($id) {

        if($cliente = $this->cliente->find($id)) {      
            
            if($cliente->delete()) {

                return response()->json(['msg' => 'Registro removido com sucesso!'], 200);
            }
            
            return response()->json([ 'errors' => ['error' => 'Erro ao excluir o registro']], 404);
        }

        return response()->json(['errors' => ['erro' => 'O registro não foi localizado.']], 404);
    }
}