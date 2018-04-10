<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

namespace App\Model;

use App\Lib\Response;

class UsuarioModel
{
    private $db;
    private $table = 'hspusuarios';
    private $response;

    /**
     * UsuarioModel constructor.
     * @param $db
     *
     * Constructor que recibe como parametro
     * el objecto de conexion para poder utilizarlo
     *
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }

    /**
     *
     * Metodo para listar los usuarios
     * @param $limite
     * @param $pagina
     * @return array
     */
    public function listar($limite,$pagina){

        $data = $this->db->from($this->table)
            ->limit($limite)
            ->offset($pagina)
            ->orderBy('idusuario DESC')
            ->fetchAll();
        $total = $this->db->from($this->table)
            ->select('count(idusuario)as Total')
            ->fetch()
            ->Total;
        return [
            'result'=>true,
            'message'=>'usuarios',
            'data'=>[
                'total'=>$total,
                'rows'=>$data

            ]
        ];
    }

    /**
     * Metodo para solicitar el usuario solicitado
     * @param $id
     * @return $this
     */
    public function obtener($id){

        $dataUser = $this->db->from($this->table)
            ->where('idusuario',$id)
            ->fetch();
        $this->response->data = $dataUser;

        return $this->response->SetResponse(true,'usuario solicitado');

    }


    /**
     * Metoto para realizar el registro de nuevos usuarios
     */
    public function registrar($data,$idusuario_alta){

        $data['password'] = sha1($data['password']);

        $dataInsert = [
            'idempresa'=>$data['idempresa'],
            'idsucursal'=>$data['idsucursal'],
            'nombre'=>$data['nombre'],
            'usuario'=>$data['usuario'],
            'password'=>$data['password'],
            'idperfil'=>$data['idperfil'],
            'idestatus'=>1,
            'idusuario_alta'=>$idusuario_alta,
            'idusuario_um'=>$idusuario_alta,
            'fecha_alta'=>date('Y-m-d H:i:s'),
            'fecha_um'=>date('Y-m-d H:i:s')
        ];


       try{
           $this->db->insertInto($this->table,$dataInsert)->execute();
       }catch (\Exception $e){
           $this->response->data = [
               'mensaje'=>$e->getMessage(),
               'codigo'=>$e->getCode(),
               'linea'=>$e->getLine()
           ];
           if($e->getCode() == '23000'){
               return $this->response->SetResponse(false,'El Usuario ya existe');
           }else{
               return $this->response->SetResponse(false,'Error al registrar el usuario');
           }
       }

        return $this->response->SetResponse(true,'Usuario registrado correctamente');

    }

    /**
     * @param $data
     * @return $this
     * Metodo para Acutalizar el registro solicitado
     */
    public function actualizar($data){

        $idusuario = $data['idusuario'];


        if(isset($data['password'])){
            $password = sha1($data['password']);
            $dataInsert = [
                'idusuario'=>$data['idusuario'],
                'idempresa'=>$data['idempresa'],
                'idsucursal'=>$data['idsucursal'],
                'nombre'=>$data['nombre'],
                'idperfil'=>$data['idperfil'],
                'password'=>$password
            ];
        }else{
            $dataInsert = [
                'idusuario'=>$data['idusuario'],
                'idempresa'=>$data['idempresa'],
                'idsucursal'=>$data['idsucursal'],
                'nombre'=>$data['nombre'],
                'idperfil'=>$data['idperfil']
            ];
        }

        try{

            $this->db->update($this->table,$dataInsert)->where('idusuario',$idusuario)->execute();

        }catch (\Exception $e){

            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'El Usuario ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar el usuario');
            }
        }

        $this->response->data = $dataInsert;
        return $this->response->SetResponse(true,'Usuario actualizado');
    }

    public function desactivar($id,$idusuario_um){

        try{

            $this->db->update($this->table,array('idestatus'=>0,'idusuario_um'=>$idusuario_um,'fecha_um'=>date('Y-m-d H:i:s')))->where('idusuario',$id)->execute();

        }catch (\Exception $e){
            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'El Usuario ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar el usuario');
            }
        }
        return $this->response->SetResponse(true,'consulta exitosa');

    }

}