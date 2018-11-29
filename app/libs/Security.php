<?php 

// 0 -> ok
// 'text' -> error
// 1 -> 
class Security extends Controller
{
    public static function login($documento,$password){
        include_once '../app/models/LoginModel.php';
        $model = new LoginModel();

        $user = $model->show($documento);

        if ($user != false) {

            if ($user->password == $password) {

                if ($model->resetIntentos($user->documento)) {
                    unset($user->password);
                    $permisos = $model->permisos_user($user->documento);
                    $user->permiso = $permisos->cargo;
                    Security::create_auth($user);
                    unset($user);
                } else {
                    return '<b>Error 500: </b> se produjo un error en el lado del servidor';
                }
                
    
            } else {
                $a = $model->sumarIntento($user->documento);

                    if ($a) {
                        if ($a->intentos < 3) {
                            unset($user);
                            return 'La contraseña es incorrecta. Intentelo de nuevo.';
                        } else {
                            unset($user);
                            return 'limit_attempts';
                        }
                        
                    }else{
                        unset($user);
                        return 'Error de la Database';
                    }

                unset($user);
                return 'La contraseña es incorrecta.';
            }

        }else{
            return 'El Usuario no existe.';
        }
        

        return 'access';
                

    }

    public static function auth($condicio = ''){
        try{
            switch ($condicio) {
                case '!':
                    if (!isset($_SESSION['user']->permiso)) {
                        return true;
                    }else{
                        return false;
                    }
                break;
                
                default:
                    if (isset($_SESSION['user']->permiso)) {
                        return true;
                    }else{
                        return false;
                    }
                break;
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
        
      
    }

    public static function create_auth($user = null){
    	if (!empty($user)) {
    		$_SESSION['user'] = $user;
    	}
    }


}