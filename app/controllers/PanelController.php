<?php

class PanelController extends controller
{

    function __construct(){
        if (Security::auth('!')) {
            header('location: '.URL_APP.'/');
        }

		 
    }

    public function index(){
        $this->view('main');
    }

    public function main(){
        $this->view('main');
    }

    public function usuario(){
        $this->view('admin/habilitar_user');
    }

    public function estado_novedad(){
        $this->view('admin/estado_novedad');
    }

    public function salir(){
        session_destroy();
        header('location: '.URL_APP.'/');
    }


}