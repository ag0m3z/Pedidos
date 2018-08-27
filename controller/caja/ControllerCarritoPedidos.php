<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/06/2018
 * Time: 09:01 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_carrito.php";
include "../../model/model_platillos.php";

use core\core,core\session,core\seguridad,models\model_carrito;
use models\model_platillos;

$connect = new seguridad();
core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $idplatillo = $_POST['idplatillo'];
    $NoUsuario = $_SESSION['DataLogin']['idusuario'];
    $FechaAlta = date("Y-m-d H:i:s");

    $idplatillo = $_POST['idplatillo'];
    $cantidad = $_POST['cantidad'];

    switch($_POST['route']){

        case 'addcart':

            $platillo = new model_platillos($connect);
            $platillo->getPlatillo($idplatillo);

            if($platillo->confirm){

                $data = array();

                switch ($_POST['opcion']){
                    case 1:
                        //Crear el carrito de Pedido
                        $cart = new model_carrito();
                        $cart->addCart(array('id'=>$idplatillo,'descripcion'=>$platillo->rows[0]['nombre'],'precio'=>(float)$platillo->rows[0]['precio_venta'],'cantidad'=>$cantidad));
                        $data = $cart->getPrint();
                        break;
                    case 2:
                        //Agregar Costo de Servicio
                        $cart = new model_carrito();
                        $cart->addCart(array('id'=>$idplatillo,'descripcion'=>$_POST['descripcion'],'precio'=>(float)$_POST['precio'],'cantidad'=>$cantidad));
                        $data = $cart->getPrint();
                        break;
                    default:
                        core::JsonResult('Opcion no valida');
                        break;
                }

                core::JsonResult('consulta exitosa',true,$data);

            }else{
                core::JsonResult($platillo->message);

            }
            break;
        case 'get':
            break;
        case 'delete':

            //Crear el carrito de Pedido
            $cart = new model_carrito();
            $cart->setDelete($_POST['uid']);
            core::JsonResult('consulta exitosa',true,$cart->getPrint());

            break;
        default:
            core::JsonResult('Ruta no valida',true,[]);
            break;
    }

}else{
    core::JsonResult("Metodo no soportado");
}