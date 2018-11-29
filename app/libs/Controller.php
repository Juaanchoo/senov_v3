<?php

class Controller 
{
    protected function view($v,$data = [],$respuesta=null){


        if(file_exists('../app/views/'.strtolower($v).'.php')){
            include_once '../app/views/all/header.php';
            #--
                if (isset($_SESSION['user'])) { require_once sidebar_p1;}
            #--
            include_once '../app/views/'.strtolower($v).'.php';
            #--
                if (isset($_SESSION['user'])) { require_once sidebar_p2;}
            #--
            include_once '../app/views/all/footer.php';
        }else{
            die('<b>Message:</b> 404 - View not found.');
        }
    }
//ya weee porfavoooo >:v

    protected function model($m){
        $m = ucwords($m).'Model';
        if(file_exists('../app/models/'.$m.'.php')){
            include_once '../app/models/'.$m.'.php';
            return new $m;
        }else{
            die('<b>Message:</b> 404 - Model not found.');
        }
    }

    protected function cleanData($data){
        $data = trim($data);
        $data = filter_var($data,FILTER_SANITIZE_STRING);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
       
        return $data;
    }

    protected function isAjax(){
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    protected function isPost(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isGet(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function isPut(){
        return $_SERVER['REQUEST_METHOD'] == 'PUT';
    }

    protected function getJson(){
        return json_decode(file_get_contents('php://input'));
    }


}
