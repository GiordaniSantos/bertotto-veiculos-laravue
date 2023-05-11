<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{

    public function __construct($model){
        $this->model = $model;
    }

    public function selectAtributosRelacionados($atributos){
        $this->model = $this->model->with($atributos);
    }

    public function filtro($filtros){
        $filtros = explode(';', $filtros);
            foreach($filtros as $key => $condicao){
                $c = explode(':', $condicao);
                $this->model =  $this->model->where($c[0], $c[1], $c[2]);
                //a query está sendo montada
            }
    }

    public function getResultado(){
        return $this->model->get();
    }
}

?>