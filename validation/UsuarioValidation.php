<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 08:31 PM
 */

namespace App\Validation;
use core\core;

class UsuarioValidation
{
    private static $data = [];

    public static function validate($post,$update = false){

        if($update){

            $key = 'idusuario';
            if(empty($post[$key]) || !isset($post[$key])){

                UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    UsuarioValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    UsuarioValidation::$data['error'][] =  "Usuario incorrecto";
                }
            }

            $key = 'idestatus';
            if(empty($post[$key]) || !isset($post[$key])){

                UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    UsuarioValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    UsuarioValidation::$data['error'][] =  "Usuario incorrecto";
                }
            }

        }

        $key = 'nombre';
        if(empty($post[$key]) || !isset($post[$key])){

            UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                UsuarioValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 65 ){
                UsuarioValidation::$data['error'][] =  "El campo $key debe contener como maximo 65 caracteres";
            }
        }

        $key = 'apellidos';
        if(empty($post[$key]) || !isset($post[$key])){

            UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                UsuarioValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 65 ){
                UsuarioValidation::$data['error'][] =  "El campo $key debe contener como maximo 65 caracteres";
            }
        }

        $key = 'nickname';
        if(empty($post[$key]) || !isset($post[$key]) ){

            UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                UsuarioValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 65 ){
                UsuarioValidation::$data['error'][] =  "El campo $key debe contener como maximo 65 caracteres";
            }
        }

        $key = 'usuario';
        if(empty($post[$key]) || !isset($post[$key]) ){

            UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                UsuarioValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 65 ){
                UsuarioValidation::$data['error'][] =  "El campo $key debe contener como maximo 65 caracteres";
            }
        }

        $key = 'password';
        if(empty($post[$key]) || !isset($post[$key])){

            UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                UsuarioValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 65 ){
                UsuarioValidation::$data['error'][] =  "El campo $key debe contener como maximo 65 caracteres";
            }
        }

        $key = 'idperfil';
        if(empty($post[$key]) || !isset($post[$key])){

            UsuarioValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(!is_numeric($value) ){
                UsuarioValidation::$data['error'][] = "El campo Perfil debe se numerico";
            }
            if($value == 0 ){
                UsuarioValidation::$data['error'][] =  "Seleccione un perfil";
            }
        }

        return UsuarioValidation::$data;

    }


}