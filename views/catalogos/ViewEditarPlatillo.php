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

include "../../model/model_platillos.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_platillos;

$connect = new seguridad();
core::setTitle('Editar Platillo');

$platillo = new model_platillos($connect);

$platillo->getPlatillo($_POST['idplatillo']);

if($platillo->confirm){
    $data = $platillo->rows[0];
}else{
    $data = [];
}

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
                        <button onclick="getViewEditarPlatillo(2,<?=$_POST['idplatillo']?>)" class="btn btn-outline btn-block btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Nombre</label>
                    <input class="form-control" value="<?=$data['nombre']?>" placeholder="Nombre platillo" type="text" id="nombre_platillo" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Categoría</label>
                    <select class="form-control" title="Categoría" id="categoria_platillo">
                        <option value="<?=$data['idcategoria']?>"><?=$data['NombreCategoria']?></option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 3 AND opc_catalogo <> '$data[idcategoria]' ORDER BY  Descripcion ASC";
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
                        <option value="<?=$data['idsubcategoria']?>"><?=$data['NombreSubCategoria']?></option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 4 AND opc_catalogo <> '$data[idsubcategoria]' ORDER BY  Descripcion ASC";
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
                        <option value="<?=$data['unidad_medida']?>"><?=$data['NombreUnidadMedida']?></option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 5 AND opc_catalogo <> '$data[unidad_medida]' ORDER BY  Descripcion ASC";
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
                    <input class="form-control" placeholder="Cantidad Piezas" value="<?=$data['piezas']?>" type="number" id="piezas_platillo" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Precio venta</label>
                    <input class="form-control currency" placeholder="$ 0.00" value="<?=$data['precio_venta']?>" type="text" id="pventa_platillo" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="no-bold">Precio compra</label>
                    <input class="form-control currency" placeholder="$ 0.00" value="<?=$data['precio_compra']?>" type="text" id="pcompra_platillo" />
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="no-bold">Estatus</label>
                    <select class="form-control" title="Estatus" id="idestatus_platillo">
                        <option value="<?=$data['idestatus']?>"><?=$data['NombreEstatus']?></option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 1 AND idestatus <> '$data[idestatus]' ";
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
                    <input class="form-control" value="<?=$data['FechaAlta']. " - ".$data['UsuarioAlta']?>" placeholder="Fecha y Usuario Alta" readonly type="text" id="usuario_usuario" />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Ultima Modificación</label>
                    <input readonly class="form-control" value="<?=$data['FechaUM']. " - ".$data['UsuarioUM']?>" placeholder="Ultima Modificación" type="text" />
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3"></div>

</div>
