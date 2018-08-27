<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 04:53 PM
 */
namespace models;

class model_platillos
{
    private $db;
    public $confirm = false;
    public $message = '';
    public $rows = [];

    /**
     * model_platillos constructor.
     * @param $dbcontext
     */
    public function __construct($dbcontext)
    {
        $this->db = $dbcontext;
    }

    public function getPlatillosTopTen($top = 15){

        $this->db->_query = "
        	SELECT 
			count(a.idplatillo)as Totales,
            a.idplatillo,a.nombre,
            a.unidad_medida,b.Descripcion as NombreUnidadMedida,
            a.piezas,
            a.idcategoria,c.Descripcion as NombreCategoria,
            a.idsubcategoria,d.Descripcion as NombreSubCategoria,
            a.precio_venta,a.precio_compra,
            a.idestatus,e.Descripcion as NombreEstatus,
            a.idusuario_alta,f.nickname as UsuarioAlta,
            a.idusuario_um,g.nickname as UsuarioUM,
            a.FechaAlta,
            a.FechaUM,
             a.url_img,
             a.tipo,
             a.idplatillo AS id
        FROM detalle_pedido as dp 
        LEFT JOIN platillos as a ON dp.platillos_idplatillo = a.idplatillo
        LEFT JOIN catalogos as b ON a.unidad_medida = b.opc_catalogo AND b.idcatalogo = 5 
        LEFT JOIN catalogos as c ON a.idcategoria = c.opc_catalogo AND c.idcatalogo = 3 
        LEFT JOIN catalogos as d ON a.idsubcategoria = d.opc_catalogo AND d.idcatalogo = 4 
        LEFT JOIN catalogos as e ON a.idestatus = e.opc_catalogo AND e.idcatalogo = 1 
        LEFT JOIN usuarios as f ON a.idusuario_alta = f.idusuario 
        LEFT JOIN usuarios as g ON a.idusuario_um = g.idusuario 
        WHERE a.idestatus = 1 group by dp.platillos_idplatillo ORDER BY Totales DESC LIMIT 0,$top
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;
        return $this->db->_rows;

    }

    /**
     * Funcion para traer todos los Platillos
     * seleccionados
     * @param $limit
     * @param string $idestatus
     */
    public function getPlatillos($limit,$idestatus = 'all',$opc,$arraySearch){

        if($opc == 1){
            $where = ' WHERE a.idestatus = 1';
        }else{
            $where = ' ';
        }
        if(count($arraySearch) > 0){
            $where = " WHERE ";
            $where3 ='';
            $where2='';
            for($i=0;$i < count($arraySearch);$i++){
                if(count($arraySearch) > $i){
                    $and = " and ";
                }else{
                    $and="";
                }
                if($arraySearch[$i][0] == 'a.txtcadena'){
                    $where2 = " (a.nombre LIKE '%".$arraySearch[$i][1]."%' OR a.telefono LIKE '%".$arraySearch[$i][1]."%' ) AND ";
                }else{
                    $where3 .= $arraySearch[$i][0]."=".$arraySearch[$i][1].$and;
                }
            }
            $where = $where.$where2.$where3;
            $where = substr($where,0,-4);
        }

        $this->db->_query = "
        SELECT 
            a.idplatillo,a.nombre,
            a.unidad_medida,b.Descripcion as NombreUnidadMedida,
            a.piezas,
            a.idcategoria,c.Descripcion as NombreCategoria,
            a.idsubcategoria,d.Descripcion as NombreSubCategoria,
            a.precio_venta,a.precio_compra,
            a.idestatus,e.Descripcion as NombreEstatus,
            a.idusuario_alta,f.nickname as UsuarioAlta,
            a.idusuario_um,g.nickname as UsuarioUM,
            a.FechaAlta,
            a.FechaUM,
             a.url_img,
             a.tipo
        FROM platillos as a 
        LEFT JOIN catalogos as b ON a.unidad_medida = b.opc_catalogo AND b.idcatalogo = 5 
        LEFT JOIN catalogos as c ON a.idcategoria = c.opc_catalogo AND c.idcatalogo = 3 
        LEFT JOIN catalogos as d ON a.idsubcategoria = d.opc_catalogo AND d.idcatalogo = 4 
        LEFT JOIN catalogos as e ON a.idestatus = e.opc_catalogo AND e.idcatalogo = 1 
        LEFT JOIN usuarios as f ON a.idusuario_alta = f.idusuario 
        LEFT JOIN usuarios as g ON a.idusuario_um = g.idusuario 
        WHERE a.idestatus = 1 ORDER BY a.idcategoria ASC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para traer la informacion del platillo, solicitado
     * @param $idPlatillo
     */
    public function getPlatillo($idPlatillo){
        $this->db->_query = "
        SELECT 
            a.idplatillo,a.nombre,
            a.unidad_medida,b.Descripcion as NombreUnidadMedida,
            a.piezas,
            a.idcategoria,c.Descripcion as NombreCategoria,
            a.idsubcategoria,d.Descripcion as NombreSubCategoria,
            a.precio_venta,a.precio_compra,
            a.idestatus,e.Descripcion as NombreEstatus,
            a.idusuario_alta,f.nickname as UsuarioAlta,
            a.idusuario_um,g.nickname as UsuarioUM,
            a.FechaAlta,
            a.FechaUM 
        FROM platillos as a 
        LEFT JOIN catalogos as b ON a.unidad_medida = b.opc_catalogo AND b.idcatalogo = 5 
        LEFT JOIN catalogos as c ON a.idcategoria = c.opc_catalogo AND c.idcatalogo = 3 
        LEFT JOIN catalogos as d ON a.idsubcategoria = d.opc_catalogo AND d.idcatalogo = 4 
        LEFT JOIN catalogos as e ON a.idestatus = e.opc_catalogo AND e.idcatalogo = 1 
        LEFT JOIN usuarios as f ON a.idusuario_alta = f.idusuario 
        LEFT JOIN usuarios as g ON a.idusuario_um = g.idusuario 
        WHERE a.idplatillo = '$idPlatillo'
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para registrar un nuevo platillo
     * @param $data
     */
    public function getRegistrarPlatillo($data){

        $this->db->_query = "
        INSERT INTO platillos (
        nombre,unidad_medida,piezas,idcategoria,idsubcategoria,precio_venta,precio_compra,idestatus,idusuario_alta,idusuario_um,FechaAlta,FechaUM
        ) VALUES ('$data[nombre]','$data[unidad_medida]','$data[piezas]','$data[idcategoria]','$data[idsubcategoria]','$data[precio_venta]','$data[precio_compra]','$data[idestatus]','$data[idusuario]','$data[idusuario]',now(),now())
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;

    }

    /**
     * Funcion para editar el platillo
     * @param $data
     */
    public function getEditarPlatillo($data){

        $this->db->_query = "
        UPDATE platillos 
          SET nombre = '$data[nombre]',
           unidad_medida = '$data[unidad_medida]',
           piezas = '$data[piezas]',
           idcategoria = '$data[idcategoria]',
           idsubcategoria = '$data[idsubcategoria]',
           precio_venta = '$data[precio_venta]',
           precio_compra = '$data[precio_compra]',
           idestatus = '$data[idestatus]',
           idusuario_um = '$data[idusuario]',
           FechaUM = now() 
        WHERE idplatillo = '$data[idplatillo]'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;

    }

    /**
     * Funcion para desactivar el platillo
     * @param $data
     */
    public function getDesactivarPlatillo($data){

        $this->db->_query = "
        UPDATE platillos 
            SET idestatus = 2,
              FechaUM = now(),
              idusuario_um = '$data[idusuario]'
        WHERE idplatillo = '$data[idplatillo]'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
    }
}