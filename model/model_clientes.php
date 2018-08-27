<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 04:53 PM
 */

namespace models;


class model_clientes
{
    private $db;
    public $confirm = false;
    public $message = '';
    public $rows = [];

    public function __construct($dbcontext)
    {
        $this->db = $dbcontext;
    }

    /**
     * Funcion para traer todos los Clientes
     * seleccionados
     * @param $limit
     * @param string $idestatus
     */
    public function getClientes($limit,$idestatus = 'all',$opc,$arraySearch){

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
                a.idcliente,
                a.nombre,a.apellidos,
                a.correo,a.telefono,a.celular,a.direccion,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idusuario_alta,c.nickname as UsuarioAlta,
                a.idusuario_um,d.nickname as UsuarioUM,
                a.FechaAlta,a.FechaUM
            FROM 
            clientes as a 
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            LEFT JOIN usuarios as c ON a.idusuario_alta = c.idusuario 
            LEFT JOIN usuarios as d ON a.idusuario_um = d.idusuario 
            $where ORDER BY a.FechaAlta DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para traer la informacion del cliente, solicitado
     * @param $idCliente
     */
    public function getCliente($idCliente){
        $this->db->_query = "
        SELECT 
                a.idcliente,
                a.nombre,a.apellidos,
                a.correo,a.telefono,a.celular,a.direccion,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idusuario_alta,c.nickname as UsuarioAlta,
                a.idusuario_um,d.nickname as UsuarioUM,
                a.FechaAlta,a.FechaUM
            FROM 
            clientes as a 
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            LEFT JOIN usuarios as c ON a.idusuario_alta = c.idusuario 
            LEFT JOIN usuarios as d ON a.idusuario_um = d.idusuario 
            WHERE a.idcliente = '$idCliente' ORDER BY a.FechaAlta DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para registrar un nuevo cliente
     * @param $data
     */
    public function getRegistrarCliente($data){

        $this->db->_query = "
        INSERT INTO clientes (
        nombre,apellidos,correo,telefono,celular,direccion,idestatus,idusuario_alta,FechaAlta,idusuario_um,FechaUM
        ) VALUES ('$data[nombre]','$data[apellidos]','$data[correo]','$data[telefono]','$data[celular]','$data[direccion]','$data[idestatus]','$data[idusuario]',now(),'$data[idusuario]',now())
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;

        $this->db->_query = "SELECT @@identity as idcliente";
        $this->db->get_result_query(true);
        $this->confirm = $this->db->_confirm;
        $this->rows = $this->db->_rows[0];
        $this->message= $this->db->_message;
    }

    /**
     * Funcion para editar el cliente
     * @param $data
     */
    public function getEditarCliente($data){

        $this->db->_query = "
        UPDATE clientes 
          SET nombre = '$data[nombre]',
           apellidos = '$data[apellidos]',
           direccion = '$data[direccion]',
           telefono = '$data[telefono]',
           celular = '$data[celular]',
           correo = '$data[correo]',
           idestatus = '$data[idestatus]',
           idusuario_um = '$data[idusuario]',
           FechaUM = now() 
        WHERE idcliente = '$data[idcliente]'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;

    }

    /**
     * Funcion para desactivar el Cliente
     * @param $data
     */
    public function getDesactivarCliente($data){

        $this->db->_query = "
        UPDATE clientes 
            SET idestatus = 2,
              FechaUM = now(),
              idusuario_um = '$data[idusuario]'
        WHERE idcliente = '$data[idcliente]'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
    }
}