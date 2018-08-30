<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 02/07/2018
 * Time: 08:18 PM
 */
include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";


//Carrito de pedidos
include "../../model/model_pedidos.php";
include "../../model/model_carrito.php";
include "../../model/model_platillos.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_carrito,
    models\model_pedidos,
    models\model_platillos;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $modelPedidos = new model_pedidos($connect);
    $modelPlatillos = new model_platillos($connect);

    $NoUsuarioAlta = $_SESSION['DataLogin']['idusuario'];

    $FechaRegistroPedido = date("Y-m-d H:i:s");

    if(date("H:i:s") >= "00:00:00"){

        $FechaAnterior= date("Y-m-d 23:59:00",strtotime(date("Y-m-d")."- 1 days"));


        $FechaRegistroPedido = $FechaAnterior;
    }

    switch ($_POST['route']){

        case 'agregar':

            $cart = new model_carrito();
            $productos = $cart->getPrint();

           if(count($productos) > 0 ){
               /**
                * Crear el pedido en la
                * tabla de pedidos y obtener el [id] del pedido
                */
               $modelPedidos->getAgregar(
                   array(
                       'idcliente'=>$_POST['idcliente'],
                       'idmesa'=>$_POST['idmesa'],
                       'adomicilio'=>$_POST['sdomicilio'],
                       'costo_domicilio'=>$_POST['costodomicilio'],
                       'direccion'=>$_POST['direccion'],
                       'idestatus'=>1,
                       'idusuario_alta'=>$NoUsuarioAlta,
                       'FechaAlta'=>$FechaRegistroPedido
                   )
               );

               if($modelPedidos->confirm){

                   /**
                    * Registrar el detalle del pedido
                    */

                   for($i=0;$i < count($productos);$i++){

                       if($productos[$i]['id'] != "CXS"){
                           $modelPedidos->getAgregarDetalle(
                               array(
                                   'id'=>$modelPedidos->rows[0]['id'],
                                   'idplatillo'=>$productos[$i]['id'],
                                   'precio'=>$productos[$i]['precio'],
                                   'cantidad'=>$productos[$i]['cantidad']
                               )
                           );
                       }
                   }
                   core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);
               }else{
                   //Erroral registrar el pedido
                   core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);
               }
           }else{
               core::JsonResult("No hay platillos en el pedido para registrar");
           }

            break;

        //Agregar platillo a detalle del pedido
        case 'set':

            $modelPlatillos->getPlatillo($_POST['idplatillo']);
            $_POST['precio'] = $modelPlatillos->rows[0]['precio_venta'];

            $modelPedidos->getAgregarDetalle($_POST);
            core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);

            break;

        case "adomicilio":

            if($_POST['idpedido'] > 0 && $_POST['costo'] > 0){
                $modelPedidos->setAdomicilio($_POST['idpedido'],$_POST['costo']);
                core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);
            }else{
                core::JsonResult('El costo o el id del pedido es incorrecto, deben ser numericos y mayor a 0');
            }

            break;

        case 'listar':

            $modelPedidos->getListar($_POST['idestatus']);
            core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);

            break;

        case 'get':
            $modelPedidos->getPedido($_POST['idpedido']);
            core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);
            break;

        case 'cobrar':

            if(!array_key_exists('idpedido',$_POST) || empty($_POST['idpedido'])){
                core::JsonResult('el id del pedido no se encontro');
            }else{

                $ImporteTotal = (float)$_POST['importe_venta'];
                $ImportePagado = (float)$_POST['importe_pagado'];

                if($ImportePagado < $ImporteTotal){
                    core::JsonResult("El importe de pago debe ser mayor al total");
                }else{

                    $_POST['FechaVenta'] =$FechaRegistroPedido;

                    $_POST['importe_venta'] = $ImporteTotal;
                    $_POST['importe_pagado'] = $ImportePagado;
                    $_POST['nopago'] = 1;
                    $_POST['tipo_mov'] = 1;
                    $_POST['pago_efectivo'] = 0;
                    $_POST['pago_tarjeta'] = 0;
                    $_POST['idusuario_alta'] = $NoUsuarioAlta;

                    $modelPedidos->setCobrarPedido($_POST);
                    $Ticket = $modelPedidos->idmovimiento;

                    if($modelPedidos->confirm){

                        $modelPedidos->getPedido($_POST['idpedido']);
                        $dataResponse = array(
                            'idpedido'=>$_POST['idpedido'],
                            'idmovimiento'=>$Ticket,
                            'ImporteTotal'=>$ImporteTotal,
                            'ImportePagado'=>$ImportePagado,
                            'Cambio'=>(float)($ImportePagado - $ImporteTotal),
                            'FechaVenta'=>$_POST['FechaVenta'],
                            'Cajero'=>$_SESSION['DataLogin']['nickname'],
                            'Detalle'=>$modelPedidos->rows
                        );

                        core::JsonResult('consulta exitosa',true,$dataResponse);
                    }else{
                        core::JsonResult($modelPedidos->message);
                    }
                }
            }

            break;

        case "delete":

            $modelPedidos->setCancelarPlatillo($_POST['iddetalle_pedido'],$_POST['idpedido']);
            core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);

            break;

        case "cancel":

            if(is_numeric($_POST['idpedido'])){

                //Validar que las ventas sean de mismo día
                $modelPedidos->setCancelarPedido($_POST['idpedido'],$NoUsuarioAlta,false);
                core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);

            }else{
                core::JsonResult("No es numerico");
            }

            break;

        case 'movimientos':

            $modelPedidos->getMovimientos(true);
            core::JsonResult($modelPedidos->message,$modelPedidos->confirm,$modelPedidos->rows);


            break;


        default:
            core::JsonResult('Ruta no encontrada');
            break;
    }


}else{
    core::JsonResult('Metodo no soportado');
}