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

    //Sanatizar datos
    $_POST = $connect->get_sanatiza($_POST);

    if(!trim($_POST['usuario']) == ""){

        $login->getUsuario(['usuario'=>$_POST['usuario']]);

        if(count($login->rows) > 0){

            /**
             * Si se encuentra un registro
             * Validar que la contraseña sean iguales
             */

            if(md5(sha1($_POST['password'])) == $login->rows[0]['password']){

                $sesion = new session();

                $sesion->set('DataLogin',array(
                   'idusuario'=>$login->rows[0]['idusuario'],
                    'nombre'=>$login->rows[0]['nombre'],
                    'apellidos'=>$login->rows[0]['apellidos'],
                    'nickname'=>$login->rows[0]['nickname'],
                    'usuario'=>$login->rows[0]['usuario'],
                    'idestatus'=>$login->rows[0]['idestatus'],
                    'idperfil'=>$login->rows[0]['idperfil'],
                    'NombrePerfil'=>$login->rows[0]['NombrePerfil'],
                    'tema'=>$login->rows[0]['tema'],
                    'imgMenu'=>$login->rows[0]['imgMenu']
                ));

                $sesion->set('DataHome',array(
                    'NombreEmpresa'=>$login->rows[0]['NombreEmpresa'],
                    'Logo'=>$login->rows[0]['Logo'],
                    'Colonia'=>$login->rows[0]['Colonia'],
                    'Calle'=>$login->rows[0]['Calle'],
                    'Telefono1'=>$login->rows[0]['Telefono1'],
                    'Telefono2'=>$login->rows[0]['Telefono2'],
                    'Celular'=>$login->rows[0]['Celular']
                ));

                $login->getAccesos($login->rows[0]['idusuario']);
                $sesion->set('Menu',$login->rows);

                core::JsonResult('Espere un momento',true,[]);

            }else{
                //Contraseña incorrecta
                core::JsonResult('La contraseña es incorrecta');
            }
        }else{
            core::JsonResult('No se encontro el usuario: '.$_POST['usuario']);
        }
    }else{
        core::JsonResult('Ingrese el nombre de usuario');
    }
}else{
    core::JsonResult('Metodo no soportado');
}