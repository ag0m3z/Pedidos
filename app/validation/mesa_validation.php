<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:16 AM
 */

namespace App\Validation;

use App\Lib\Response;

class MesaValidation {

    public static function validate($data,$update = false) {
        $response = new Response();

        $key = 'idmesa';
        if($update){
            if(empty($data[$key])){
                $response->data['error'][$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];

                if(!is_numeric ($value)) {
                    $response->data['error'][$key][] = 'El valor del campo es incorrecto, debe ser numerico';
                }else{
                    if($value <= 0){
                        $response->data['error'][$key][] = 'El id del cliente es incorrecto';
                    }
                }
            }
        }

        $key = 'idempresa';
        if(empty($data[$key])){
            $response->data['error'][$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];

            if(!is_numeric ($value)) {
                $response->data['error'][$key][] = 'El valor del campo es incorrecto, debe ser numerico';
            }else{
                if($value <= 0){
                    $response->data['error'][$key][] = 'El id es incorrecto';
                }
            }
        }

        $key = 'numero_mesa';
        if(empty($data[$key])){
            $response->data['error'][$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];

            if(!is_numeric ($value)) {
                $response->data['error'][$key][] = 'El valor del campo es incorrecto, debe ser numerico';
            }else{
                if($value <= 0){
                    $response->data['error'][$key][] = 'El numero de mesa debe ser mayor a 0';
                }
            }
        }

        $key = 'tipo';
        if(empty($data[$key])){
            $response->data['error'][$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];

            if(strlen($value) < 1) {
                $response->data['error'][$key][] = 'Debe contener como mínimo 1 caracter';
            }
            if(strlen($value) > 1) {
                $response->data['error'][$key][] = 'Debe contener como maximo 1 caracter';
            }
        }


        $key = 'nombre';
        if(empty($data[$key])){
            $response->data['error'][$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];

            if(strlen($value) < 4) {
                $response->data['error'][$key][] = 'Debe contener como mínimo 4 caracteres';
            }
            if(strlen($value) > 45) {
                $response->data['error'][$key][] = 'Debe contener como maximo 45 caracteres';
            }
        }

        $key = 'idestatus';
        if($update){
            if(empty($data[$key])){
                $response->data['error'][$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];

                if(!is_numeric ($value)) {
                    $response->data['error'][$key][] = 'El valor del campo es incorrecto, debe ser numerico';
                }
            }
        }


        if(count($response->data) > 0){
            $response->SetResponse(false,'campos vacios ');
        }else{
            $response->SetResponse(true,'compos correctos');
        }
        //$response->SetResponse(count($response->data) === 0);

        return $response;
    }



}