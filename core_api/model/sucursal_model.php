<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

namespace App\Model;

use App\Lib\Response;

class SucursalModel
{
    private $db;
    private $table = 'hsdsucursales';
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
     * Metodo para listar todas las sucursales
     */
    public function listar($limite,$pagina){

        $data = $this->db->from($this->table)
            ->limit($limite)
            ->offset($pagina)
            ->orderBy('idsucursal DESC')
            ->fetchAll();
        $total = $this->db->from($this->table)
            ->select('count(idsucursal)as Total')
            ->fetch()
            ->Total;
        return [
            'result'=>true,
            'message'=>'lista de sucursales',
            'data'=>[
                'total'=>$total,
                'rows'=>$data

            ]
        ];
    }

    /**
     * Metodo para solicitar la sucursal solicitada
     */
    public function obtener($id){

        $dataUser = $this->db->from($this->table)
            ->where('idsucursal',$id)
            ->fetch();
        $this->response->data = $dataUser;

        return $this->response->SetResponse(true,'consulta exitosa');

    }


    /**
     * Metoto para registrar nuevas sucursales
     */
    public function registrar($data,$idusuario_alta){

        $dataInsert = [
            'idempresa'=>$data['idempresa'],
            'nombre'=>$data['nombre'],
            'idestatus'=>1,
            'idusuario_alta'=>$idusuario_alta,
            'idusuario_um'=>$idusuario_alta,
            'fecha_registro'=>date('Y-m-d H:i:s'),
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
               return $this->response->SetResponse(false,'La sucursal ya existe');
           }else{
               return $this->response->SetResponse(false,'Error al registrar la sucursal');
           }
       }

        return $this->response->SetResponse(true,'Sucursal registrado correctamente');

    }

    /**
     * Metodo para Acutalizar el registro solicitado
     */
    public function actualizar($data,$idusuario_um){

        $idsucursal = $data['idsucursal'];
        $idempresa = $data['idempresa'];
        $dataInsert = [
            'idempresa'=>$data['idempresa'],
            'nombre'=>$data['nombre'],
            'idusuario_um'=>$idusuario_um,
            'fecha_um'=>date('Y-m-d H:i:s')
        ];

        try{

            $this->db->update($this->table,$dataInsert)->where(array('idsucursal'=>$idsucursal,'idempresa'=>$idempresa))->execute();

        }catch (\Exception $e){

            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'La Sucursal ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar la sucursal');
            }
        }

        $this->response->data = $dataInsert;
        return $this->response->SetResponse(true,'Sucursal actualizado');
    }

    public function desactivar($id,$idusuario_um){

        try{

            $this->db->update($this->table,array('idestatus'=>0,'idusuario_um'=>$idusuario_um,'fecha_um'=>date('Y-m-d H:i:s')))->where('idsucursal',$id)->execute();

        }catch (\Exception $e){
            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'la sucursal ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al desactivar la sucursal');
            }
        }
        return $this->response->SetResponse(true,'consulta exitosa');

    }

}