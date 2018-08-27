<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 15/06/2018
 * Time: 10:17 AM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,
    core\session,
    core\seguridad;

$connect = new seguridad();

core::setTitle();

?>
<script>
    setOpenModal('mdlBuscarUsuario',true,true);
</script>
<div class="modal fade" id="mdlBuscarUsuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-search"></i> Buscar Usuario
            </div>
            <div class="modal-body">
                <div class="row row-sm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="search" class="form-control" id="txtcadena" placeholder="Buscar por: Nombre, usuario " />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Perfil</label>
                            <select id="idperfil" class="form-control" title="Perfil">
                                <option value="0"> Todos</option>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estatus</label>
                            <select id="idestatus" class="form-control" title="Estatus">
                                <option value="0"> Todos </option>
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
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" onclick="getViewBusarUsuario(2)"><i class="fa fa-search"></i> Buscar</button>
                <button class="btn btn-sm btn-danger" onclick="setCloseModal('mdlBuscarUsuario')"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
