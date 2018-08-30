<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 01:35 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,core\session;

//var_dump($_SESSION);
?>
<script>
    setDashboardHome();
</script>
<div class="row">
    <div class="col-lg-3 col-sm-6 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-white box box-success hoverable">
            <div class="inner text-black">
                <h3 id="venta_del_dia" class="currency" style="text-align: left !important;">0</h3>
                <p>Ventas del Día</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-white box box-info hoverable">
            <div class="inner text-black">
                <h3 id="venta_domicilio" class="currency" style="text-align: left !important;">0</h3>
                <p>Ventas a Domicilio</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-white box box-success hoverable">
            <div class="inner text-black">
                <h3 id="total_venta" class="currency" style="text-align: left !important;">0</h3>
                <p>Total de Venta</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-white box box-danger hoverable">
            <div class="inner text-black">
                <h3 id="ventas_canceladas" class="currency" style="text-align: left !important;">0</h3>
                <p>Cancelaciones x Día</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header"> Pedidos Pendientes</div>
                    <div class="box-body no-padding"  style="height: 35vh">
                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                                <tr class="small">
                                    <th>id</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Serv</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="small" id="list_pedientes"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header"> Pedidos Terminados</div>
                    <div class="box-body no-padding" style="height: 35vh">
                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                            <tr class="small">
                                <th>id</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Serv</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody class="small" id="list_terminados"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div id="container"></div>
    </div>

</div>
