<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:08 PM
 */

namespace core;

include "dbContext.php";

class seguridad extends  dbContext
{

    public function valida_session_id($NoUsuario)
    {

        //NoUsuario,init_time,session_id
        $FechaActual = date("Y-m-d H:i:s");
        $Request_time = $_SESSION['data_login']['REQUEST_TIME'];

        $NoUsuario = $_SESSION['data_login']['NoUsuario'];


        if (array_key_exists('data_login', $_SESSION)) {

            if (!isset($_SESSION['data_login']['NoUsuario'])) {
                //No Existe Sesion
                session_unset();
                session_destroy();
                session_start();
                session_regenerate_id(true);

                return false;
            } else {

                return true;
            }

        } else {
            //no existe session
            session_unset();
            session_destroy();
            session_start();
            session_regenerate_id(true);
            return false;

        }
    }

}