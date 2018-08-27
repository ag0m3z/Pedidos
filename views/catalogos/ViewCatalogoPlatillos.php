<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 20/06/2018
 * Time: 08:13 PM
 */
include "../../core/core.php";
include "../../core/session.php";

use core\core,
    core\session;

core::setTitle('Lista de Platillos');
?>
<script language="JavaScript">
    getListarPlatillos(1);
</script>
<div class="box box-primary">
    <div class="box-header">
        Platillos
    </div>
    <div class="toolbars">
        <button class="btn btn-default btn-sm" onclick="getViewCatalogoPlatillos()"><i class="fa fa-list-ul"></i> Listar</button>
        <button class="btn btn-info btn-sm" onclick="getViewNuevoPlatillo(1)"><i class="fa fa-user-plus"></i> Nuevo</button>
        <button class="btn btn-default btn-sm" onclick="getViewBusarUsuario(1)"><i class="fa fa-search"></i> Buscar</button>
        <button class="btn btn-success btn-sm" disabled><i class="fa fa-file-excel-o"></i> Exportar</button>
    </div>
    <div id="content_platillos" class="box-body no-padding table-responsive">
    </div>
</div>