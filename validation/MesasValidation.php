<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 08:31 PM
 */

namespace App\Validation;

class MesasValidation
{
    private static $data = [];

    public static function validate($post,$update = false){

        if($update){

            $key = 'idmesas';
            if(empty($post[$key]) || !isset($post[$key])){

                MesasValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    MesasValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    MesasValidation::$data['error'][] =  "Usuario incorrecto";
                }
            }

            $key = 'idestatus';
            if(empty($post[$key]) || !isset($post[$key])){

                MesasValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    MesasValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    MesasValidation::$data['error'][] =  "Mesa incorrecta";
                }
            }

        }

        $key = 'nombre';
        if(empty($post[$key]) || !isset($post[$key])){

            MesasValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                MesasValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 65 ){
                MesasValidation::$data['error'][] =  "El campo $key debe contener como maximo 65 caracteres";
            }
        }

        $key = 'idestatus';
        if(empty($post[$key]) || !isset($post[$key])){

            MesasValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(!is_numeric($value) ){
                MesasValidation::$data['error'][] = "El campo $key debe se numerico";
            }
            if($value == 0 ){
                MesasValidation::$data['error'][] =  "Mesa incorrecta";
            }
        }

        return MesasValidation::$data;

    }


}