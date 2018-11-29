<?php

class HomeController extends Controller
{
    private $loginModel;
   
	function __construct(){
        $this->loginModel = $this->model('login'); 
        if (Security::auth('')) {
            header('location: '.URL_APP.'/panel');
        } 
    }

    public function index(){
    	
        $this->view('home/home');
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['dni'], $_POST['password'])) {

                #limpian los datos
                $documento = $this->cleanData($_REQUEST['dni']);
                $password = $this->cleanData($_REQUEST['password']);
                $estado = Security::login( $documento, $password );

                switch ($estado) {
                    case 'access':
                        header('location: '.URL_APP.'/panel');
                    break;

                    case 'limit_attempts':
                        echo "Limite de intentos";
                        // header('location: '.URL_APP.'/panel');
                    break;
                    
                    default:
                        $this->view('home/home',[
                            'error' => $estado
                        ]);
                    break;
                }
                
            }
        }else{
            header('location: '.URL_APP.'/');
        }
    }

    public function registrar(){
  
        if(isset($_POST["dni"])){
            if(isset($_POST["tipo_documento"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["password"]) && $_POST["password"] == $_POST["password2"]){
                $info_usuario = array(
                    'tipo_documento'=> $this->cleanData($_POST["tipo_documento"]),
                    'dni'=> $this->cleanData($_POST["dni"]),
                    'nombre'=> $this->cleanData($_POST["nombre"]),
                    'apellido'=> $this->cleanData($_POST["apellido"]),
                    'telefono'=> $this->cleanData($_POST["telefono"]),
                    'email'=> $this->cleanData($_POST["email"]), 
                    'password'=> $this->cleanData($_POST["password"])
                );
                $respuesta =  $this->loginModel->registrar($info_usuario);
                $data = $this->loginModel->all_tipo_documento();
                $this->view('home/registro',$data,$respuesta);
            }else { 
            //devolver diferente respuesta
            $respuesta = "<script>swal({
				type: 'error',
				title: 'Opps..',
				text: 'Error en lo datos del registro',
              })</script>";
              $this->view('home/registro',null, $respuesta);
            }
        }else{
            $data = $this->loginModel->all_tipo_documento();
            $this->view('home/registro',$data);
        }
          
    }




}




