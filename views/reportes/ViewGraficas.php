<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 26/07/2018
 * Time: 11:23 AM
 */


include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_reportes.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_reportes;

$connect = new seguridad();
$NoUsuarioAlta = $_SESSION['DataLogin']['idusuario'];

$model = new model_reportes($connect);

$model->getGraficas('2018-07-01','2018-07-27');
if(count($model->rows) >0){

    $select = true;

    for($i=0;$i<count($model->rows);$i++){
        $data .= "{name:'".$model->rows[$i]['nombre']."',y:".$model->rows[$i]['Total']."},";
    }

}

$dataMeses = $model->getVentasPorMes();

$model->getHistorialVentas();
$DataHistorialVentas = $model->rows;
$mes = '';
$ventaMinima = 0;
if(count($DataHistorialVentas) > 0){
    for($i=0;$i < count($DataHistorialVentas);$i++){



        $mes = $mes .'[Date.UTC('.$DataHistorialVentas[$i][2].','.($DataHistorialVentas[$i][3] - 1).','.$DataHistorialVentas[$i][4].'),'.$DataHistorialVentas[$i][0].'],';
        $Minimos[] =$DataHistorialVentas[$i][0];

    }
    $ventaMinima =  min($Minimos);

}else{
    $mes ="";
    $DataHistorialVentas = 0;
}

$model->getTipoPedidos();
$tioPedido = [];
if(count($model->rows)>0){
    for($i=0;$i<count($model->rows);$i++){

        if($model->rows[$i]['adomicilio'] == 1){
            $tioPedido['Domicilio'] = $model->rows[$i]['Total'];
        }else{
            $tioPedido['Local'] = $model->rows[$i]['Total'];
        }

    }
}
?>
<script>

    Highcharts.setOptions({
        lang: {
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            shortMonths:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
        }
    });

    Highcharts.chart('grap01', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Reporte por platillos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Platillo',
            colorByPoint: true,
            data: [<?=$data?>]
        }]
    });

    Highcharts.chart('grap02', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        colors:['#345375'],
        title: {
            text: 'Venta Mensuales'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: Highcharts.getOptions().lang.shortMonths
        },
        yAxis: {
            title: {
                text: 'Total de ventas'
            }
        },
        series: [{
            name: 'Ventas',
            data: [
                <?=$dataMeses['Ene']?>, <?=$dataMeses['Feb']?>,<?=$dataMeses['Mar']?>,<?=$dataMeses['Abr']?>,
                <?=$dataMeses['May']?>, <?=$dataMeses['Jun']?>,<?=$dataMeses['Jul']?>,<?=$dataMeses['Ago']?>,
                <?=$dataMeses['Sep']?>, <?=$dataMeses['Oct']?>,<?=$dataMeses['Nov']?>,<?=$dataMeses['Dic']?>
            ]
        }]
    });

    Highcharts.chart('grap03', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Tipo de Pedido',
            align: 'center',
            verticalAlign: 'middle',
            y: -125
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        colors: [
            '#0d233a',
            '#FF197F',
            '#77a1e5',
            '#c42525',
            '#a6c96a'],
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%','75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            innerSize: '50%',
            data: [
                ['Local', <?=$tioPedido['Local']?>],
                ['Domicilio', <?=$tioPedido['Domicilio']?>]
            ]
        }]
    });

    Highcharts.chart('grap04', {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'Historial de Ventas'
        },
        colors:['#316465','#2E7B7A'],
        subtitle: {
            text: 'Ventas diarias'
        },
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Ventas'
            },
            labels: {
                formatter: function () {
                    return '$ ' + this.value;
                }
            },
            min: <?=$ventaMinima?>
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'Total $',
            data: [<?=$mes?>]
        }]
    });




    $(".datepicker").datepicker({dateFormat:'yy-mm-dd'});

</script>
<button onclick="getViewReportes()" class="btn btn-default btn-xs" title="Regresar"><i class="fa fa-arrow-left"></i></button>
<input type="text" value="<?=date("Y-m-d")?>" id="fecha01" class="datepicker hidden" style="width: 110px">
<input type="text" value="<?=date("Y-m-d")?>" id="fecha02" class="datepicker hidden" style="width: 110px">
<button onclick="getViewGraficas()" class="btn btn-primary btn-xs" title="Actualizar"><i class="fa fa-refresh"></i></button>


<div class="row row-sm">

    <div class="col-md-12 col-lg-6 col-sm-6 "><div class="card"><div class="card-body" id="grap01"></div></div></div>

    <div class="col-md-12 col-lg-6 col-sm-6 "><div class="card"><div class="card-body" id="grap02"></div></div></div>

    <div class="col-md-12 col-lg-6 col-sm-6 "><div class="card"><div class="card-body" id="grap03"></div></div></div>

    <!-- Segundo renglon -->
    <div class="col-md-12 col-lg-6 col-sm-6 "><div class="card"><div class="card-body" id="grap04"></div></div></div>

    <div class="col-md-12 col-lg-6 col-sm-6 "><div class="card"><div class="card-body" id="grap05"></div></div></div>

    <div class="col-md-12 col-lg-6 col-sm-6 "><div class="card"><div class="card-body" id="grap06"></div></div></div>

</div>