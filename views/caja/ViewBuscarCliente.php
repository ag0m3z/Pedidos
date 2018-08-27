<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 26/06/2018
 * Time: 08:12 PM
 */
?>
<script>
    $("#textBusqueda").on('focus',function(){
       $(this).select();
    });
    $("#textBusqueda").on('keyup', function (e) {
        $(this).parent('.form-group').removeClass("has-error");
        $("#helpBlock2").addClass("hidden");
        if (e.keyCode == 13) {
            if($(this).val().length > 3 ){
                getBuscarCliente(2);
            }else{
                $(this).parent('.form-group').addClass("has-error");
                $("#helpBlock2").removeClass("hidden");
            }
        }
    });
    setOpenModal("mdlBuscarCliente",true,true);
</script>
<div class="modal fade" id="mdlBuscarCliente">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                Buscar cliente
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="textBusqueda"> Teléfono</label>
                            <input id="textBusqueda" class="form-control" aria-describedby="helpBlock2" placeholder="Buscar por Teléfono"  type="number" >
                            <span id="helpBlock2" class="help-block hidden">Ingrese por lomenos 5 digitos</span>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-hover table-striped table-condensed">
                            <thead><tr><th>Nombre</th><th>Teléfono</th><th>Dirección</th></tr></thead>
                            <tbody id="lista_busqueda_cliente"></tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary bt-sm" onclick="getBuscarCliente(2)" ><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-success bt-sm" onclick="getViewRegistrarCliente(1,{frm:'caja',tel:$('#textBusqueda').val()});setCloseModal('mdlBuscarCliente')" ><i class="fa fa-user-plus"></i> Nuevo Cliente</button>
                <button class="btn btn-danger bt-sm" onclick="setCloseModal('mdlBuscarCliente');" ><i class="fa fa-close"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>
