<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 04:53 PM
 */

namespace models;


class model_usuarios
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
     * Funcion para traer todos los usuarios
     * seleccionados
     * @param $limit
     * @param string $idestatus
     */
    public function getUsuarios($limit,$idestatus = 'all',$opc,$arraySearch){

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
                    $where2 = " a.nombre LIKE '%".$arraySearch[$i][1]."%' OR a.usuario LIKE '%".$arraySearch[$i][1]."%'  AND ";
                }else{
                    $where3 .= $arraySearch[$i][0]."=".$arraySearch[$i][1].$and;
                }
            }
            $where = $where.$where2.$where3;
            $where = substr($where,0,-4);
        }

        $this->db->_query = "
        SELECT 
                a.idusuario,
                a.nombre,a.apellidos,
                a.nickname,a.usuario,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idperfil, c.Descripcion as NombrePerfil,
                a.FechaAlta
            FROM 
            usuarios as a 
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            LEFT JOIN catalogos as c ON a.idperfil = c.opc_catalogo AND c.idcatalogo = 2  
            $where ORDER BY a.FechaAlta DESC
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message=  $this->db->_query;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para traer la informacion del usuario, solicitado
     * @param $NoUsuario
     */
    public function getUsuario($NoUsuario){
        $this->db->_query = "
        SELECT 
                a.idusuario,
                a.nombre,a.apellidos,
                a.nickname,a.usuario,
                a.password,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idperfil, c.Descripcion as NombrePerfil,
                a.FechaAlta
            FROM 
            usuarios as a 
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            LEFT JOIN catalogos as c ON a.idperfil = c.opc_catalogo AND c.idcatalogo = 2  
          WHERE a.idusuario = '$NoUsuario'
        ";
        $this->db->get_result_query(true);

        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
        $this->rows = $this->db->_rows;
    }

    /**
     * Funcion para registrar un nuevo usuario
     * @param $data
     */
    public function getRegistrarUsuario($data){

        $data['password'] = md5(sha1($data['password']));

        $this->db->_query = "
        call sp_registra(
            '$data[nombre]',
            '$data[apellidos]',
            '$data[nickname]',
            '$data[usuario]',
            '$data[password]',
            '1',
            '$data[idperfil]',
            '$data[idusuario_alta]'
        )";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;

    }

    /**
     * Funcion para editar el usuario
     * @param $data
     */
    public function getEditarUsuario($data){

        $this->db->_query = "
        UPDATE usuarios 
          SET nombre = '$data[nombre]',
           apellidos = '$data[apellidos]',
           nickname = '$data[nickname]',
           password = '$data[password]',
           idestatus = '$data[idestatus]',
           idperfil = '$data[idperfil]' 
        WHERE idusuario = '$data[idusuario]'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;

    }

    /**
     * Funcion para desactivar usuarios
     * @param $NoUsuario
     */
    public function getDesactivarUsuario($NoUsuario){
        $this->db->_query = "
        UPDATE usuarios 
            SET idestatus = 2 
        WHERE idusuario = '$NoUsuario'
        ";

        $this->db->execute_query();
        $this->confirm = $this->db->_confirm;
        $this->message= $this->db->_message;
    }
}