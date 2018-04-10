<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

namespace App\Model;

use App\Lib\Response;

class MesaModel
{
    private $db;
    private $table = 'hspmesas';
    private $response;

    /**
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
     * Metodo para listar las mesas
     * @param $limite
     * @param $pagina
     * @return array
     */
    public function listar($limite,$pagina){

        $data = $this->db->from($this->table)
            ->limit($limite)
            ->offset($pagina)
            ->orderBy('idmesa DESC')
            ->fetchAll();
        $total = $this->db->from($this->table)
            ->select('count(idmesa)as Total')
            ->fetch()
            ->Total;
        return [
            'result'=>true,
            'message'=>'consulta exitosa',
            'data'=>[
                'total'=>$total,
                'rows'=>$data

            ]
        ];
    }

    /**
     * Metodo para solicitar la mesa solicitada
     * @param $id
     * @return $this
     */
    public function obtener($id){

        $dataUser = $this->db->from($this->table)
            ->where('idmesa',$id)
            ->fetch();
        $this->response->data = $dataUser;

        return $this->response->SetResponse(true,'mesa solicitado');

    }


    /**
     * Metoto para realizar el registro de nuevas Empresas
     */
    public function registrar($data,$idusuario_alta){

        $idempresa = $data['idempresa'];

        $datamesa = $this->db->from($this->table)
            ->where('idempresa',$idempresa)
            ->where('tipo',$data['tipo'])
            ->where('numero_mesa',$data['numero_mesa'])
            ->fetch();

        if(is_object($datamesa)){
            return $this->response->SetResponse(false,'El numero de la mesa ya existe');
        }

        $dataInsert = [
            'idempresa'=>$idempresa,
            'numero_mesa'=>$data['numero_mesa'],
            'tipo'=>$data['tipo'],
            'nombre'=>$data['nombre'],
            'idestatus'=>1,
            'idusuario_alta'=>$idusuario_alta,
            'fecha_alta'=>date('Y-m-d H:i:s')
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
               return $this->response->SetResponse(false,'La mesa ya existe');
           }else{
               return $this->response->SetResponse(false,'Error al registrar la mesa');
           }
       }

        return $this->response->SetResponse(true,'Mesa registrada correctamente');

    }

    /**
     * Metodo para Acutalizar el registro solicitado
     */
    public function actualizar($data,$idusuario_alta){

        $idmesa = $data['idmesa'];

        $datamesa = $this->db->from($this->table)
            ->where('idmesa <> ? ',$idmesa)
            ->where('tipo',$data['tipo'])
            ->where('numero_mesa',$data['numero_mesa'])
            ->fetch();

        if(is_object($datamesa)){
            return $this->response->SetResponse(false,'El numero de la mesa ya existe');
        }


        $dataInsert = [
            'idempresa'=>$data['idempresa'],
            'numero_mesa'=>$data['numero_mesa'],
            'tipo'=>$data['tipo'],
            'nombre'=>$data['nombre'],
            'idestatus'=>$data['idestatus'],
            'fecha_um'=>date('Y-m-d H:i:s'),
            'idusuario_um'=>$idusuario_alta
        ];

        try{

            $this->db->update($this->table,$dataInsert)->where('idmesa',$idmesa)->execute();

        }catch (\Exception $e){

            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'La mesa ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar la mesa');
            }
        }

        $this->response->data = $dataInsert;
        return $this->response->SetResponse(true,'Mesa actualizada');
    }

    /**
     * Desactivar Empresa
     */
    public function desactivar($id,$idusuario_um){

        try{

            $this->db->update($this->table,array('idestatus'=>0,'idusuario_um'=>$idusuario_um,'fecha_um'=>date('Y-m-d H:i:s')))->where('idmesa',$id)->execute();

        }catch (\Exception $e){
            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'La mesa ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar la mesa');
            }
        }
        return $this->response->SetResponse(true,'consulta exitosa');

    }

}