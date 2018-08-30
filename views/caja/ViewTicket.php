<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 11/07/2018
 * Time: 12:10 AM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";
include "../../model/model_pedidos.php";
require_once '../../plugins/html2pdf/html2pdf.class.php';

use core\core,
    core\session,
    core\seguridad,
    models\model_pedidos;

$width_in_mm = 65;

$totalRegistros = 0;
$font = 11;
$Folio = core::getFormatFolio($_REQUEST['qp'],10);

$connect = new seguridad();
$model = new model_pedidos($connect);

$model->getDetalleTicket($Folio);
$totalRegistros = count($model->rows);
$data = $model->rows;

if($data[0]['adomicilio'] == 1) {
    $height_in_mm = 94;
}else{
    $height_in_mm = 75;
}
for($i=0;$i< $totalRegistros;$i++){
    if($totalRegistros != $i){
        $height_in_mm += 4;
    }
}
ob_start();
?>
<page backtop="40mm"  backbottom="15mm" >
    <page_header >
        <table style="width: 100%">
            <tr>
                <td colspan="2" style="text-align: center; width: 100% ">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <p style="font-size: <?=$font?>px">
                        <span style="font-size: <?=$font+5?>px" ><?=session::get('DataHome','NombreEmpresa')?></span><br>
                        <span style="font-size: <?=$font?>px">Direccion <?=session::get('DataHome','Calle')?><br> <?=session::get('DataHome','Colonia')?></span><br>
                        <span style="font-size: <?=$font?>px">Telefono: <?=session::get('DataHome','Telefono1')?></span><br>
                        <span style="font-size: <?=$font?>px">Fecha: <?=$data[0]['FechaAlta']?> - <?=$data[0]['HoraAlta']?></span><br>
                        <span style="font-size: <?=$font?>px">Txn: <?=$Folio?></span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <span style="font-size: <?=$font+8?>px;font-weight: bold;">Nota: <?=$_REQUEST['qp']?></span>
                </td>
            </tr>
            <tr>
                <td style="font-size:<?=$font?>px" >Cajero: <?=$data[0]['NombreUsuarioAlta']?></td>
                <td style="text-align: right;font-size:<?=$font?>px">Mesa: <?=$data[0]['idmesa']?></td>
            </tr>
        </table>
    </page_header>
        <table style="width: 100%;">
            <tr style="font-size: 9px;">
                <td style="width: 10%;padding: 5px; border-top: 1px dashed #000;border-bottom: 1px dashed #000" >Cant</td>
                <td style="width: 54%; border-top: 1px dashed #000;border-bottom: 1px dashed #000">Descripcion</td>
                <td style="width: 18%; border-top: 1px dashed #000;border-bottom: 1px dashed #000">Precio</td>
                <td style="width: 18%; border-top: 1px dashed #000;border-bottom: 1px dashed #000">Total</td>
            </tr>
            <?php
            if($totalRegistros > 0){
                for($i=0;$i < $totalRegistros;$i++){
                    echo '<tr style="font-size: 8px">
                            <td style="width: 10%">'.$data[$i]['total_cantidad'].'</td>
                            <td style="width: 54%">'.$data[$i]['NombrePlatillo'].'</td>
                            <td style="width: 18%"> '.core::getFormatoMoneda($data[$i]['precio_venta'],false).'</td>
                            <td style="width: 18%"> '.core::getFormatoMoneda(($data[$i]['total_cantidad'] * $data[$i]['precio_venta'] ) ,false).'</td>
                        </tr>';
                }
                if($data[0]['adomicilio'] == 1){
                    echo '<tr style="font-size: 8px"><td  style="width: 10%">1</td><td  style="width: 10%">Costo Domicilio</td>
                            <td style="width: 18%"> '.core::getFormatoMoneda($data[0]['costo_domicilio'],false).'</td>
                            <td style="width: 18%"> '.core::getFormatoMoneda($data[0]['costo_domicilio'],false).'</td>
                          </tr>';
                }
            }
            ?>
            <tr style="font-size: 8px">
                <td style="width: 10%;border-top: 1px dashed #000;"></td>
                <td style="width: 54%;border-top: 1px dashed #000;"></td>
                <td style="width: 18%;border-top: 1px dashed #000;">Total:</td>
                <td style="width: 18%;border-top: 1px dashed #000;"> <?=core::getFormatoMoneda($data[0]['importe_venta'],false)?></td>
            </tr>
            <tr style="font-size: 8px">
                <td style="width: 10%"></td>
                <td style="width: 54%"></td>
                <td style="width: 18%">Recibido:</td>
                <td style="width: 18%"> <?=core::getFormatoMoneda($data[0]['importe_pagado'],false)?></td>
            </tr>
            <tr style="font-size: 8px">
                <td style="width: 10%"></td>
                <td style="width: 54%"></td>
                <td style="width: 18%">Cambio:</td>
                <td style="width: 18%"> <?=core::getFormatoMoneda(($data[0]['importe_pagado'] - $data[0]['importe_venta']),false)?></td>
            </tr>
        </table>
    <page_footer>
        <?php
        if($data[0]['adomicilio'] == 1){
            echo '<p style="text-align: left;font-size: 9px" >
                    Cliente: '.$data[0]['NombreCliente'].'<br>Telefono: '.$data[0]['telefono'].'<br>Dirección: '.$data[0]['direccion'].'
                  Aladlldasladsl aksdladsllakladsldsldskldks <br>kadskjdskadskladsjkldsjlkadsklasdjkjalsdkjlkajds</p>';
        }
        ?>
        <p style="text-align: center;font-size: 9px;margin-bottom: 5px;" >
            <br>
            Gracias por Su Visita !<br>
            Contamos con Servicio a Domicilio <br>
            Telefono: <?=session::get('DataHome','Telefono1')?><br><br>
        </p>
    </page_footer>

</page>
<?php
$content = ob_get_clean();
$pdf = new HTML2PDF('P',array($width_in_mm,$height_in_mm),'es',true,'UTF-8',2);
$pdf->pdf->SetDisplayMode('real');
$pdf->writeHTML($content);
$pdf->pdf->IncludeJS('print(TRUE)');
$pdf->output('NotaDeVenta'.date("YmdHis").'.pdf');