<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 03/07/2018
 * Time: 09:05 AM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,
    core\session,
    core\seguridad;

core::setTitle('Lista de Pedidos');

if($_SESSION['DataLogin']['idperfil'] == 1 || $_SESSION['DataLogin']['idperfil'] == 2){
    $btnCobrar = '<button onclick="getViewCobrar($(\'#idorden_pedido\').val())" class="btn  btn-success btn-sm"><i class="fa fa-dollar"></i> Cobrar</button>';
}

?>
<script>
    getListarPedidos(1);
</script>
<div class="row row-sm">
    <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-list-alt"></i> Lista de pedidos
                <span id="total_pedidos_items" class="pull-right badge">0</span>
            </div>
            <div class="toolbars">
                <button onclick="getViewCaja()" class="btn  btn-primary btn-sm"><i class="fa fa-arrow-circle-o-left"></i> Regresar</button>
                <button onclick="getViewPedidos()" class="btn btn-default btn-sm"> <i class="fa fa-refresh"></i> </button>
                <button onclick="getViewModalTicket(6)" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Imprimir</button>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No Orden</th>
                            <th>Nombre</th>
                            <th colspan="2" >Total</th>
                        </tr>
                    </thead>
                    <tbody id="lista_pedidos"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-list-alt"></i> Detalle del pedido
                <span id="total_detalle_items" class="pull-right badge">0</span>
            </div>
            <div class="toolbars">
                <?=$btnCobrar?>
            </div>
            <div class="box-body">
                <div class="row row-sm">
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
                        <table class="table table-hover table-striped">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
