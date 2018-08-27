<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 04/07/2018
 * Time: 11:53 PM
 */


include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_pedidos.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_pedidos;

$connect = new seguridad();
$model = new model_pedidos($connect);

$NoFolio = $_POST['idpedido'];
$model->getPedidoCaja($NoFolio);
$dataPedido = $model->rows;

?>
<script>
    if(<?=$NoFolio?>>0){
        setOpenModal('mdlCaja',true,false);
        $(".currency").numeric();
        $(".form-control").focus(function(){
            $(this).select();
        });

        $("#importe_pagado").on("keyup",function(e){

            if(e.keyCode == 13){
                $("#idbotoncobrar").click();
            }

        });

        setTimeout(function () {
            $("#importe_pagado").select();
        },200);

    }else{
        MyAlert("Pedido no encontrado, seleccione un pedido antes de cobrar");
    }

</script>
<div class="modal fade" id="mdlCaja">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                Caja - <?=$NoFolio?>
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-md-12 text-center">
                        <b style="font-size: 24px">Folio: <?=str_pad($NoFolio,4,'0',0)?> </b>
                    </div>
                    <div class="col-md-12 control_cobrar">
                        <div class="form-group">
                            Tipo de Pago
                            <select class="form-control" disabled title="Tipo de Pago">
                                <option value="1">Efectivo</option>
                                <option value="2">Tarjeta</option>
                                <option value="3">Combinado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group has-error">
                            <label class="text-red">Total a pagar</label>
                            <input id="importe_total"  class="form-control input-lg text-bold currency bg-pink" style="text-align: center !important;" disabled value="<?=$dataPedido[0]['TotalImporte']?>" title="Total a Pagar">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <label>Efectivo</label>
                            <input id="importe_pagado" type="number" class="form-control input-lg text-bold " style="text-align: center !important;" title="Importe">
                        </div>
                    </div>
                    <div class="col-md-12 control_cambio hidden">
                        <div class="form-group has-warning">
                            <label>Cambio</label>
                            <input id="importe_cambio" readonly class="form-control currency input-lg text-bold " style="text-align: center !important;" title="Cambio">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" id="idbotoncobrar" onclick="setCobrarPedido(<?=$NoFolio?>)"><i class="fa fa-dollar"></i> Cobrar</button>
                <button class="btn btn-sm btn-danger pull-right" onclick="setCloseModal('mdlCaja')"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
