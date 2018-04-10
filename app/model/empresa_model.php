<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

namespace App\Model;

use App\Lib\Response;

class EmpresaModel
{
    private $db;
    private $table = 'hspempresas';
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
     * Metodo para listar las empresas
     * @param $limite
     * @param $pagina
     * @return array
     */
    public function listar($limite,$pagina){

        $data = $this->db->from($this->table)
            ->limit($limite)
            ->offset($pagina)
            ->orderBy('idempresa DESC')
            ->fetchAll();
        $total = $this->db->from($this->table)
            ->select('count(idempresa)as Total')
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
     * Metodo para solicitar la empresa solicitado
     * @param $id
     * @return $this
     */
    public function obtener($id){

        $dataUser = $this->db->from($this->table)
            ->where('idempresa',$id)
            ->fetch();
        $this->response->data = $dataUser;

        return $this->response->SetResponse(true,'empresa solicitado');

    }


    /**
     * Metoto para realizar el registro de nuevas Empresas
     */
    public function registrar($data){


        $dataInsert = [
            'nombre'=>$data['nombre'],
            'licencia'=>md5($data['nombre']).".".sha1(date('Y-m-d H:i:s')),
            'fecha'=>date('Y-m-d H:i:s'),
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
               return $this->response->SetResponse(false,'La empresa ya existe');
           }else{
               return $this->response->SetResponse(false,'Error al registrar la empresa');
           }
       }

        return $this->response->SetResponse(true,'Empresa registrada correctamente');

    }

    /**
     * @param $data
     * @return $this
     * Metodo para Acutalizar el registro solicitado
     */
    public function actualizar($data){

        $idcliente = $data['idempresa'];


        $dataInsert = [
            'nombre'=>$data['nombre']
        ];

        try{

            $this->db->update($this->table,$dataInsert)->where('idempresa',$idcliente)->execute();

        }catch (\Exception $e){

            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'La Empresa ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar la empresa');
            }
        }

        $this->response->data = $dataInsert;
        return $this->response->SetResponse(true,'empresa actualizado');
    }

    /**
     * Desactivar Empresa
     */
    public function desactivar($id,$idusuario_um){

        return $this->response->SetResponse(true,'consulta exitosa');

    }

}