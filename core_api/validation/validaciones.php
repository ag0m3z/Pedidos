<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 04/04/2018
 * Time: 11:29 PM
 */

namespace App\Validation;

use App\Lib\Response;

class Validaciones {

    public static function esNumerico($numero,$res) {

        if(!is_numeric($numero)){

            return $res->withHeader('Content-Type','application/json')->write(
                json_encode(array('result'=>false,'message'=>'El limite y la pagina deben ser numericos'))
            );
        }
        return true;



    }



}