<?php

class UsuarioController extends controller
{

    private $model;

	function __construct(){
        header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: *');
		header('Content-Type: application/json');
		$this->model = $this->model('usuario'); 
    }

    public function index(){
        if (!$this->isGet()) { header('location: '.URL_APP.'/'); }
        $usuarios = $this->model->all();

        echo json_encode(['usuarios' => $usuarios]);
    }

    public function habilitarUsuario(){
        if (!$this->isPost()) { header('location: '.URL_APP.'/'); }

        try{

            $data = $this->getJson();
            
            if($this->model->isExist($data->dni) != false){
                http_response_code(400);
                // http_response_code(421);
                echo json_encode(['data' => [
                    'text' => 'El documento ya esta registrado',
                    'code' => '400'
                ]]);
                return;
            }

            if ($this->model->addUsuarioHabilitado($data->dni)) {
                http_response_code(201);
                echo json_encode(['data' => 'Registo Exitoso']);
                return;
            }else{
                echo json_encode(['data' => 'Error al Registrar']);
                return;
            }

        }catch(Exception $e){

        } 


    } 

    public function desactivar(){
        if (!$this->isPut()) { header('location: '.URL_APP.'/'); }  
        $data = $this->getJson();
        $this->model->desactivarUsuario($data->id);
    }

    public function activar(){
        if (!$this->isPut()) { header('location: '.URL_APP.'/'); }  
        $data = $this->getJson();
        $this->model->activarUsuario($data->id);
    }

}

