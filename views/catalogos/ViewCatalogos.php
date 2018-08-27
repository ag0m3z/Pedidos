<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 14/06/2018
 * Time: 12:07 PM
 */

include "../../core/core.php";
use core\core;

core::setTitle('Catalogos');

?>
<script>
    $('.btn-app').click(
        function () {
            $(".btn-app").removeClass("active");
            $(this).addClass("active");
        }
    );
</script>
<div class="row animated zoomIn">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-list-alt"></i> Catalogos
            </div>
            <div class="box-body no-padding table-responsive">
                <table class="no-border">
                    <tr>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoUsuarios()">
                                <i class="fa fa-user-secret"></i>Usuarios
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoMesas()">
                                <i class="fa fa-cutlery"></i>Mesas
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoClientes()">
                                <i class="fa fa-users"></i>Clientes
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoPlatillos()">
                                <i class="fa fa-list-alt"></i>Platillos
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoPlatillos()">
                                <i class="fa fa-list-alt"></i>Unidad Medida
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoPlatillos()">
                                <i class="fa fa-list-alt"></i>Categoría
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoPlatillos()">
                                <i class="fa fa-list-alt"></i>SubCategoría
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoPlatillos()">
                                <i class="fa fa-list-alt"></i>Estatus
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-default   btn-app" onclick="getViewCatalogoPlatillos()">
                                <i class="fa fa-list-alt"></i>Perfiles
                            </a>
                        </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
</div>

<div class="row animated fadeInLeft">
    <div id="contenedor_catalogos" class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
            </div>
        </div>
    </div>
</div>