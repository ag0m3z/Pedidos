<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 09:59 PM
 */

namespace SistemaPedidos;

include "core/core.php";
include "core/session.php";
include "core/views.php";

use core\core,
    core\session,
    core\views;


class App
{

    public static function run(){

        $vista = new views();
        $sesiones = new session();

        if($sesiones->validar_acceso()){

            $vista->call_view(
                array(
                    'home',
                    'ViewHome'
                )
            );

        }else{

            $vista->call_view(
                array(
                    'login',
                    'FrmLogin'
                )
            );
        }


    }

}

App::run();