<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:07 PM
 */

namespace core;

session_name(md5(sha1(core::$_nombreApp)));
session_start();
session_id();


class session
{
    public function set($nombre_array,$datos = array()){

        $_SESSION[$nombre_array] = $datos ;
    }

    public static function get($nombre_array,$nombre) {

        if (isset ( $_SESSION [$nombre_array][$nombre] )) {

            return $_SESSION [$nombre_array][$nombre];

        } else {

            return false;

        }
    }

    public function borrar_variable($nombre_array,$nombre) {

        unset ($_SESSION [$nombre_array][$nombre] );

    }

    public function validar_acceso(){

        if(array_key_exists('DataLogin',$_SESSION)){

            if(!isset($_SESSION['DataLogin']['idusuario'])){
                $this->delete_sesion();
                return false;
            }else{
                return true;
            }

        }else{
            $this->delete_sesion();
            return false;
        }

    }

    public function delete_sesion() {

        session_unset ();
        session_destroy ();
        session_start();
        session_regenerate_id(true);
    }

}