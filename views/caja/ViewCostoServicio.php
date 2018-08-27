<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 20/07/2018
 * Time: 08:36 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";



?>
<script>
    setOpenModal("mdlDomicilio",true,false);
</script>
<div class="modal fade " id="mdlDomicilio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center"><i class="fa fa-motorcycle"></i> Agregar Costo de Envío</h4>
                <div class="row row-sm">
                    <div class="col-md-12">
                        <?php
                        for($i=2;$i<14;$i++){
                            echo '<a onclick="setAgregarCostoDomicilio($(this).text(),'.$_POST['opc'].','.$_POST['idpedido'].')" class="btn btn-default text-bold text-center  btn-app" style="font-size: 20px">'.(5*$i).'</a>';
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group form-group-lg">
                            <input type="number" id="costo_servicio" class="form-control" placeholder="Costo de Servicio">
                            <span class="input-group-btn"><button onclick="setAgregarCostoDomicilio($('#costo_servicio').val(),<?=$_POST['opc']?>,<?=$_POST['idpedido']?>)" class="btn btn-default btn-lg" type="button"><i class="fa fa-plus"></i></button></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
