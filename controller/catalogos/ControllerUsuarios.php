<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 04:51 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_usuarios.php";
include "../../validation/UsuarioValidation.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_usuarios,
    App\Validation\UsuarioValidation;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $usuario = new model_usuarios($connect);

    switch ($_POST['route']){

        //Registrar nuevo usuario
        case 'registrar':


                $result = UsuarioValidation::validate($_POST);
                if(count($result) > 0 ){
                    core::JsonResult($result['error'][0],false,[]);
                }

                $_POST['idusuario_alta'] = $_SESSION['DataLogin']['idusuario'];

                $usuario->getRegistrarUsuario($_POST);

                if($usuario->confirm){
                    core::JsonResult('Usuario registrado correctamente',true,[]);
                }else{
                    core::JsonResult($usuario->message);
                }

            break;
        //traer toda la lista de usuarios
        case 'listar':
            $data = [];
            if($_POST['opc'] == 2){
                foreach($_POST['dataArray'] as $id=>$valor){
                    if($valor != "0"){

                        $id = "a.".$id;
                        $data[] = array($id,$valor);
                    }
                }
            }

            $usuario->getUsuarios(10,1,$_POST['opc'],$data);
            if($usuario->confirm){
                core::JsonResult($usuario->message,true,$usuario->rows);
            }else{
                core::JsonResult($usuario->message);
            }


            break;

        // Traer la informacion del usuario Solicitado
        case 'buscar':
            break;
        //Editar la informacion del usuario solicitado.
        case 'editar':

            if($_POST['password'] != $_POST['new_password'] ){
                $_POST['password'] = md5(sha1($_POST['new_password']));
            }

            $result = UsuarioValidation::validate($_POST,true);
            if(count($result) > 0 ){
                core::JsonResult($result['error'][0],false,[]);
            }

            $usuario->getEditarUsuario($_POST);
            if($usuario->confirm){
                core::JsonResult('Usuario editado correctamente',true,[]);
            }else{
                core::JsonResult($usuario->message);
            }

            break;
        //Opcion para desactivar usuarios
        case 'delete':

            if(!is_numeric($_POST['idusuario'])){
                core::JsonResult('El usuario es iconrrecto');
            }

            $usuario->getDesactivarUsuario($_POST['idusuario']);

            if($usuario->confirm){

                core::JsonResult('Usuario desactivado',true,[]);
            }else{

                core::JsonResult($usuario->message);
            }

            break;
        //Si no se especifica la accion a realizar
        default:
            core::JsonResult('Ruta no valida');
            break;

    }

}else{
    core::JsonResult('Metodo no soportado');
}