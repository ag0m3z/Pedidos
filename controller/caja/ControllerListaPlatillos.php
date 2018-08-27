<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 26/06/2018
 * Time: 10:49 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_platillos.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_platillos;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $model = new model_platillos($connect);

    $model->getPlatillos(1000,1,1,[]);


    $top = $model->getPlatillosTopTen();
    $bebidas = array();
    $extras = array();
    $orden = array();

    $data = [
        'top'=>$top,
        'platillos'=>$orden,
        'extras'=>$extras,
        'bebidas'=>$bebidas
    ];

    if(count($model->rows)>0){

        for($i=0;$i < count($model->rows);$i++){

            if($model->rows[$i]['tipo'] == 1){
                //Orden o paquetes
                $orden[] = array(
                    'id'=>$model->rows[$i]['idplatillo'],
                    'nombre'=>$model->rows[$i]['nombre'],
                    'url_img'=>$model->rows[$i]['url_img'],
                    'precio_venta'=>$model->rows[$i]['precio_venta']
                );
            }

            if($model->rows[$i]['tipo'] == 2){
                //Piezas o Extras
                $extras[] = array(
                    'id'=>$model->rows[$i]['idplatillo'],
                    'nombre'=>$model->rows[$i]['nombre'],
                    'url_img'=>$model->rows[$i]['url_img'],
                    'precio_venta'=>$model->rows[$i]['precio_venta']
                );
            }

            if($model->rows[$i]['tipo'] == 3){
                //Bebidas
                $bebidas[] = array(
                    'id'=>$model->rows[$i]['idplatillo'],
                    'nombre'=>$model->rows[$i]['nombre'],
                    'url_img'=>$model->rows[$i]['url_img'],
                    'precio_venta'=>$model->rows[$i]['precio_venta']
                );
            }

        }

        $data = [
            'top'=>$top,
            'platillos'=>$orden,
            'extras'=>$extras,
            'bebidas'=>$bebidas
        ];

        core::JsonResult('consulta exitosa',true,$data);

    }else{
        core::JsonResult('consulta exitosa',true,$data);
    }

}else{
    core::JsonResult("Metodo no soportado",false,[]);
}