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
    $('#content_usuarios').removeClass('no-padding')
</script>

<div class="row row-sm">
    <div class="col-md-8">
        <div class="row row-sm">
            <div class="col-sm-12">
                <div class="row row-sm">
                    <div class="col-sm-2">
                        <button onclick="getViewNuevoUsuario(2)" class="btn btn-outline btn-block btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label class="no-bold">Nombre</label>
                    <input class="form-control" placeholder="Nombre" type="text" id="nombre_usuario" />
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label class="no-bold">Apellidos</label>
                    <input class="form-control" placeholder="Apellidos" type="text" id="apellidos_usuario" />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Perfil</label>
                    <select class="form-control" title="Perfil" id="perfil_usuario">
                        <option value="0">-- --</option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 2 AND idestatus = 1 ORDER BY  Descripcion ASC";
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
                    <label class="no-bold">Estatus</label>
                    <select class="form-control" title="Estatus" id="idestatus_usuario">
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
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="no-bold">Usuario</label>
                    <input class="form-control" placeholder="Nombre de Usuario" type="text" id="usuario_usuario" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="no-bold">NickName</label>
                    <input class="form-control" placeholder="NickName" type="text" id="nickname_usuario" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="no-bold">Contraseña</label>
                    <input class="form-control" placeholder="Contraseña" type="password" id="password_usuario" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
