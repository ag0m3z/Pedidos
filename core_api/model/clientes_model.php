<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

namespace App\Model;

use App\Lib\Response;

class ClienteModel
{
    private $db;
    private $table = 'hspclientes';
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
     * Metodo para listar los clientes
     * @param $limite
     * @param $pagina
     * @return array
     */
    public function listar($limite,$pagina){

        $data = $this->db->from($this->table)
            ->limit($limite)
            ->offset($pagina)
            ->orderBy('idcliente DESC')
            ->fetchAll();
        $total = $this->db->from($this->table)
            ->select('count(idcliente)as Total')
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
     * Metodo para solicitar el cliente solicitado
     * @param $id
     * @return $this
     */
    public function obtener($id){

        $dataUser = $this->db->from($this->table)
            ->where('idcliente',$id)
            ->fetch();
        $this->response->data = $dataUser;

        return $this->response->SetResponse(true,'cliente solicitado');

    }


    /**
     * Metoto para realizar el registro de nuevos clientes
     */
    public function registrar($data,$idusuario_alta){


        $dataInsert = [
            'idempresa'=>$data['idempresa'],
            'nombre'=>$data['nombre'],
            'telefono'=>$data['telefono'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion'],
            'entre_calles'=>$data['entre_calles'],
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
               return $this->response->SetResponse(false,'El cliente ya existe');
           }else{
               return $this->response->SetResponse(false,'Error al registrar el cliente');
           }
       }

        return $this->response->SetResponse(true,'Cliente registrado correctamente');

    }

    /**
     * @param $data
     * @return $this
     * Metodo para Acutalizar el registro solicitado
     */
    public function actualizar($data,$idusuario_um){

        $idcliente = $data['idcliente'];


        $dataInsert = [
            'idcliente'=>$data['idcliente'],
            'idempresa'=>$data['idempresa'],
            'nombre'=>$data['nombre'],
            'telefono'=>$data['telefono'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion'],
            'entre_calles'=>$data['entre_calles'],
            'idestatus'=>$data['idestatus'],
            'idusuario_um'=>$idusuario_um,
            'fecha_um'=>date('Y-m-d H:i:s')
        ];

        try{

            $this->db->update($this->table,$dataInsert)->where('idcliente',$idcliente)->execute();

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

    /**
     * Desactivar el cliente
     */
    public function desactivar($id,$idusuario_um){

        try{

            $this->db->update($this->table,array('idestatus'=>0,'idusuario_um'=>$idusuario_um,'fecha_um'=>date('Y-m-d H:i:s')))->where('idcliente',$id)->execute();

        }catch (\Exception $e){
            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'El cliente ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar el cliente');
            }
        }
        return $this->response->SetResponse(true,'consulta exitosa');

    }

}