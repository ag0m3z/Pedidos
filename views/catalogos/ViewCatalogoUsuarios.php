<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 04:20 PM
 */
include "../../core/core.php";
include "../../core/session.php";

use core\core,
    core\session;

core::setTitle('Lista de usuarios');
?>
<script language="JavaScript">
    getListarUsuarios(1);
</script>
<div class="box box-primary">
    <div class="box-header">
        Usuarios
    </div>
    <div class="toolbars">
        <button class="btn btn-default btn-sm" onclick="getViewCatalogoUsuarios()"><i class="fa fa-list-ul"></i> Listar</button>
        <button class="btn btn-info btn-sm" onclick="getViewNuevoUsuario(1)"><i class="fa fa-user-plus"></i> Nuevo</button>
        <button class="btn btn-default btn-sm" onclick="getViewBusarUsuario(1)"><i class="fa fa-search"></i> Buscar</button>
        <button class="btn btn-success btn-sm" disabled><i class="fa fa-file-excel-o"></i> Exportar</button>
    </div>
    <div id="content_usuarios" class="box-body no-padding table-responsive">
    </div>
</div>