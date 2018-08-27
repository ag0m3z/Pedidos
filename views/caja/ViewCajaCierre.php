<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 24/07/2018
 * Time: 12:51 PM
 */

if($_POST['fechacierre'] == null){
    $fecha_actual = date("Y-m-d");
    $FechaCierre = date("Y-m-d",strtotime($fecha_actual."- 1 days"));

}else{
    $fecha_actual = $_POST['fechacierre'];
    $FechaCierre = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
}
//sumo 1 día date("d-m-Y",strtotime($fecha_actual."+ 1 days"));
//resto 1 día

?>
<script>
    $("#btnRealizarCierre").on('click',function(){
        setCierre();
    });
</script>
<div class="box box-warning">
    <div class="box-header">
        Fecha ultimo Cierre: <?=$_POST['fechacierre']?>
    </div>
    <div class="box-body">
        <div class="row row-sm">
            <div class="col-md-4">
                <div class="form-group">
                    Monto cierre:
                    <input id="montocierre" type="number" class="form-control" title="Monto de Cierre" />
                </div>
                <div class="form-group">
                    Fecha cierre:
                    <input id="fechacierre"  value="<?=$FechaCierre?>" disabled class="form-control" title="Monto de Cierre" />
                </div>
                <div class="form-group">
                    <button id="btnRealizarCierre" class="btn btn-primary btn-sm"> Realizar Cierre</button>
                </div>
            </div>
            <div class="col-md-8">
                <?=var_dump($_POST)?>
            </div>
        </div>
    </div>
</div>
