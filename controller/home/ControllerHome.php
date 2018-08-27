<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 19/07/2018
 * Time: 11:44 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,
    core\session,
    core\seguridad;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();

    //Ventas del dia
    $connect->_query = "
    SELECT  ifnull(sum(importe_venta),0)as totalVentasDia FROM movimientos WHERE date(FechaAlta) = date(now()) AND idestatus = 1
    ";
    $connect->get_result_query(true);
    $totalVentasDia = $connect->_rows[0]['totalVentasDia'];

    //Ventas del dia
    $connect->_query = "
    SELECT  ifnull(sum(importe_venta),0)as totalCancelacionesDia FROM movimientos WHERE date(FechaAlta) = date(now()) AND idestatus = 2
    ";
    $connect->get_result_query(true);
    $totalCancelacionesDia = $connect->_rows[0]['totalCancelacionesDia'];

    //Ventas a Domicilio Por dia
    $connect->_query = "
    SELECT  ifnull(sum(a.importe_venta),0)as totalVentasDomicilio
    FROM movimientos as a 
    LEFT JOIN pedidos as b ON a.idpedido = b.idpedido AND b.idestatus = 2
    WHERE 
        date(a.FechaAlta) = date(now()) AND a.idestatus = 1 AND b.adomicilio = 1 ;
    ";
    $connect->get_result_query(true);
    $totalVentasDomicilio = $connect->_rows[0]['totalVentasDomicilio'];

    //Ventas Total
    $connect->_query = "
    SELECT  ifnull(sum(importe_venta),0)as totalVentas FROM movimientos WHERE idestatus = 1
    ";
    $connect->get_result_query(true);
    $totalVentas = $connect->_rows[0]['totalVentas'];

    //Pedidos pendientes y terminados
    $connect->_query = "
    SELECT 
        a.idpedido,a.idcliente,concat_ws(' ',c.nombre,c.apellidos)as NombreCliente,sum(b.precio_venta)as Total,date(a.FechaAlta)as FechaAlta,a.idestatus,a.adomicilio 
    FROM detalle_pedido as b
    LEFT JOIN pedidos as a ON a.idpedido = b.pedidos_idpedido 
    LEFT JOIN clientes as c ON a.idcliente = c.idcliente
    WHERE a.idestatus = 1 OR date(a.FechaAlta ) = date(now()) GROUP BY pedidos_idpedido
    ";
    $connect->get_result_query(true);
    $totalPedidos = $connect->_rows;

    //Ventas por meses
    $connect->_query = "
    SELECT 
	ifnull(b.Enero,0)as Ene,ifnull(c.Febrero,0)as Feb,ifnull(d.Marzo,0)as Mar,ifnull(e.Abril,0)as Abr,ifnull(f.Mayo,0)as May,ifnull(g.Junio,0)as Jun,
    ifnull(h.Julio,0)as Jul,ifnull(i.Agosto,0)as Ago,ifnull(j.Septiembre,0)as Sep,ifnull(k.Octubre,0)as Oct,ifnull(l.Noviembre,0)as Nov,ifnull(m.Diciembre,0)as Dic
    FROM movimientos as a 
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Enero FROM movimientos WHERE month(FechaAlta) =  1 AND idestatus = 1 )as b ON a.idmovimiento = b.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Febrero FROM movimientos WHERE month(FechaAlta) = 2 AND idestatus = 1  )as c ON a.idmovimiento = c.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Marzo FROM movimientos WHERE month(FechaAlta) = 3 AND idestatus = 1  )as d ON a.idmovimiento = d.idmovimiento 
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Abril FROM movimientos WHERE month(FechaAlta) = 4 AND idestatus = 1  )as e ON a.idmovimiento = e.idmovimiento 
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Mayo FROM movimientos WHERE month(FechaAlta) = 5 AND idestatus = 1  )as f ON a.idmovimiento = f.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Junio FROM movimientos WHERE month(FechaAlta) = 6 AND idestatus = 1  )as g ON a.idmovimiento = g.idmovimiento 
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Julio FROM movimientos WHERE month(FechaAlta) = 7 AND idestatus = 1  )as h ON a.idmovimiento = h.idmovimiento  
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Agosto FROM movimientos WHERE month(FechaAlta) = 8 AND idestatus = 1  )as i ON a.idmovimiento = i.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Septiembre FROM movimientos WHERE month(FechaAlta) = 9 AND idestatus = 1  )as j ON a.idmovimiento = j.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Octubre FROM movimientos WHERE month(FechaAlta) = 10 AND idestatus = 1  )as k ON a.idmovimiento = k.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Noviembre FROM movimientos WHERE month(FechaAlta) = 11 AND idestatus = 1  )as l ON a.idmovimiento = l.idmovimiento
    LEFT JOIN 
    (SELECT idmovimiento,sum(importe_venta)as Diciembre FROM movimientos WHERE month(FechaAlta) = 12 AND idestatus = 1  )as m ON a.idmovimiento = m.idmovimiento
    LIMiT 0,1
    ";

    $connect->get_result_query(true);
    $totalMeses = $connect->_rows[0];
    if(count($connect->_rows) == null){
        $totalMeses = array(
          "Ene"=>0,
            "Feb"=>0,
            "Mar"=>0,
            "Abr"=>0,
            "May"=>0,
            "Jun"=>0,
            "Jul"=>0,
            "Ago"=>0,
            "Sep"=>0,
            "Oct"=>0,
            "Nov"=>0,
            "Dic"=>0,
        );
    }



    core::JsonResult($connect->_message,$connect->_confirm,array('totalPedidos'=>$totalPedidos,'totalCancelacionesDia'=>$totalCancelacionesDia,'totalVentasDia'=>$totalVentasDia,'totalVentasDomicilio'=>$totalVentasDomicilio,'totalVentas'=>$totalVentas,'totalMeses'=>$totalMeses));

}else{
    core::JsonResult();
}