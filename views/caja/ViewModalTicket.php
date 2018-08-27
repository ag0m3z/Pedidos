<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 04/07/2018
 * Time: 12:23 AM
 */
?>
<script>
    setOpenModal('mdlImprimirTicket',true,true);

    $("#idpedido").on("keyup",function(e){
       if(e.keyCode == 13){
           getBuscarPedido();
       }
    });
    $("#idpedido").on('focus',function () {
       $(this).select();
    });
    $("#btnImprimirTicket").on('click',function () {
       if($("#estatus_pedido").val() == 1){
           MyAlert("El pedido no ha sido cobrado");
       }else{
           setCrearTicket($("#idorden_pedido").val());
       }
    });
</script>
<div class="modal fade" id="mdlImprimirTicket">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <div class="row row-sm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Folio</label>
                            <input type="number" id="idpedido" title="Numero de Folio" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-hashtag"></i></button>
                                </span>
                                <input type="text" id="idorden_pedido" class="form-control text-bold" disabled placeholder="No Orden" aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
                                </span>
                                <input type="text" id="cliente_pedido" class="form-control text-bold" disabled placeholder="Cliente" aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-phone"></i></button>
                                </span>
                                <input type="text" id="telefono_pedido" class="form-control text-bold" disabled placeholder="Telefono" aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-cutlery"></i></button>
                                </span>
                                <input type="text" id="mesa_pedido" class="form-control text-bold" disabled placeholder="Mesa" aria-describedby="sizing-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                            <tr>
                                <th colspan="2">Nombre</th>
                                <th class="text-right">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody id="lista_detalle_pedido">
                            </tbody>
                        </table>
                        <input type="number" class="hidden" readonly id="estatus_pedido">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-info" id="btnImprimirTicket" ><i class="fa fa-print"></i> Imprimir </button>
                <button class="btn btn-sm pull-right btn-danger" onclick="setCloseModal('mdlImprimirTicket')" ><i class="fa fa-close"></i> Cerrar </button>
            </div>
        </div>
    </div>
</div>
