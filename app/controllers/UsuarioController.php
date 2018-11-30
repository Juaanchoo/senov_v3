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

    public function getHabilitados(){
        if (!$this->isGet()) { header('location: '.URL_APP.'/'); }
        $habilitados = $this->model->get_Habilitados();

        echo json_encode(['habilitados' => $habilitados]);
    }

    // public function getNoRegistrados(){
    //     if (!$this->isGet()) { header('location: '.URL_APP.'/'); }
    //     $usuarios = $this->model->all();
    //     $habilitados = $this->model->get_Habilitados();

    //     foreach ($usuarios as $us) {
    //         $docsus [] = $us->documento;
    //     }
    //     foreach ($habilitados as $ha) {
    //         $docsha [] = $ha->documento;
    //     }

    //     for ($i=0; $i < sizeof($habilitados) ; $i++) { 
    //         if($docsus != $docsha)
    //         {
    //             $noregistro = $docsha;
    //             echo json_encode(['noregistro' => $noregistro);
    //         }
    //     }
    // }

    public function habilitarUsuarios(){
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
    
    public function habilitarUsuario()
    {
        if (!$this->isPut()) { header('location: '.URL_APP.'/'); }
        $data = $this->getJson();
        $this->model->habilitar_Usuario($data->id);
    }

    public function deshabilitarUsuario()
    {
        if (!$this->isPut()) { header('location: '.URL_APP.'/'); }
        $data = $this->getJson();
        $this->model->deshabilitar_Usuario($data->id);
    }

    public function desactivar(){
        if (!$this->isPut()) { header('location: '.URL_APP.'/'); }  
        $data = $this->getJson();
        $this->model->desactivar_Usuario($data->id);
    }

    public function activar(){
        if (!$this->isPut()) { header('location: '.URL_APP.'/'); }  
        $data = $this->getJson();
        $this->model->activar_Usuario($data->id);
    }

}

