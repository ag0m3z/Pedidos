<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 10:51 PM
 */

include "../../core/core.php";
include "../../core/session.php";

include "../../model/model_carrito.php";

use models\model_carrito;

\core\core::setTitle('Caja');

unset($_SESSION['cart']);

if($_SESSION['DataLogin']['idperfil'] == 1 || $_SESSION['DataLogin']['idperfil'] == 2){
    $btnCobrar = '<button class="btn btn-success" onclick="setCrearPedido(2)"><i class="fa fa-dollar"></i> Cobrar</button>';
}

?>
<script>

    $("#btncliente").on('click',function(){

        $("#cliente_pedido").val("1-Cliente Mostrador");
        $("#direccion_pedido").val('');

    });

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
    getMostrarPlatillos(1);
</script>

<div class="callout hidden callout-danger">
    <h4>    <i class="fa fa-exclamation-triangle"></i> No se ha realizado el cierre del dia anterior
    </h4>
    <small>ultimo dia cierre: 22/07/2018</small>
</div>

<div class="callout hidden callout-success">
    <h4>    <i class="fa fa-check"></i> No se ha realizado el cierre del dia anterior
    </h4>
    <small>ultimo dia cierre: 22/07/2018</small>
</div>
<div id="content_caja">
    <div class="row row-xs">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header padding-x3">
                    <div class="row row-xs">
                        <div class="col-md-12">
                            <div class="btn-group pull-left btn-group-sm" role="group" >
                                <button title="Nuevo Pedido" onclick="getViewCaja()"  class="btn btn-sm btn-info"><i class="fa fa-file"></i></button>
                                <button title="Buscar Cliente" type="button" onclick="getBuscarCliente(1)" class="btn btn-sm btn-default"><i class="fa fa-users"></i></button>
                                <button title="Nuevo Cliente" type="button" onclick="getViewRegistrarCliente(1,{frm:'caja'})" class="btn btn-default"><i class="fa fa-user-plus"></i></button>
                                <button title="Lista de Pedidos" onclick="getViewPedidos()" class="btn btn-sm btn-default"><i class="fa fa-list"></i> Pedidos</button>
                                <button title="Re imprimir Ticket" onclick="getViewModalTicket(6)" class="btn btn-sm btn-default"><i class="fa fa-print"></i> </button>
                                <div class="btn-group" role="group">
                                    <button title="Movimientos" type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-calculator"></i> Movimientos
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" onclick="getViewMovimientos(1)">Movimientos Diarios</a></li>
                                        <li><a href="#" onclick="getViewMovimientos(1)">Corte Diario</a></li>
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle no-circle" data-toggle="dropdown">Cancelaciones</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Pedidos</a></li>
                                                <li><a href="#">Ventas</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle no-circle" data-toggle="dropdown">Caja</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Apertura</a></li>
                                                <li><a href="#">Cierre</a></li>
                                                <li class="divider no-padding no-margin"></li>
                                                <li><a href="#">Entradas</a></li>
                                                <li><a href="#">Salidas</a></li>
                                                <li class="divider no-padding no-margin"></li>
                                                <li><a href="#">Retiro</a></li>
                                                <li><a href="#">Aportaciones</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </div>

                                <button title="Servicio a Domicilio" onclick="getViewCostoServicio(1)" id="btnServDomicilio" class="btn btn-sm btn-default"><i class="fa fa-motorcycle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body" style="height: 56vh">
                    <div class="row row-xs">
                        <div class="col-md-12 mb-4">
                            <div class="bg-black currency text-center" id="ledcaja" style="text-align: center!important;padding: 6px;height: 70px;font-size: 38px;"> $0.00</div>
                        </div>
                        <div class="row row-xs">
                            <div style="max-height: 40vh" class="col-md-12 scroll-auto table-responsive">
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
                                <button class="btn btn-default" id="btncliente" type="button"><i class="fa fa-user"></i></button>
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
                        <div class="col-md-2 hidden">
                            <input type="checkbox" readonly title="" id="servicio_domicilio" >
                            <input type="text" value="0" readonly title="" id="costo_domicilio" >
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" onclick="setCrearPedido(1)"><i class="fa fa-dollar"></i> Crear</button>
                            <?=$btnCobrar?>
                            <button class="btn btn-danger" onclick="getViewCaja()"><i class="fa fa-close"></i> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-body" >
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class=""><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> Top 10</a></li>
                        <li role="presentation" class="active"><a href="#platillos" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Platillos</a></li>
                        <li role="presentation"><a href="#extras" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Extras</a></li>
                        <li role="presentation"><a href="#bebidas" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Bebidas</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content scroll-auto"  style="max-height: 75vh">
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
</div>

