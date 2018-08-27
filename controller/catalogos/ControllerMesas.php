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

include "../../model/model_mesas.php";
include "../../validation/MesasValidation.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_mesas,
    App\Validation\MesasValidation;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $mesas = new model_mesas($connect);
    $NoUsuario = $_SESSION['DataLogin']['idusuario'];

    switch ($_POST['route']){

        //Registrar nuevo usuario
        case 'registrar':

                $result = MesasValidation::validate($_POST);
                if(count($result) > 0 ){
                    core::JsonResult($result['error'][0],false,[]);
                }
                $_POST['idusuario'] = $NoUsuario;

                $mesas->getRegistrarMesa($_POST);

                if($mesas->confirm){
                    core::JsonResult('Mesa registrada correctamente',true,[]);
                }else{
                    core::JsonResult($mesas->message);
                }

            break;
        //traer toda la lista de Mesas
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

            $mesas->getMesas(10,1,$_POST['opc'],$data);
            if($mesas->confirm){
                core::JsonResult($mesas->message,true,$mesas->rows);
            }else{
                core::JsonResult($mesas->message);
            }


            break;
        //Editar la informacion Mesa Solicitada.
        case 'editar':

            $result = MesasValidation::validate($_POST,true);
            if(count($result) > 0 ){
                core::JsonResult($result['error'][0],false,[]);
            }

            $mesas->getEditarMesa(['idmesas'=>$_POST['idmesas'],'nombre'=>$_POST['nombre'],'idestatus'=>$_POST['idestatus'],'idusuario'=>$NoUsuario ]);

            if($mesas->confirm){
                core::JsonResult($mesas->message,true,[]);
            }else{
                core::JsonResult($mesas->message);
            }

            break;
        //Opcion para desactivar la Mesa
        case 'delete':

            if(!is_numeric($_POST['idmesas'])){
                core::JsonResult('La mesa es iconrrecta');
            }

            $mesas->getDesactivarMesa(['idmesas'=>$_POST['idmesas'],'idusuario'=>$_SESSION['DataLogin']['idusuario']]);

            if($mesas->confirm){

                core::JsonResult('Mesa desactivada',true,[]);
            }else{

                core::JsonResult($mesas->message);
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