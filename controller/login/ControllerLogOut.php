<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:30 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/modelo_auth.php";

use core\core,
    core\session,
    core\seguridad,
    Auth\modelo_auth;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){


    $connect = new seguridad();
    $login = new modelo_auth($connect);

    $sesion = new session();
    $sesion->delete_sesion();
    core::JsonResult('Usuario desconectado',true,[]);

}else{
    core::JsonResult('Metodo no soportado');
}