<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 11/01/2018
 * Time: 03:19 AM
 */



?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"><?php
    //framework Bootstrap
    \core\core::includeCSS("plugins/fullcalendar/fullcalendar.css",false);
    \core\core::includeCSS("plugins/bootstrap/css/bootstrap.css",false);

    //frameworks fontawesome fonts
    \core\core::includeCSS("plugins/fonts/font-awesome/css/font-awesome.min.css",false);
    // estilo para select buscador
    \core\core::includeCSS("plugins/select2/select2.min.css",false);
    \core\core::includeCSS("plugins/slickgrid/slick.grid.css",false);
    \core\core::includeCSS("wcontent/css/cssSlickGrid.css",false);
    //tema de la aplicacion
    \core\core::includeCSS("wcontent/css/AdminLTE.css",false);
    //themas
    \core\core::includeCSS("wcontent/css/skins/skins.css",false);
    \core\core::includeCSS("plugins/pnotify/pnotify.custom.min.css",false);
    // Nombre de la pagina
    ?><title><?=\core\core::APP_NAME('Dashboard')?></title><style>.<?=\core\core::THEME_APP($_SESSION['DataLogin']['tema'])?> .wrapper,.<?=\core\core::THEME_APP($_SESSION['DataLogin']['tema'])?> .left-side img {background: url('wcontent/img/sidebar/<?=$_SESSION['DataLogin']['imgMenu']?>') fixed ;background-size: contain;}</style> </head><body class="<?=\core\core::THEME_APP($_SESSION['DataLogin']['tema'])?>  fixed sidebar-collapse sidebar-mini">
<div class="wrapper animated fadeIn">
    <?php include "views/layout/header.inc";
    include "views/layout/menu_principal.inc";?>
    <div class="content-wrapper">

        <div id="mdlticket"></div>
        <div id="getalert"></div>
        <div id="showmodal"></div>
        <div id="idgeneral" ></div>
        <!-- Main content -->
        <section id="div_general" class="content"><div class="box" style="height: 100vh;background: #ECF0F5"><br><hr><br></div></section>
        <br>
        <!-- /.content -->
    </div>
    <?php include "views/layout/pie_de_pagina.inc"?>
    <?php include "views/layout/menu_right.inc"?>
</div>
<?php
\core\core::includeJS("plugins/jQuery/jQuery-2.2.0.min.js",false);
\core\core::includeJS("wcontent/js/app.js",false);
\core\core::includeJS("plugins/jQueryUI/jquery-ui.js",false);
\core\core::includeJS("plugins/bootstrap/js/bootstrap.js",false);
\core\core::includeJS("plugins/bootstrap/js/bootbox.min.js",false);
\core\core::includeJS("plugins/slimScroll/jquery.slimscroll.min.js",false);
\core\core::includeJS("plugins/select2/select2.full.min.js",false);
\core\core::includeJS("plugins/Highcharts-5.0.10/code/highcharts.js",false);
\core\core::includeJS("plugins/Highcharts-5.0.10/code/modules/exporting.js",false);
\core\core::includeJS("plugins/highcharts-5.0.10/code/highcharts-3d.js",false);
\core\core::includeJS("plugins/pnotify/pnotify.custom.min.js",false);
\core\core::includeJS("wcontent/js/iKroAnimate.js",false);
\core\core::includeJS("wcontent/js/jsGeneral.js?w=".date('Ymd').date('His')."",false);
?>
<script src="wcontent/js/jsFormatoMoneda.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment-with-locales.min.js"></script>
<script language="JavaScript">
    $(document).ready(function(){
        setTimeout(function () {
            $(".wrapper").removeClass('animated fadeIn');
        },800);
        getViewTemplete(<?=$_SESSION['DataLogin']['idperfil']?>);
        //$(".numeric").numeric({prefix:'', cents: false});
        $(".select2").select2();
        $('.sidebar-menu li').click(
            function () {
                $(".sidebar-menu li").removeClass("active");
                $(this).addClass("active");
            }
        );
    });
    //jQuery.noConflict();
</script>
</body>
</html>