<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 08:31 PM
 */

namespace App\Validation;
use core\core;

class ClienteValidation
{
    private static $data = [];

    public static function validate($post,$update = false){

        if($update){

            $key = 'idcliente';
            if(empty($post[$key]) || !isset($post[$key])){

                ClienteValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    ClienteValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    ClienteValidation::$data['error'][] =  "Cliente incorrecto";
                }
            }

            $key = 'idestatus';
            if(empty($post[$key]) || !isset($post[$key])){

                ClienteValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    ClienteValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    ClienteValidation::$data['error'][] =  "Cliente incorrecto";
                }
            }

        }

        $key = 'nombre';
        if(empty($post[$key]) || !isset($post[$key])){

            ClienteValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                ClienteValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 75 ){
                ClienteValidation::$data['error'][] =  "El campo $key debe contener como maximo 75 caracteres";
            }
        }




        return ClienteValidation::$data;

    }


}