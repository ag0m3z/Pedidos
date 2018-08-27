<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:34 PM
 */
use core\core;

?>

<!DOCTYPE html><html ><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    \core\core::includeCSS('plugins/bootstrap/css/bootstrap.css',false);
    \core\core::includeCSS('plugins/fonts/font-awesome/css/font-awesome.min.css',false);
    \core\core::includeCSS('wcontent/css/css_login.css',false);
    \core\core::includeCSS('wcontent/css/AdminLTE.css',false);
    ?>
    <title><?=\core\core::APP_NAME()?></title></head><body class="full">
<div class="row animated fadeIn">
    <div class="col-sm-4 col-md-3  with-border border-right" style="height: auto;height: 100vh">
        <div class="content">
            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <img  style="width: 25%" class="img-rounded" src="wcontent/img/page/chef.png">
                </div>
                <div class="col-md-12">
                    <form name="formlogIn01" action="#" onsubmit="fn_login(); return false;" method="post">

                        <div class="form-group">
                            <label class="text-left">Usuario</label>
                            <input id="login_user" type="text" placeholder="Correo usuario" class="input-login">
                        </div>
                        <div class="form-group margin-bottom">
                            <label class="text-left">Contraseña</label>
                            <input id="login_pass" type="password" placeholder="Contrsaeña" class="input-login ">
                        </div>
                        <div id="div_result"></div>
                        <div class="form-group col-md-6 no-padding" >
                            <button type="submit" data-loading-text="Loading..." autocomplete="off" id="btn_login" class="btn btn-block btn-instagram btn-sm bg-aqua-gradient text-bold text-white" value="Iniciar Sesion" ><i class="fa fa-sign-in"></i> Iniciar Sesi&oacute;n</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <br>
                    <p class="text-center">
                        <b>Hockma Orders</b>
                        es una herramienta con mayor transparencia para con nuestros clientes, mejoramos los niveles de atención y tenemos mayor control de calidad en los servicios aplicados.
                        <br><a href="http://www.hockma.com/orders" target="_blank">Soporte Tecnico</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8 col-md-9 imgscreenlogin full no-padding with-border" style="background-color: #000;  opacity: 0.89;height: auto;height: 100vh">
        <img class="img-responsive" style="height: auto;height: 100vh"  src="wcontent/img/wallpapers/working-8.jpg">
    </div>

</div>
<?php
\core\core::includeJS('plugins/jQuery/jQuery-2.2.0.min.js',false);
\core\core::includeJS('plugins/bootstrap/js/bootstrap.js',false);
\core\core::includeJS('plugins/bootstrap/js/bootbox.min.js',false);
\core\core::includeJS('wcontent/js/jsLogin.js',false);
?>
</body>
</html>

