<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 15/06/2018
 * Time: 01:23 PM
 */
include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";
include "../../model/model_mesas.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_mesas;

$connect = new seguridad();
$mesa = new model_mesas($connect);

$mesa->getMesa($_POST['idmesas']);

if(count($mesa->rows)>0){
    $dataUser = $mesa->rows[0];
}
core::setTitle('Editar mesa: '.$_POST['idmesas']);
?>
<script>
    setOpenModal('mdlEditarMesa',true,true);
</script>
<div class="modal fade " id="mdlEditarMesa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Editar Mesa <?=$_POST['idmesas']?>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> General</a></li>
                    <li role="presentation"><a href="#detalle" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-ol"></i> Detalle</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" value="<?=$dataUser['nombre']?>" class="form-control" id="nombre_mesa" placeholder="Nombre de la mesa" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estatus</label>
                                    <select class="form-control" title="Estatus" id="idestatus">
                                        <option value="<?=$dataUser['idestatus']?>"><?=$dataUser['NombreEstatus']?></option>
                                        <?php
                                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 1 AND opc_catalogo <> '$dataUser[idestatus]' AND idestatus = 1";
                                        $connect->get_result_query(true);
                                        for($i=0;$i<count($connect->_rows);$i++){
                                            echo "<option value='".$connect->_rows[$i]['opc_catalogo']."'>".$connect->_rows[$i]['Descripcion']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="detalle">
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <div class="form-group">
                                    Usuario Alta
                                    <input title="Usuario Alta" disabled class="form-control" Usuario Alta" value="<?=$dataUser['UsuarioAlta']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Usuario UM
                                    <input title="Usuario UM" disabled class="form-control" placeholder="Usuario UM" value="<?=$dataUser['UsuarioUM']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Fecha Alta
                                    <input title="Fecha Alta" disabled class="form-control" placeholder="Fecha Alta" value="<?=$dataUser['FechaAlta']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Fecha UM
                                    <input title="Fecha UM" disabled class="form-control" placeholder="Fecha UM" value="<?=$dataUser['FechaUM']?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" onclick="getViewEditarMesa(2,<?=$_POST['idmesas']?>)"><i class="fa fa-save"></i> Guardar</button>
                <button class="btn btn-danger btn-sm" onclick="setCloseModal('mdlEditarMesa')"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
