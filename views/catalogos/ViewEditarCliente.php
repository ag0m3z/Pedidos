<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 19/06/2018
 * Time: 08:40 PM
 */
include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";
include "../../model/model_clientes.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_clientes;

$connect = new seguridad();
$cliente = new model_clientes($connect);

$cliente->getCliente($_POST['idcliente']);
$dataClient = [];
if(count($cliente->rows)>0){
    $dataClient = $cliente->rows[0];
}
core::setTitle();
?>
<script>
    setOpenModal('mdlEditarCliente',true,true);
</script>
<div class="modal fade " id="mdlEditarCliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Editar Cliente: <?=$_POST['idcliente']?>
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
                                    <input type="text" class="form-control" value="<?=$dataClient['nombre']?>" id="nombre_cliente" placeholder="Nombre del cliente" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" value="<?=$dataClient['apellidos']?>" id="apellido_cliente" placeholder="Apellidos del cliente" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" class="form-control" id="direccion_cliente" value="<?=$dataClient['direccion']?>" placeholder="Dirección del cliente" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="number" class="form-control" value="<?=$dataClient['telefono']?>" id="telefono_cliente" placeholder="Teléfono" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="number" class="form-control" value="<?=$dataClient['celular']?>" id="celular_cliente" placeholder="Celular del cliente" />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="email" class="form-control" value="<?=$dataClient['correo']?>" id="correo_cliente" placeholder="Correo del cliente" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estatus</label>
                                    <select class="form-control" title="Estatus" id="idestatus">
                                        <option value="<?=$dataClient['idestatus']?>"><?=$dataClient['NombreEstatus']?></option>
                                        <?php
                                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 1 AND opc_catalogo <> '$dataClient[idestatus]' AND idestatus = 1";
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
                                    <input title="Usuario Alta" disabled class="form-control" Usuario Alta" value="<?=$dataClient['UsuarioAlta']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Usuario UM
                                    <input title="Usuario UM" disabled class="form-control" placeholder="Usuario UM" value="<?=$dataClient['UsuarioUM']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Fecha Alta
                                    <input title="Fecha Alta" disabled class="form-control" placeholder="Fecha Alta" value="<?=$dataClient['FechaAlta']?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Fecha UM
                                    <input title="Fecha UM" disabled class="form-control" placeholder="Fecha UM" value="<?=$dataClient['FechaUM']?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" onclick="getViewEditarCliente(2,<?=$_POST['idcliente']?>)"><i class="fa fa-save"></i> Guardar</button>
                <button class="btn btn-danger btn-sm" onclick="setCloseModal('mdlEditarCliente')"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
