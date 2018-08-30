<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 17/07/2018
 * Time: 02:01 PM
 */
include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_config.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_config ;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(!isset($_POST['key']) || empty($_POST['key'])){
        core::JsonResult('Error no autorizado',false,[]);
    }else{
        $connect = new seguridad();

        $NombreEmpresa = $_POST['nombre'];
        $Colonia = $_POST['colonia'];
        $Calle = $_POST['calle'];
        $Telefono1 = $_POST['tel1'];
        $Telefono2 = $_POST['tel2'];
        $Celular = $_POST['celular'];
        $Tema = $_POST['tema'];
        $imgMenu = $_POST['sidebar'];

        if($_POST['apertura'] == "true"){
            $apertura = 1;
        }
        if($_POST['acceso_restringido'] == "true"){
            $acceso_restringido = 1;
        }
        if($_POST['serv_domicilio'] == "true"){
            $serv_domicilio = 1;
        }
        if($_POST['cambiar_clave'] == "true"){
            $cambiar_clave = 1;
        }
        if($_POST['print_ticket'] == "true"){
            $print_ticket = 1;
        }
        if($_POST['logo_ticket'] == "true"){
            $logo_ticket = 1;
        }
        if($_POST['tel_ticket'] == "true"){
            $tel_ticket = 1;
        }
        if($_POST['automatico_ticket'] == "true"){
            $automatico_ticket = 1;
        }
        if($_POST['close_ticket'] == "true"){
            $close_ticket = 1;
        }
        if($_POST['group_ticket'] == "true"){
            $group_ticket = 1;
        }


        $HoraCierreSistema = $_POST['horasistema'];

        $connect->_query = "
        UPDATE config 
            SET NombreEmpresa = '$NombreEmpresa',
                Colonia = '$Colonia',
                Calle = '$Calle',
                Telefono1 = '$Telefono1',Telefono2 = '$Telefono2',Celular = '$Celular',
                tema = '$Tema',
                imgMenu = '$imgMenu',AperturaCierre = '$apertura',HorarioAcceso='$acceso_restringido',
                ServicioDomicilio = '$serv_domicilio',
                CambiarClave = '$cambiar_clave',Ticket='$print_ticket',TicketLogo = '$logo_ticket',
                TicketTelefono = '$tel_ticket',
                TicketAgrupacion = '$group_ticket',
                TicketAutomatico = '$automatico_ticket',
                CerrarPantallaTicket = '$close_ticket',
                HoraCierreSistema = '$HoraCierreSistema'
        WHERE idKey = 1    
        ";

        $connect->execute_query();

        $_SESSION['DataLogin']['tema'] = $Tema;
        $_SESSION['DataLogin']['imgMenu'] = $imgMenu;

        core::JsonResult('ok',true);
    }

}else{
    core::JsonResult();
}