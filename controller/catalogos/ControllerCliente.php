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

include "../../model/model_clientes.php";
include "../../validation/ClienteValidation.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_clientes,
    App\Validation\ClienteValidation;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $cliente = new model_clientes($connect);
    $NoUsuario = $_SESSION['DataLogin']['idusuario'];

    switch ($_POST['route']){

        //Registrar nuevo cliente
        case 'registrar':

                $result = ClienteValidation::validate($_POST);
                if(count($result) > 0 ){
                    core::JsonResult($result['error'][0],false,[]);
                }
                $_POST['idusuario'] = $NoUsuario;

                $cliente->getRegistrarCliente($_POST);

                if($cliente->confirm){
                    core::JsonResult('Cliente registrado correctamente',true,$cliente->rows);
                }else{
                    core::JsonResult($cliente->message);
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

            $cliente->getClientes(10,1,$_POST['opc'],$data);
            if($cliente->confirm){
                core::JsonResult($cliente->message,true,$cliente->rows);
            }else{
                core::JsonResult($cliente->message);
            }


            break;
        case 'get':
            $cliente->getCliente($_POST['idcliente']);
            if($cliente->confirm){
                core::JsonResult($cliente->message,true,$cliente->rows);
            }else{
                core::JsonResult($cliente->message);
            }
            break;
        //Editar la informacion del cliente Solicitada.
        case 'editar':

            $result = ClienteValidation::validate($_POST,true);
            if(count($result) > 0 ){
                core::JsonResult($result['error'][0],false,[]);
            }

            $cliente->getEditarCliente(
                [
                    'idcliente'=>$_POST['idcliente'],
                    'nombre'=>$_POST['nombre'],
                    'apellidos'=>$_POST['apellidos'],
                    'direccion'=>$_POST['direccion'],
                    'telefono'=>$_POST['telefono'],
                    'celular'=>$_POST['celular'],
                    'correo'=>$_POST['correo'],
                    'idestatus'=>$_POST['idestatus'],
                    'idusuario'=>$NoUsuario
                ]
            );

            if($cliente->confirm){
                core::JsonResult($cliente->message,true,[]);
            }else{
                core::JsonResult($cliente->message);
            }

            break;
        //Opcion para desactivar el cliente
        case 'delete':

            if(!is_numeric($_POST['idcliente'])){
                core::JsonResult('El cliente es iconrrecto');
            }

            $cliente->getDesactivarCliente(['idcliente'=>$_POST['idcliente'],'idusuario'=>$_SESSION['DataLogin']['idusuario']]);

            if($cliente->confirm){

                core::JsonResult('Cliente desactivada',true,[]);
            }else{

                core::JsonResult($cliente->message);
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