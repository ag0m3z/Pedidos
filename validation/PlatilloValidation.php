<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 08:31 PM
 */

namespace App\Validation;
use core\core;

class PlatilloValidation
{
    private static $data = [];

    public static function validate($post,$update = false){

        if($update){

            $key = 'idplatillo';
            if(empty($post[$key]) || !isset($post[$key])){

                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    PlatilloValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    PlatilloValidation::$data['error'][] =  "Cliente incorrecto";
                }
            }

            $key = 'idestatus';
            if(empty($post[$key]) || !isset($post[$key])){

                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";

            }else{
                $value = $post[$key];
                if(!is_numeric($value) ){
                    PlatilloValidation::$data['error'][] = "El campo $key debe se numerico";
                }
                if($value == 0 ){
                    PlatilloValidation::$data['error'][] =  "Cliente incorrecto";
                }
            }

        }


        $key = 'nombre';
        if(empty($post[$key]) || !isset($post[$key])){

            PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";

        }else{
            $value = $post[$key];
            if(strlen($value) < 3 ){
                PlatilloValidation::$data['error'][] = "El campo $key debe contener como minimo 3 caracteres";
            }
            if(strlen($value) > 100 ){
                PlatilloValidation::$data['error'][] =  "El campo $key debe contener como maximo 100 caracteres";
            }
        }

        $key = 'idcategoria';
        if(!is_numeric($post[$key])){
            PlatilloValidation::$data['error'][] = "El Campo $key es Obligatorio";
        }else{

            $value = $post[$key];
            if($value <= 0 ){
                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";
            }
        }

        $key = 'idsubcategoria';
        if(!is_numeric($post[$key])){
            PlatilloValidation::$data['error'][] = "El Campo $key es Obligatorio";
        }else{

            $value = $post[$key];
            if($value <= 0 ){
                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";
            }
        }

        $key = 'unidad_medida';
        if(!is_numeric($post[$key])){
            PlatilloValidation::$data['error'][] = "El Campo $key es Obligatorio";
        }else{

            $value = $post[$key];
            if($value <= 0 ){
                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";
            }
        }

        $key = 'piezas';
        if(!is_numeric($post[$key])){
            PlatilloValidation::$data['error'][] = "El Campo $key es Obligatorio";
        }else{

            $value = $post[$key];
            if($value <= 0 ){
                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";
            }
        }

        $key = 'idestatus';
        if(!is_numeric($post[$key])){
            PlatilloValidation::$data['error'][] = "El Campo $key es Obligatorio";
        }else{

            $value = $post[$key];
            if($value <= 0 ){
                PlatilloValidation::$data['error'][] = "El Campo $key es obligatorio";
            }
        }

        return PlatilloValidation::$data;

    }


}