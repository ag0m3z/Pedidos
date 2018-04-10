<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

namespace App\Model;

use App\Lib\Response;

class PlatilloModel
{
    private $db;
    private $table = 'hspplatillo';
    private $response;

    /**
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
     * Metodo para listar los platillos
     * @param $limite
     * @param $pagina
     * @return array
     */
    public function listar($limite,$pagina){

        $data = $this->db->from($this->table)
            ->limit($limite)
            ->offset($pagina)
            ->orderBy('idplatillo DESC')
            ->fetchAll();
        $total = $this->db->from($this->table)
            ->select('count(idplatillo)as Total')
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
     * Metodo para solicitar el platillo
     * @param $id
     * @return $this
     */
    public function obtener($id){

        $dataUser = $this->db->from($this->table)
            ->where('idplatillo',$id)
            ->fetch();
        $this->response->data = $dataUser;

        return $this->response->SetResponse(true,'Platillo solicitado');

    }


    /**
     * Metoto para realizar el registro de nuevos usuarios
     */
    public function registrar($data,$idusuario_alta){


        $dataInsert = [
            'idempresa'=>$data['idempresa'],
            'nombre'=>$data['nombre'],
            'tipo'=>$data['tipo'],
            'categoria'=>$data['categoria'],
            'subcategoria'=>$data['subcategoria'],
            'precio_venta'=>$data['precio_venta'],
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
               return $this->response->SetResponse(false,'El platillo ya existe');
           }else{
               return $this->response->SetResponse(false,'Error al registrar el platillo');
           }
       }

       $this->response->data = $dataInsert;
        return $this->response->SetResponse(true,'Platillo registrado correctamente');

    }

    /**
     * @param $data
     * @return $this
     * Metodo para Acutalizar el registro solicitado
     */
    public function actualizar($data,$idusuario_um){

        $idplatillo = $data['idplatillo'];

        $dataInsert = [
            'idplatillo'=>$data['idplatillo'],
            'idempresa'=>$data['idempresa'],
            'nombre'=>$data['nombre'],
            'tipo'=>$data['tipo'],
            'categoria'=>$data['categoria'],
            'subcategoria'=>$data['subcategoria'],
            'precio_venta'=>$data['precio_venta'],
            'idestatus'=>$data['idestatus'],
            'idusuario_um'=>$idusuario_um,
            'fecha_um'=>date('Y-m-d H:i:s')
        ];

        try{

            $this->db->update($this->table,$dataInsert)->where('idplatillo',$idplatillo)->execute();

        }catch (\Exception $e){

            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'El platillo ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar el platillo');
            }
        }

        $this->response->data = $dataInsert;
        return $this->response->SetResponse(true,'Platillo actualizado');
    }

    public function desactivar($id,$idusuario_um){

        try{

            $this->db->update($this->table,array('idestatus'=>0,'idusuario_um'=>$idusuario_um,'fecha_um'=>date('Y-m-d H:i:s')))->where('idplatillo',$id)->execute();

        }catch (\Exception $e){
            $this->response->data = [
                'mensaje'=>$e->getMessage(),
                'codigo'=>$e->getCode(),
                'linea'=>$e->getLine()
            ];

            if($e->getCode() == '23000'){
                return $this->response->SetResponse(false,'El platillo ya existe');
            }else{
                return $this->response->SetResponse(false,'Error al registrar el platillo');
            }
        }
        return $this->response->SetResponse(true,'consulta exitosa');

    }

}