<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 02/07/2018
 * Time: 10:57 PM
 */

namespace models;


class model_reportes
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

    /**
     * @param null $FechaInicial
     * @param null $FechaFinal
     */
    public function getReporteGeneral($FechaInicial = null,$FechaFinal = null){

        $FechaInicial = ($FechaInicial) ?: date("Y-m-d") ;
        $FechaFinal = ($FechaFinal) ?: date("Y-m-d") ;

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
        WHERE date(a.FechaAlta) >= '$FechaInicial' AND date(a.FechaAlta) <= '$FechaFinal' ORDER BY a.FechaAlta DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message =   $this->db->_message;
        $this->rows =  (object)$this->db->_rows;

    }

    public function getReporteClientes($FechaInicial = null,$FechaFinal = null){

        $FechaInicial = ($FechaInicial) ?: date("Y-m-d") ;
        $FechaFinal = ($FechaFinal) ?: date("Y-m-d") ;

        $this->db->_query = "
        SELECT 
            a.idmovimiento,a.idpedido,b.idcliente,concat_ws(' ',c.nombre,c.apellidos)as NombreCliente,if(b.adomicilio = 1,'SI','NO')as adomicilio,
            sum(a.importe_venta)as importe_venta,a.importe_pagado,if(a.tipo_pago = 1,'Efectivo','otro')as tipo_pago,
            a.idusuario_alta,d.nickname,a.FechaAlta,b.costo_domicilio
        FROM 
        movimientos as a 
        LEFT JOIN pedidos as b ON a.idpedido = b.idpedido 
        LEFT JOIN clientes as c ON b.idcliente= c.idcliente 
        LEFT JOIN usuarios as d ON a.idusuario_alta = d.idusuario
        WHERE date(a.FechaAlta) >= '$FechaInicial' AND date(a.FechaAlta) <= '$FechaFinal' GROUP BY idcliente ORDER BY a.FechaAlta DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message =   $this->db->_message;
        $this->rows =  (object)$this->db->_rows;
    }

    public function getReporteCancelaciones($FechaInicial = null,$FechaFinal = null,$tipoCancelacion = 1){

        $FechaInicial = ($FechaInicial) ?: date("Y-m-d") ;
        $FechaFinal = ($FechaFinal) ?: date("Y-m-d") ;

        switch ($tipoCancelacion){
            case 1:
                $this->db->_query = "
                    SELECT 
                        a.idmovimiento,a.idpedido,b.idcliente,concat_ws(' ',c.nombre,c.apellidos)as NombreCliente,if(b.adomicilio = 1,'SI','NO')as adomicilio,
                        a.importe_venta,a.importe_pagado,if(a.tipo_pago = 1,'Efectivo','otro')as tipo_pago,
                        a.idusuario_alta,d.nickname,a.FechaAlta,b.costo_domicilio,a.FechaCancelacion,e.nickname as CejeroCancelacion
                    FROM 
                    movimientos as a 
                    LEFT JOIN pedidos as b ON a.idpedido = b.idpedido 
                    LEFT JOIN clientes as c ON b.idcliente= c.idcliente 
                    LEFT JOIN usuarios as d ON a.idusuario_alta = d.idusuario
                    LEFT JOIN usuarios as e ON a.idusuario_cancelacion = e.idusuario
                    WHERE date(a.FechaAlta) >= '$FechaInicial' AND date(a.FechaAlta) <= '$FechaFinal' AND a.idestatus = 2 ORDER BY a.FechaAlta DESC
                    ";
                break;
            case 2:
                $this->db->_query = "
                    SELECT 
                        a.idpedido,a.idcliente,concat_ws(' ',c.nombre,c.apellidos)as NombreCliente,
                        if(a.adomicilio = 1,'SI','NO')as adomicilio,(sum(b.precio_venta) + a.costo_domicilio)as importe_venta, (sum(b.precio_venta) + a.costo_domicilio)as importe_pagado,a.costo_domicilio,'No Aplica'as tipo_pago,
                        a.idusuario_alta,d.nickname,a.FechaAlta,a.FechaCancelacion,e.nickname as CejeroCancelacion
                    FROM detalle_pedido as b 
                    LEFT JOIN pedidos as a ON a.idpedido = b.pedidos_idpedido
                    LEFT JOIN clientes as c ON a.idcliente= c.idcliente 
                    LEFT JOIN usuarios as d ON a.idusuario_alta = d.idusuario 
                    LEFT JOIN usuarios as e ON a.idusuario_cancela = e.idusuario
                    WHERE a.idestatus = 3 AND date(a.FechaAlta) >= '$FechaInicial' AND date(a.FechaAlta) <= '$FechaFinal' GROUP BY b.pedidos_idpedido ORDER BY a.FechaAlta DESC";
                break;
        }


        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message =   $this->db->_message;
        $this->rows =  (object)$this->db->_rows;

    }

    public function getReportePlatillos($FechaInicial = null,$FechaFinal = null,$data){

        $FechaInicial = ($FechaInicial) ?: date("Y-m-d") ;
        $FechaFinal = ($FechaFinal) ?: date("Y-m-d") ;


        $this->db->_query = "
        SELECT 
            a.idmovimiento,a.idpedido,f.platillos_idplatillo,g.nombre as NombrePlatillo,g.precio_venta,
            g.idcategoria,h.Descripcion as NombreCategoria,g.idsubcategoria,i.Descripcion as NombreSubCategoria,
            b.idcliente,concat_ws(' ',c.nombre,c.apellidos)as NombreCliente,
            b.idmesa,
            if(b.adomicilio = 1,'SI','NO')as NombreADomicilio,b.adomicilio,
            a.importe_venta,a.importe_pagado,if(a.tipo_pago = 1,'Efectivo','otro')as tipo_pago,
            a.idusuario_alta,d.nickname,a.FechaAlta,b.costo_domicilio,a.FechaCancelacion,e.nickname as CejeroCancelacion
        FROM 
        movimientos as a 
        LEFT JOIN pedidos as b ON a.idpedido = b.idpedido 
        LEFT JOIN clientes as c ON b.idcliente= c.idcliente 
        LEFT JOIN usuarios as d ON a.idusuario_alta = d.idusuario
        LEFT JOIN usuarios as e ON a.idusuario_cancelacion = e.idusuario 
        LEFT JOIN detalle_pedido as f ON a.idpedido = f.pedidos_idpedido 
        LEFT JOIN platillos as g ON f.platillos_idplatillo = g.idplatillo 
        LEFT JOIN catalogos as h ON g.idcategoria = h.opc_catalogo AND h.idcatalogo = 3 
        LEFT JOIN catalogos as i ON g.idsubcategoria = i.opc_catalogo AND i.idcatalogo = 4 
        WHERE date(a.FechaAlta) >= '$FechaInicial' AND date(a.FechaAlta) <= '$FechaFinal' ".$data."  ORDER BY f.platillos_idplatillo DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message =   $this->db->_message;
        $this->rows =  (object)$this->db->_rows;

    }

    public function getGraficas($FechaInicial,$FechaFinal){

        $this->db->_query = "
        SELECT 
            count(b.platillos_idplatillo)as Total,c.nombre
        FROM 
        movimientos as a 
        LEFT JOIN detalle_pedido as b ON a.idpedido = b.pedidos_idpedido 
        LEFT JOIN platillos as c ON c.idplatillo = b.platillos_idplatillo 
        WHERE a.idestatus = 1 AND a.FechaAlta >= '$FechaInicial' AND a.FechaAlta <= '$FechaFinal'
        GROUP BY b.platillos_idplatillo ORDER BY Total DESC LIMIT 0,10 
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message =   $this->db->_message;
        $this->rows =  $this->db->_rows;


    }

    public function getVentasPorMes(){
        $this->db->_query = "
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

        $this->db->get_result_query(true);
        $totalMeses = $this->db->_rows[0];
        if(count($this->db->_rows) == null){
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

        return $totalMeses;
    }

    public function getHistorialVentas(){
        $this->db->_query = "
        SELECT 
          sum(importe_pagado),
          DATE(FechaAlta),
          YEAR(FechaAlta),
          MONTH(FechaAlta),
          DAY(FechaAlta) 
        FROM 
         movimientos 
        WHERE 
          idestatus = 1 
        GROUP BY date(FechaAlta)
        ";
        $this->db->get_result_query();
        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;
        $this->rows = $this->db->_rows;

    }

    public function getTipoPedidos(){

        $this->db->_query = "
        SELECT adomicilio,count(adomicilio)as Total FROM pedidos WHERE idestatus in(1,2) GROUP BY adomicilio
        ";
        $this->db->get_result_query(true);
        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;
        $this->rows = $this->db->_rows;
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


}