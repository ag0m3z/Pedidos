<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 20/06/2018
 * Time: 08:22 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_platillos.php";
include "../../validation/PlatilloValidation.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_platillos,
    App\Validation\PlatilloValidation;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $platillo = new model_platillos($connect);
    $NoUsuario = $_SESSION['DataLogin']['idusuario'];

    switch ($_POST['route']){

        //Registrar nuevo platillo
        case 'registrar':

            $result = PlatilloValidation::validate($_POST);
            if(count($result) > 0 ){
                core::JsonResult($result['error'][0],false,[]);
            }
            $_POST['idusuario'] = $NoUsuario;

            $platillo->getRegistrarPlatillo($_POST);

            if($platillo->confirm){
                core::JsonResult('Platillo registrado correctamente',true,[]);
            }else{
                core::JsonResult($platillo->message);
            }

            break;
        //traer toda la lista los clientes
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
            $platillo->getPlatillos(10,1,$_POST['opc'],$data);
            if($platillo->confirm){
                core::JsonResult($platillo->message,true,$platillo->rows);
            }else{
                core::JsonResult($platillo->message);
            }

            break;
        //Editar la informacion del cliente Solicitada.
        case 'editar':

            $result = PlatilloValidation::validate($_POST,true);
            if(count($result) > 0 ){
                core::JsonResult($result['error'][0],false,[]);
            }

            $_POST['idusuario'] = $NoUsuario;

            $platillo->getEditarPlatillo($_POST);

            if($platillo->confirm){
                core::JsonResult($platillo->message,true,[]);
            }else{
                core::JsonResult($platillo->message);
            }

            break;
        //Opcion para desactivar el cliente
        case 'delete':

            if(!is_numeric($_POST['idplatillo'])){
                core::JsonResult('El platillo es iconrrecto');
            }

            $platillo->getDesactivarPlatillo(['idplatillo'=>$_POST['idplatillo'],'idusuario'=>$_SESSION['DataLogin']['idusuario']]);

            if($platillo->confirm){

                core::JsonResult('Platillo desactivado',true,[]);
            }else{

                core::JsonResult($platillo->message);
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