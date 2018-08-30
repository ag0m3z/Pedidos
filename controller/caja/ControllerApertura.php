<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 24/07/2018
 * Time: 11:57 AM
 */


include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,core\session,core\seguridad;

$connect = new seguridad();
core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $NoUsuario = $_SESSION['DataLogin']['idusuario'];
    $FechaAlta = date("Y-m-d H:i:s");
    $FechaActual = date("Y-m-d");

    switch($_POST['route']){

        case 'validarCierre':

            $connect->_query = "SELECT id,Tipo,Fecha,Monto,NoUsuarioAlta FROM apertura where Tipo = 'C' ORDER BY Fecha DESC";
            $connect->get_result_query(true);

            if(count($connect->_rows)>0){

                $FechaComp = date("Y-m-d",strtotime($FechaActual."- 1 days"));
                if($FechaComp == $connect->_rows[0]['Fecha']){
                    core::JsonResult('consulta exitosa',true,array('FechaActual'=>$FechaActual,'FechaUltimoCierre'=>$connect->_rows[0]['Fecha'],'MontoCierre'=>$connect->_rows[0]['Monto']));
                }else{
                    if(date("H:i:s") >= $_SESSION['DataConfig']['HoraCierreSistema']){
                        core::JsonResult('consulta exitosa',true,array('response'=>'cierre','FechaActual'=>$FechaActual,'FechaUltimoCierre'=>$connect->_rows[0]['Fecha'],'MontoCierre'=>$connect->_rows[0]['Monto']));
                    }else{
                        //No realizar cierre
                        core::JsonResult('consulta exitosa',true,array('FechaActual'=>$FechaActual,'FechaUltimoCierre'=>$connect->_rows[0]['Fecha'],'MontoCierre'=>$connect->_rows[0]['Monto']));
                    }

                }
            }else{
                core::JsonResult('Cierre aun no realizado',true,array('response'=>'cierre','FechaActual'=>$FechaActual,'FechaUltimoCierre'=>$connect->_rows[0]['Fecha'],'MontoCierre'=>$connect->_rows[0]['Monto']));
            }
            break;
        case 'setCierre':
            $connect->_query = "
                INSERT INTO apertura (Tipo,Fecha,Monto,idestatus,NoUsuarioAlta,FechaRegistro) VALUES 
                ('C','$_POST[fechacierre]','$_POST[montocierre]',1,$NoUsuario,now());
            ";
            $connect->execute_query();
            core::JsonResult($connect->_message,$connect->_confirm,$connect->_rows);
            break;
        case 'get':
            break;
        default:
            core::JsonResult('Ruta no valida',true,[]);
            break;
    }

}else{
    core::JsonResult("Metodo no soportado");
}