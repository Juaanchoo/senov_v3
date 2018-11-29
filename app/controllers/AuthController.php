<?php

class AuthController extends controller
{
    private $model;

	function __construct(){
		$this->model = $this->model('login'); 
    }

    public function index(){
        
        
    }

    private function addIntento($id){
        $user = $this->model->sumarIntento($id);
        if ($user) {
            if ($user->intentos < 3) {
                $error = [
                    'error' => 'La contraseña es incorrecta. Intentelo de nuevo.'
                ];
                $this->view('home/home',$error);
            } else {
                echo 'Olvido su contraseña? trate de restablecerla.';
            }
            
        }else{
            echo 'Error de la Database';
        }
    }
}
