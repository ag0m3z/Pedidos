<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 04:53 PM
 */

namespace models;


class model_mesas
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
     * Funcion para traer todos las mesas
     * seleccionadas
     * @param $limit
     * @param string $idestatus
     */
    public function getMesas($limit,$idestatus = 'all',$opc,$arraySearch){

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
                    $where2 = " a.nombre LIKE '%".$arraySearch[$i][1]."%' AND ";
                }else{
                    $where3 .= $arraySearch[$i][0]."=".$arraySearch[$i][1].$and;
                }
            }
            $where = $where.$where2.$where3;
            $where = substr($where,0,-4);
        }

        $this->db->_query = "
        SELECT 
                a.idmesas,
                a.nombre,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idusuario_alta, c.nickname as UsuarioAlta,
                a.idusuario_um, d.nickname as UsuarioUM,
                a.FechaAlta,a.FechaUM
            FROM 
            mesas as a 
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
     * Funcion para traer la informacion de la mesa, solicitada
     * @param $idmesas
     */
    public function getMesa($idmesas){
        $this->db->_query = "
        SELECT 
                a.idmesas,
                a.nombre,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idusuario_alta, c.nickname as UsuarioAlta,
                a.idusuario_um, d.nickname as UsuarioUM,
                a.FechaAlta,a.FechaUM
            FROM 
            mesas as a 
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            LEFT JOIN usuarios as c ON a.idusuario_alta = c.idusuario
            LEFT JOIN usuarios as d ON a.idusuario_um = d.idusuario 
          WHERE a.idmesas = '$idmesas'
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para registrar un nueva mesa
     * @param $data
     */
    public function getRegistrarMesa($data){

        /**
         * Validar que la mesa no exista
         */

        $this->db->_query = "
            SELECT a.nombre,a.idestatus,b.Descripcion as NombreEstatus FROM mesas as a
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            WHERE a.nombre = '$data[nombre]'
        ";
        $this->db->get_result_query(true);

        if(count($this->db->_rows)>0){
            $this->confirm = false;
            $this->message=  "El nombre de la mesa ya existe, Estatus: ".$this->db->_rows[0]['NombreEstatus'];
            $this->rows = $this->db->_rows;
        }else{
            $this->db->_query = "
            INSERT INTO mesas (
            nombre,idestatus,idusuario_alta,FechaAlta,idusuario_um,FechaUM
            ) VALUES ('$data[nombre]','$data[idestatus]','$data[idusuario]',now(),'$data[idusuario]',now())
            ";

            $this->db->execute_query();
            $this->confirm = $this->db->_confirm;
            $this->message= $this->db->_message;
        }

    }

    /**
     * Funcion para editar la semana
     * @param $data
     */
    public function getEditarMesa($data){

        /**
         * Validar que el nuevo nombre no exista
         */

        $this->db->_query = "
        SELECT a.nombre,a.idestatus,b.Descripcion as NombreEstatus FROM mesas as a
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            WHERE a.nombre = '$data[nombre]' AND a.idmesas <> '$data[idmesas]'
        ";
        $this->db->get_result_query(true);
        if(count($this->db->_rows)> 0){
            $this->confirm = false;
            $this->message= "El nombre de la mesa ya existe, Estatus: ".$data['NombreEstatus'];
        }else{
            $this->db->_query = "
            UPDATE mesas 
              SET nombre = '$data[nombre]',
               idestatus = '$data[idestatus]',
               idusuario_um = '$data[idusuario]',
               FechaUM = now()
            WHERE idmesas = '$data[idmesas]'
        ";
            $this->db->execute_query();

            $this->confirm = $this->db->_confirm;
            $this->message= $this->db->_query;
        }

    }

    /**
     * Funcion para desactivar la Mesa Seleccionada
     * @param $Mesa
     */
    public function getDesactivarMesa($Mesa){
        $this->db->_query = "
        UPDATE mesas 
            SET idestatus = 2,
                idusuario_um = '$Mesa[idusuario]',
                FechaUM = now() 
        WHERE idmesas = '$Mesa[idmesas]'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
    }
}