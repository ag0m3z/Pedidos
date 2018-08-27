<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 10:44 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,
    core\session,
    core\seguridad;

$FechaActual = date("Y-m-d");

$connect = new seguridad();

$connect->_query = "SELECT idplatillo,nombre FROM platillos WHERE idestatus = 1 ORDER BY nombre ASC";
$connect->get_result_query(true);
$platillos =  $connect->_rows;

//Clientes
$connect->_query = "SELECT idcliente,concat_ws(' ',nombre,apellidos)AS NombreCompleto FROM clientes WHERE idestatus = 1 ORDER BY NombreCompleto ASC";
$connect->get_result_query(true);
$clientes =  $connect->_rows;

//Cajero
$connect->_query = "SELECT idusuario,nickname FROM usuarios WHERE idestatus = 1 AND idperfil = 2 ORDER BY nickname ASC";
$connect->get_result_query(true);
$cajero =  $connect->_rows;

//Mesas
$connect->_query = "SELECT idmesas,nombre FROM mesas WHERE idestatus = 1 ORDER BY nombre ASC";
$connect->get_result_query(true);
$mesas =  $connect->_rows;

//Categorias
$connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos WHERE idcatalogo = 3 AND idestatus = 1 ORDER BY Descripcion ASC";
$connect->get_result_query(true);
$categorias =  $connect->_rows;

//Sub Categorias
$connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos WHERE idcatalogo = 4 AND idestatus = 1 ORDER BY Descripcion ASC";
$connect->get_result_query(true);
$subcategoria =  $connect->_rows;

?>
<script src="wcontent/js/jsCalendario.js"></script>
<script>
    $('.datepicker').datepicker({dateFormat:'yy-mm-dd'});

    $(".radio").click(function(){

        if($(this).hasClass('disableAll')){
            console.log(1);
            $(".disableAllCtrl").prop('disabled',true);
        }else{
            $(".disableAllCtrl").prop('disabled',false);
            console.log(2);
        }

        if($(this).val() == 'reporte05'){
            $("#gpo01").removeClass('hidden');
        }else{
            $("#gpo01").addClass('hidden');
        }

    });
</script>
<div class="box box-default">
    <div class="box-header">
        <i class="fa fa-area-chart"></i> Reporte de ventas
        <span id="ttlregistros" class="pull-right badge">00</span>
    </div>
    <div class="toolbars">
        <button class="btn btn-default btn-sm" onclick="getViewReportes()" ><i class="fa fa-home"></i> Inicio</button>
        <button class="btn btn-primary btn-sm" onclick="setOpenModal('mdlFiltrarReporte')" ><i class="fa fa-filter"></i> Filtrar</button>
        <button class="btn btn-default btn-sm" onclick="getViewGraficas()" ><i class="fa fa-pie-chart"></i> Graficas</button>
        <button class="btn btn-default hidden btn-sm" onclick="getExportReportesExcel()" ><i class="fa fa-file-excel-o"></i> Exportar</button>
    </div>
    <div class="box-body table-responsive no-padding" id="table_response">
    </div>
</div>

<div class="modal fade" id="mdlFiltrarReporte">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row row-sm">
                    <b>Tipo de Reporte</b><br>
                    <label class="radio-inline">
                        <input type="radio" checked name="inlineRadioOptions" class="radio disableAll" id="reporte01" value="reporte01"> Venta General
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" class="radio disableAll" id="reporte02" value="reporte02"> Clientes
                    </label>
                    <label class="radio-inline hidden">
                        <input type="radio" name="inlineRadioOptions" class="radio  disableAll" id="reporte03" value="reporte03"> Usuarios
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" class="radio" id="reporte04" value="reporte04"> Platillos
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" class="radio disableAll" id="reporte05" value="reporte05"> Cancelaciones
                    </label>
                    <hr>

                    <div class="col-md-12">
                        <div id="gpo01" class="form-group hidden">
                            <label>Tipo Cancelación</label>
                            <select id="tipocancelacion"  title="Tipo de Cancelación" class="form-control">
                                <option value="1" >Ventas</option>
                                <option value="2" >Pedidos</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Inicial</label>
                            <input id="fechainicial" type="text" value="<?=$FechaActual?>" readonly title="Fecha Inicial" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Final</label>
                            <input id="fechafinal" type="text" value="<?=$FechaActual?>" readonly title="Fecha Final" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Platillo</label>
                            <select id="idplatillo" disabled title="Platillos" class="form-control disableAllCtrl">
                                <option value="0" >Todos</option>
                                <?php
                                if(count($platillos)>0){
                                    for($i=0;$i<count($platillos);$i++){
                                        echo "<option value='".$platillos[$i]['idplatillo']."'>".$platillos[$i]['nombre']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group hidden">
                            <label>Mesero</label>
                            <select id="idmesero" disabled title="Meseros" class="form-control disableAllCtrl">
                                <option value="0" >Todos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cajeros</label>
                            <select id="idcajero" disabled title="Cajeros" class="form-control disableAllCtrl">
                                <option value="0" >Todos</option>
                                <?php
                                if(count($cajero)>0){
                                    for($i=0;$i<count($cajero);$i++){
                                        echo "<option value='".$cajero[$i]['idusuario']."'>".$cajero[$i]['nickname']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mesa</label>
                            <select id="idmesa" disabled title="Mesa" class="form-control disableAllCtrl">
                                <option value="0" >Todas</option>
                                <?php
                                if(count($mesas)>0){
                                    for($i=0;$i<count($mesas);$i++){
                                        echo "<option value='".$mesas[$i]['idmesas']."'>".$mesas[$i]['nombre']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cliente</label>
                            <select id="idcliente" disabled title="Clientes" class="form-control disableAllCtrl">
                                <option value="0" >Todos</option>
                                <?php
                                if(count($clientes)>0){
                                    for($i=0;$i<count($clientes);$i++){
                                        echo "<option value='".$clientes[$i]['idcliente']."'>".$clientes[$i]['NombreCompleto']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>A Domicilio</label>
                            <select id="adomicilio" disabled title="Servicio a Domicilio" class="form-control disableAllCtrl">
                                <option value="all" >Todos</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Categoría</label>
                            <select id="idcategoria" disabled title="Categoría" class="form-control disableAllCtrl">
                                <option value="0" >Todas</option>
                                <?php
                                if(count($categorias)>0){
                                    for($i=0;$i<count($categorias);$i++){
                                        echo "<option value='".$categorias[$i]['opc_catalogo']."'>".$categorias[$i]['Descripcion']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Categoría</label>
                            <select id="idsubcategoria" disabled title="Sub Categoría" class="form-control disableAllCtrl">
                                <option value="0" >Todas</option>
                                <?php
                                if(count($subcategoria)>0){
                                    for($i=0;$i<count($subcategoria);$i++){
                                        echo "<option value='".$subcategoria[$i]['opc_catalogo']."'>".$subcategoria[$i]['Descripcion']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="getBuscarReporte()" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-danger btn-sm" id="btnModalReportes" data-dismiss="modal" ><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
