<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:29 PM
 */

namespace Auth;


class modelo_auth
{
    private $db;
    public $rows = [];
    public $message = '';
    public $confirm = false;

    public function __construct($dbContext)
    {
        $this->db = $dbContext;
    }

    public function getUsuario($data){

        $this->db->_query = "
            SELECT 
                a.idusuario,
                a.nombre,a.apellidos,
                a.nickname,a.usuario,a.password,
                a.idestatus,b.Descripcion as NombreEstatus,
                a.idperfil, c.Descripcion as NombrePerfil,
                d.tema,d.imgMenu,
                d.NombreEmpresa,d.Colonia,d.Calle,d.Telefono1,d.Telefono2,d.Celular,d.Logo,
                d.HoraCierreSistema
            FROM 
            usuarios as a 
            LEFT JOIN catalogos as b ON a.idestatus = b.opc_catalogo AND b.idcatalogo = 1
            LEFT JOIN catalogos as c ON a.idperfil = c.opc_catalogo AND c.idcatalogo = 2 
            LEFT JOIN config as d ON 1 = d.idKey 
            where a.usuario = '$data[usuario]' 
        ";

        $this->db->get_result_query(true);
        $this->rows = $this->db->_rows;

    }

    public function getAccesos($NoUSuario){

        $this->db->_query = "
        select 
                    b.TipoOpcion,b.Orden,b.Nombre,b.Icono,b.Funcion,b.Parametros,
                    a.Leer,a.Crear,a.Actualizar,a.Borrar,a.Reportes,a.Importar,a.Exportar,b.idestado
                from accesos as a 
                left join modulos as b 
                on a.idmodulo = b.idmodulo AND a.idOpcion = b.idOpcion
                where a.idusuario = $NoUSuario AND b.idestado = 1 ORDER By b.Orden ASC
        ";
        $this->db->get_result_query(true);
        $this->rows = $this->db->_rows;

    }

}