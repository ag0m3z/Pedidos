<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 11:06 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";
include "../../model/model_usuarios.php";

use core\core,
    core\session,
    core\seguridad,
    models\model_usuarios;

$connect = new seguridad();
$usuarios = new model_usuarios($connect);

$usuarios->getUsuario($_POST['idusuario']);

if(count($usuarios->rows)>0){
    $dataUser = $usuarios->rows[0];
}
core::setTitle('Editar usuario: '.$_POST['idusuario']);
?>
<script>
    $("#content_usuarios").removeClass('no-padding');
</script>

<div class="row row-sm">
    <div class="col-md-8">
        <div class="row row-sm">
            <div class="col-sm-12">
                <div class="row row-sm">
                    <div class="col-sm-2">
                        <button onclick="getViewEditarUsuario(2,<?=$_POST['idusuario']?>)" class="btn btn-outline btn-block btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label class="no-bold">Nombre</label>
                    <input class="form-control" placeholder="Nombre" value="<?=$dataUser['nombre']?>" type="text" id="nombre_usuario" />
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label class="no-bold">Apellidos</label>
                    <input class="form-control" placeholder="Apellidos"  value="<?=$dataUser['apellidos']?>" type="text" id="apellidos_usuario" />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="no-bold">Perfil</label>
                    <select class="form-control" title="Perfil" id="perfil_usuario">
                        <option value="<?=$dataUser['idperfil']?>"><?=$dataUser['NombrePerfil']?></option>
                        <?php
                        $connect->_query = "SELECT opc_catalogo,Descripcion FROM catalogos where idcatalogo = 2 AND opc_catalogo <> '$dataUser[idperfil]' AND idestatus = 1 ORDER BY  Descripcion ASC";
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
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="no-bold">Usuario</label>
                    <input class="form-control" placeholder="Nombre de Usuario"  value="<?=$dataUser['usuario']?>" type="text" id="usuario_usuario" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="no-bold">NickName</label>
                    <input class="form-control" placeholder="NickName"  value="<?=$dataUser['nickname']?>" type="text" id="nickname_usuario" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="no-bold">Contraseña</label>
                    <input class="form-control" placeholder="Contraseña"  value="<?=$dataUser['password']?>" type="password" id="new_password_usuario" />
                    <input class="hidden" placeholder="Contraseña"  value="<?=$dataUser['password']?>" type="password" id="password_usuario" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
