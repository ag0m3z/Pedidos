<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 24/07/2018
 * Time: 11:36 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_reportes.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_reportes;

core::HeaderContetType();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $connect = new seguridad();
    $NoUsuarioAlta = $_SESSION['DataLogin']['idusuario'];

    $model = new model_reportes($connect);

    switch ($_POST['route']){

        case 'reporte01': //Venta General

            $model->getReporteGeneral($_POST['FechaInicial'],$_POST['FechaFinal']);
            $_SESSION['EXPORT'] = ['reporte'=>"ventas","data"=> $model->rows];
            core::JsonResult($model->message,$model->confirm,$model->rows);

            break;
        case 'reporte02': //Clientes

            $model->getReporteClientes($_POST['FechaInicial'],$_POST['FechaFinal']);
            $_SESSION['EXPORT'] = ['reporte'=>"clientes","data"=> $model->rows];
            core::JsonResult($model->message,$model->confirm,$model->rows);

            break;
        case 'reporte04': //Reporte de Platillos

            $data = [];
            $_POST['idplatillo'];
            if($_POST['idplatillo'] >0 ){
                $data = array('f.platillos_idplatillo'=>$_POST['idplatillo']);
            }
            if($_POST['idmesero'] >0 ){
                $data += array('idmesero'=>$_POST['idmesero']);
            }

            if($_POST['idcajero'] >0 ){
                $data += array('a.idusuario_alta'=>$_POST['idcajero']);
            }
            if($_POST['idcliente'] >0 ){
                $data += array('b.idcliente'=>$_POST['idcliente']);
            }
            if($_POST['idcategoria'] >0 ){
                $data += array('g.idcategoria'=>$_POST['idcategoria']);
            }
            if($_POST['idsubcategoria'] >0 ){
                $data += array('g.idsubcategoria'=>$_POST['idsubcategoria']);
            }
            if($_POST['adomicilio'] != 'all' ){
                $data += array('b.adomicilio'=>$_POST['adomicilio']);
            }

            $data += array("a.idestatus"=>1);

            $Cond = [];
            $where = [];
            foreach($data as $id=>$valor){

                $valor = "'$valor'";
                $Cond[] = array($id,$valor);
            }

            $size = count($Cond);

            for($i=0;$i <= $size;$i++){
                if($size > $i){
                    $and = " and ";
                }else{
                    $and="";
                }
                $where[] = $Cond[$i][0]."=".$Cond[$i][1].$and;
            }
            $cadena = " AND ". substr($where[0].$where[1].$where[2].$where[3].$where[4].$where[5].$where[6].$where[7].$where[8],0,-5);


            $model->getReportePlatillos($_POST['FechaInicial'],$_POST['FechaFinal'],$cadena);
            $_SESSION['EXPORT'] = ['reporte'=>"platillos","data"=> $model->rows];
            core::JsonResult($model->message,$model->confirm,$model->rows);

            break;
        case 'reporte05': //Cancelaciones

            $model->getReporteCancelaciones($_POST['FechaInicial'],$_POST['FechaFinal'],$_POST['tipocancelacion']);
            $_SESSION['EXPORT'] = ['reporte'=>"cancelaciones","data"=> $model->rows];
            core::JsonResult($model->message,$model->confirm,$model->rows);

            break;
        //Ruta para traer la informacion de la graficas
        case 'graps':
            $data = array('grap1'=>array(),'grap2'=>'','grap3'=>'','grap4'=>'','grap5'=>'','grap6'=>'');
            $model->getGraficas($_POST['fecha1'],$_POST['fecha2']);

            if(count($model->rows) >0){

                $select = true;

                for($i=0;$i<count($model->rows);$i++){
                    $data['grap1'][] = array(
                        'name'=>$model->rows[$i]['nombre'],
                        'y'=>$model->rows[$i]['Total']

                    );
                    $select = false;
                }

            }


            core::JsonResult($model->message,$model->confirm,$data);
            break;
        default:
            core::JsonResult('Ruta no encontrada',false,$_POST);
        break;
    }

}else{
    core::JsonResult('Metodo no soportado');
}