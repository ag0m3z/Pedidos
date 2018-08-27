<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 10:51 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

include "../../model/model_carrito.php";
include "../../model/model_pedidos.php";

use models\model_carrito,
    core\seguridad,
    core\core,
    core\session,
    models\model_pedidos;

core::setTitle('Editar Pedido');

$connect = new seguridad();


?>
<script>
    $("#btnServicioDomicilio").on('click',function(e){
        if($(this).hasClass('btn-success')){
            $(this).removeClass('btn-success').addClass('btn-default');
            $("#servicio_domicilio").prop('checked',false);
            $("#mesa_pedido").val(' ');
        }else{
            getMessage('Servicio a Domicilio','','',500);
            $(this).removeClass('btn-default').addClass('btn-success');
            $("#servicio_domicilio").prop('checked',true);
            $("#mesa_pedido").val('Mesa-Domicilio');
        }
    });

    getMostrarPlatillosEdicion(<?=$_POST['idpedido']?>,2);
    getMostrarPedidos(<?=$_POST['idpedido']?>);

</script>
<div class="row row-xs">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header padding-x3">
                <div class="row row-xs">

                    <div class="col-md-12">
                        <div class="btn-group pull-left btn-group-sm" role="group" >
                            <button type="button" id="btnfolio" value="<?=$_POST['idpedido']?>" disabled class="btn active btn-warning">Folio: <b><?=str_pad($_POST['idpedido'],4,'0',STR_PAD_LEFT)?></b> </button>
                            <button title="Buscar Cliente" type="button" onclick="getBuscarCliente(1)" class="btn btn-sm btn-default"><i class="fa fa-users"></i></button>
                            <button title="Nuevo Cliente" type="button" onclick="getViewRegistrarCliente(1,{frm:'caja'})" class="btn btn-default"><i class="fa fa-user-plus"></i></button>
                            <button title="Re imprimir Ticket" onclick="getViewModalTicket(6)" class="btn btn-sm btn-default"><i class="fa fa-print"></i> </button>
                            <button title="Servicio a Domicilio" onclick="getViewCostoServicio(2)" id="btnServDomicilio" class="btn btn-sm btn-default"><i class="fa fa-motorcycle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row row-xs">
                    <div class="col-md-12 mb-4">
                        <div class="bg-black currency text-center" id="ledcaja" style="text-align: center!important;padding: 6px;height: 70px;font-size: 38px;"> $0.00</div>
                    </div>
                    <div class="row row-xs">
                        <div style="max-height: 30vh" class="col-md-12 scroll-auto table-responsive">
                            <table class="table table-condensed table-striped table-hover">
                                <thead>
                                <tr class="bg-bareylev">
                                    <th>#</th>
                                    <th>producto</th>
                                    <th>$</th>
                                    <th>cant.</th>
                                    <th>total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="" id="list_cart_ventas">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row row-sm">
                    <div class="col-md-7">
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
                            </span>
                            <input type="text" value="1-Cliente Mostrador" id="cliente_pedido" class="form-control text-bold" disabled placeholder="Cliente" aria-describedby="sizing-addon1">
                        </div>

                    </div>
                    <div class="col-md-5 mb-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-cutlery"></i></button>
                            </span>
                            <input type="text" value="Mesa-1" id="mesa_pedido" class="form-control text-bold" disabled placeholder="Mesa: #" aria-describedby="sizing-addon1">
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea id="direccion_pedido" placeholder="Dirección del cliente" title="Dirección del Cliente" class="form-control input-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-md-2 ">
                        <input type="checkbox" readonly title="" id="servicio_domicilio" >
                        <input type="text" value="0" readonly title="" id="costo_domicilio" >
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-default" onclick="getViewPedidos()"><i class="fa fa-list-alt"></i> Pedidos</button>
                        <button class="btn btn-success" onclick="getViewCobrar(<?=$_POST['idpedido']?>)"><i class="fa fa-dollar"></i> Cobrar</button>
                        <button class="btn btn-primary" onclick="getViewPedidos()"><i class="fa fa-save"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-success">
            <div class="box-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> Top 10</a></li>
                    <li role="presentation" class="active"><a href="#platillos" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Platillos</a></li>
                    <li role="presentation"><a href="#extras" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Extras</a></li>
                    <li role="presentation"><a href="#bebidas" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Bebidas</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="home">
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="platillos">
                    </div>
                    <div role="tabpanel" class="tab-pane " id="extras">
                    </div>
                    <div role="tabpanel" class="tab-pane" id="bebidas">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
