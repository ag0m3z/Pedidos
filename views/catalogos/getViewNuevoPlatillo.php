<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 06:00 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,
    core\session,
    core\seguridad;

$connect = new seguridad();
core::setTitle('Registro de usuario');

?>
<script>
    $(".currency").focus(function () {
        $(this).select();
    })
    $('.currency').numeric({prefix:'$ ', cents: true});
    $('#content_platillos').removeClass('no-padding')
</script>

<div class="row row-sm">

    <div class="col-md-9">
        <div class="row row-sm">
            <div class="col-sm-12">
                <div class="row row-sm">
                    <div class="col-sm-2">
                        <button onclick="getViewNuevoPlatillo(2)" class="btn btn-outline btn-block btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Nombre</label>
                    <input class="form-control" placeholder="Nombre platillo" type="text" id="nombre_platillo" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Categoría</label>
                    <select class="form-control" title="Categoría" id="categoria_platillo">
                        <option value="0">-- --</option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 3 AND idestatus = 1 ORDER BY  Descripcion ASC";
                        $connect->get_result_query(true);
                        for($i=0;$i<count($connect->_rows);$i++){
                            echo "<option value='".$connect->_rows[$i]['opc_catalogo']."'>".$connect->_rows[$i]['Descripcion']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Subcategoría</label>
                    <select class="form-control" title="Subcategoría" id="scategoria_platillo">
                        <option value="0">-- --</option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 4 AND idestatus = 1 ORDER BY  Descripcion ASC";
                        $connect->get_result_query(true);
                        for($i=0;$i<count($connect->_rows);$i++){
                            echo "<option value='".$connect->_rows[$i]['opc_catalogo']."'>".$connect->_rows[$i]['Descripcion']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="no-bold">Unidad Medida</label>
                    <select class="form-control" title="Unidad Medida" id="umedida_platillo">
                        <option value="0">-- --</option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 5 AND idestatus = 1 ORDER BY  Descripcion ASC";
                        $connect->get_result_query(true);
                        for($i=0;$i<count($connect->_rows);$i++){
                            echo "<option value='".$connect->_rows[$i]['opc_catalogo']."'>".$connect->_rows[$i]['Descripcion']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="no-bold">Piezas</label>
                    <input class="form-control" placeholder="Cantidad Piezas" type="number" id="piezas_platillo" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Precio venta</label>
                    <input class="form-control currency" placeholder="$ 0.00" type="text" id="pventa_platillo" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Precio compra</label>
                    <input class="form-control currency" placeholder="$ 0.00" type="text" id="pcompra_platillo" />
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="no-bold">Estatus</label>
                    <select class="form-control" title="Estatus" id="idestatus_platillo">
                        <option value="0">-- --</option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 1 AND idestatus = 1";
                        $connect->get_result_query(true);
                        for($i=0;$i<count($connect->_rows);$i++){
                            echo "<option value='".$connect->_rows[$i]['opc_catalogo']."'>".$connect->_rows[$i]['Descripcion']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Alta</label>
                    <input class="form-control" value="<?=date('Y-m-d H:i:s'). " - ".$_SESSION['DataLogin']['nickname']?>" placeholder="Fecha y Usuario Alta" readonly type="text" id="usuario_usuario" />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Ultima Modificación</label>
                    <input readonly class="form-control" value="<?=date('Y-m-d H:i:s'). " - ".$_SESSION['DataLogin']['nickname']?>" placeholder="Ultima Modificación" type="text" />
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3"></div>

</div>
