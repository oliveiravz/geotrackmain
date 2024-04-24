<?php

namespace App\core;

class Controller{

    public function model($model){
        
        $modelName = "\\App\\models\\{$model}";

        if(class_exists($modelName)) {

            return new $modelName();
            
        }

        return false;
    }

    protected function getRequestBody(){
        $json = file_get_contents("php://input");
        $obj  = json_decode($json);
    
        return $obj;
    }

}