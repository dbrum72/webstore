<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository {

    public function __construct(Model $model) {

        $this->model = $model;
    }

    public function selectAtributosRelacao($atributos) {

        $this->model = $this->model->with($atributos);
    }

    public function selectAtributos($atributos) {

        $this->model = $this->model->selectRaw($atributos);
    }

    public function selectWith($with) {

        $withs = explode(',', $with);

        foreach($withs as $key => $with) {

            $this->model = $this->model->with($with);
        }        
    }

    public function filtro($filtros) {

        $filtros = explode(';', $filtros);

        foreach ($filtros as $key => $condicao) {

            $parametros = explode(':', $condicao);

            $this->model = $this->model->orWhere($parametros[0], $parametros[1], $parametros[2]);
        }
    }

    public function getResultado() {

        return $this->model->orderByRaw('updated_at DESC')->get();
    }
}