<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 02/07/2018
 * Time: 10:57 PM
 */

namespace models;


use core\core;

class model_pedidos
{
    private $db;
    public $confirm = false;
    public $message = '';
    public $rows = [];
    public $idmovimiento = 0;

    public function __construct($dbcontext)
    {
        $this->db = $dbcontext;
    }

    public function getListar($idestatus){

        $FiltrarFechaActual = '';
        if($idestatus == 2){
            $FiltrarFechaActual = " AND b.FechaAlta = '".date("Y-m-d H:i:s")."' ";
        }

        $this->db->_query = "
            SELECT 
              b.idpedido,b.idcliente,c.nombre as NombreCliente,c.telefono,b.idmesa,d.nombre as NombreMesa,b.idestatus,b.idusuario_alta,e.nickname as NombreUsuarioAlta,b.FechaAlta,
              a.iddetalle,a.platillos_idplatillo,f.nombre as NombrePlatillo,a.precio_venta,a.cantidad,f.url_img,b.costo_domicilio,b.adomicilio
            FROM 
              detalle_pedido as a 
            LEFT JOIN pedidos as b on a.pedidos_idpedido = b.idpedido 
            LEFT JOIN clientes as c on b.idcliente = c.idcliente
            LEFT JOIN mesas as d on b.idmesa = d.idmesas 
            LEFT JOIN usuarios as e on b.idusuario_alta= e.idusuario 
            LEFT JOIN platillos as f on a.platillos_idplatillo = f.idplatillo
            WHERE b.idestatus = '$idestatus' ORDER BY b.FechaAlta DESC
        ";

        $this->db->get_result_query(true);
        $data['detalle'] = $this->db->_rows;

        $this->db->_query = "
            SELECT 
              b.idpedido,b.idcliente,c.nombre as NombreCliente,c.telefono,b.idmesa,d.nombre as NombreMesa,b.idestatus,b.idusuario_alta,e.nickname as NombreUsuarioAlta,b.FechaAlta,
              a.iddetalle,a.platillos_idplatillo,f.nombre as NombrePlatillo,a.precio_venta,a.cantidad,((sum(a.precio_venta) * a.cantidad)+b.costo_domicilio)as Total,f.url_img,b.costo_domicilio,b.adomicilio
            FROM 
              detalle_pedido as a 
            LEFT JOIN pedidos as b on a.pedidos_idpedido = b.idpedido 
            LEFT JOIN clientes as c on b.idcliente = c.idcliente
            LEFT JOIN mesas as d on b.idmesa = d.idmesas 
            LEFT JOIN usuarios as e on b.idusuario_alta= e.idusuario 
            LEFT JOIN platillos as f on a.platillos_idplatillo = f.idplatillo
            WHERE b.idestatus = '$idestatus' $FiltrarFechaActual GROUP BY b.idpedido ORDER BY b.FechaAlta DESC
        ";

        $this->db->get_result_query(true);
        $data['pedidos'] = $this->db->_rows;


        if($this->db->_confirm){
            $this->confirm = $this->db->_confirm;
            $this->message=  $this->db->_message;
            $this->rows = $data;
        }else{
            $this->confirm = $this->db->_confirm;
            $this->message=  $this->db->_message;
            $this->rows = $this->db->_rows;
        }
    }

    public function getAgregar($data){

        $this->db->_query = "
        INSERT INTO pedidos (
          idcliente,idmesa,adomicilio,costo_domicilio,direccion,idestatus,idusuario_alta,FechaAlta
        ) VALUES (
          '$data[idcliente]','$data[idmesa]','$data[adomicilio]','$data[costo_domicilio]','$data[direccion]','$data[idestatus]','$data[idusuario_alta]','$data[FechaAlta]'
        )
        ";
        $this->db->execute_query();

        if($this->db->_confirm){

            $this->db->_query = "
                SELECT @@identity as id
            ";
            $this->db->get_result_query(true);

            $this->confirm = $this->db->_confirm;
            $this->message=  $this->db->_message;
            $this->rows = $this->db->_rows;

        }else{

            $this->confirm = $this->db->_confirm;
            $this->message=  $this->db->_message;
            $this->rows = [];
        }

    }

    public function getAgregarDetalle($data){

        $this->db->_query = "
            INSERT INTO detalle_pedido (
            pedidos_idpedido,
            platillos_idplatillo,
            precio_venta,
            cantidad
            ) VALUES (
            '$data[id]',
            '$data[idplatillo]',
            '$data[precio]',
            '$data[cantidad]'
            )
        ";

        $this->db->execute_query();

        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;

    }

    public function setAdomicilio($idpedido,$costo){

        $this->db->_query = "UPDATE pedidos SET adomicilio = 1, costo_domicilio = '$costo' WHERE idpedido = '$idpedido' ";
        $this->db->execute_query();

        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;
    }

    public function getDetalleTicket($idpedido){
        $this->db->_query = "
            SELECT 
                b.idpedido,b.idcliente,c.nombre as NombreCliente,c.telefono,b.idmesa,d.nombre as NombreMesa,b.idestatus,b.idusuario_alta,e.nickname as NombreUsuarioAlta,DATE (b.FechaAlta)AS FechaAlta,TIME (b.FechaAlta)AS HoraAlta,
                a.iddetalle,a.platillos_idplatillo,f.nombre as NombrePlatillo,a.precio_venta,f.url_img,
                g.importe_venta,g.importe_pagado,b.costo_domicilio,b.adomicilio,b.direccion,count(a.platillos_idplatillo)as total_cantidad
            FROM 
                detalle_pedido as a 
            LEFT JOIN pedidos as b on a.pedidos_idpedido = b.idpedido 
            LEFT JOIN clientes as c on b.idcliente = c.idcliente
            LEFT JOIN mesas as d on b.idmesa = d.idmesas 
            LEFT JOIN usuarios as e on b.idusuario_alta= e.idusuario 
            LEFT JOIN platillos as f on a.platillos_idplatillo = f.idplatillo 
            LEFT JOIN movimientos as g on b.idpedido= g.idpedido 
            WHERE a.pedidos_idpedido = '$idpedido' GROUP BY a.platillos_idplatillo  ORDER BY b.FechaAlta DESC
        ";

        $this->db->get_result_query(true);
        $this->confirm = $this->db->_confirm;
        $this->message =  $this->db->_message;
        $this->rows = $this->db->_rows;

    }

    public function getPedido($idpedido){
        $this->db->_query = "
            SELECT 
              b.idpedido,b.idcliente,c.nombre as NombreCliente,c.telefono,b.idmesa,d.nombre as NombreMesa,b.idestatus,b.idusuario_alta,e.nickname as NombreUsuarioAlta,DATE (b.FechaAlta)AS FechaAlta,TIME (b.FechaAlta)AS HoraAlta,
              a.iddetalle,a.platillos_idplatillo,f.nombre as NombrePlatillo,a.precio_venta,a.cantidad,f.url_img,b.costo_domicilio,b.adomicilio
            FROM 
              detalle_pedido as a 
            LEFT JOIN pedidos as b on a.pedidos_idpedido = b.idpedido 
            LEFT JOIN clientes as c on b.idcliente = c.idcliente
            LEFT JOIN mesas as d on b.idmesa = d.idmesas 
            LEFT JOIN usuarios as e on b.idusuario_alta= e.idusuario 
            LEFT JOIN platillos as f on a.platillos_idplatillo = f.idplatillo
            WHERE a.pedidos_idpedido = '$idpedido' ORDER BY b.FechaAlta DESC
        ";

        $this->db->get_result_query(true);
        $this->confirm = $this->db->_confirm;
        $this->message =  $this->db->_message;
        $this->rows = $this->db->_rows;

    }

    public function getPedidoCaja($idpedido){
        $this->db->_query = "
            SELECT 
              b.idpedido,b.idcliente,c.nombre as NombreCliente,c.telefono,b.idmesa,d.nombre as NombreMesa,b.idestatus,b.idusuario_alta,e.nickname as NombreUsuarioAlta,b.FechaAlta,
              a.iddetalle,a.platillos_idplatillo,f.nombre as NombrePlatillo,a.precio_venta,a.cantidad,f.url_img,
              (sum(a.precio_venta * a.cantidad) + b.costo_domicilio)as TotalImporte,b.costo_domicilio,b.adomicilio
            FROM 
              detalle_pedido as a 
            LEFT JOIN pedidos as b on a.pedidos_idpedido = b.idpedido 
            LEFT JOIN clientes as c on b.idcliente = c.idcliente
            LEFT JOIN mesas as d on b.idmesa = d.idmesas 
            LEFT JOIN usuarios as e on b.idusuario_alta= e.idusuario 
            LEFT JOIN platillos as f on a.platillos_idplatillo = f.idplatillo
            WHERE a.pedidos_idpedido = '$idpedido' ORDER BY b.FechaAlta DESC
        ";

        $this->db->get_result_query(true);
        $this->confirm = $this->db->_confirm;
        $this->message =  $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    public function setCancelarPlatillo($idplatillo,$idpedido = 0){

        if($idplatillo == "CXS"){
            $this->db->_query = "
            UPDATE pedidos SET adomicilio = 0,costo_domicilio = 0 WHERE idpedido = $idpedido
            ";
        }else{
            $this->db->_query = "DELETE FROM detalle_pedido WHERE iddetalle = '$idplatillo'";
        }

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message =  $this->db->_message;
        $this->rows = $this->db->_rows;

    }

    public  function setCancelarPedido($idpedido,$idusuario,$auth = false){

        //Validar que el pedido sea del mismo dia
        $this->db->_query = "SELECT idestatus,date(FechaAlta)as FechaAlta FROM pedidos WHERE idpedido = '$idpedido'  ";
        $this->db->get_result_query(true);

        if(count($this->db->_rows) > 0 ){

            if($this->db->_rows[0]['idestatus'] == 3){
                $this->rows = array();
                $this->confirm = false;
                $this->message = "El pedido ya se encuentra cancelado";
            }else{

                // Cancelar pedido
                $this->db->_query = "
                UPDATE pedidos 
                    SET idestatus = 3,
                        idusuario_cancela = '$idusuario',
                        FechaCancelacion = now()
                WHERE idpedido = '$idpedido'  
                ";
                $this->db->execute_query();

                if($this->db->_confirm){
                    core::JsonResult("Pedido cancelado correctamente",true,array('auth'=>false));
                }else{
                    $this->rows = $this->db->_rows;
                    $this->confirm = $this->db->_confirm;
                    $this->message = $this->db->_message;
                }

            }
        }else{
            $this->rows = array();
            $this->confirm = false;
            $this->message = "No se encontro el id del pedido";
        }
    }

    public function setCobrarPedido($data = array()){

        $this->db->_query = "
            INSERT INTO movimientos (
            idpedido,tipo_mov,nopago,importe_venta,importe_pagado,tipo_pago,
            pago_efectivo,pago_tarjeta,idestatus,idusuario_alta,FechaAlta
            ) VALUES (
            '$data[idpedido]','$data[tipo_mov]','$data[nopago]','$data[importe_venta]','$data[importe_pagado]',
            '$data[tipo_pago]','$data[pago_efectivo]','$data[pago_tarjeta]','1','$data[idusuario_alta]','$data[FechaVenta]'
            )
        ";

        $this->db->execute_query();
        $this->idmovimiento = $this->db->last_id();

        $this->confirm = $this->db->_confirm;

        if($this->confirm){
            $this->db->_query = "
            UPDATE pedidos 
                SET idestatus = 2 
              WHERE idpedido = '$_POST[idpedido]'
            ";
            $this->db->execute_query();

            $this->confirm = $this->db->_confirm;
            $this->message =  $this->db->_message;

        }else{
            $this->message =  $this->db->_message;
        }

    }

    public function getMovimientos($FechaAtual = true){

        $where = '';

        if($FechaAtual){
            if(date("H:i:s") >= "00:00:00"){

                $FechaAnterior= date("Y-m-d 23:59:00",strtotime(date("Y-m-d")."- 1 days"));
                $where = " WHERE date(a.FechaAlta) = date('$FechaAnterior') ";
            }
        }

        $this->db->_query = "
        SELECT 
            a.idmovimiento,a.idpedido,b.idcliente,concat_ws(' ',c.nombre,c.apellidos)as NombreCliente,if(b.adomicilio = 1,'SI','NO')as adomicilio,
            a.importe_venta,a.importe_pagado,if(a.tipo_pago = 1,'Efectivo','otro')as tipo_pago,
            a.idusuario_alta,d.nickname,a.FechaAlta,b.costo_domicilio
        FROM 
        movimientos as a 
        LEFT JOIN pedidos as b ON a.idpedido = b.idpedido 
        LEFT JOIN clientes as c ON b.idcliente= c.idcliente 
        LEFT JOIN usuarios as d ON a.idusuario_alta = d.idusuario
        $where ORDER BY a.FechaAlta DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message =  $this->db->_message;
        $this->rows =  $this->db->_rows;

    }

}