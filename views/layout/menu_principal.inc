<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 06/01/2017
 * Time: 01:07 PM
 */
if($_SESSION['DataLogin']['idperfil'] != 1){
    $hidden = "hidden";
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active <?=$hidden?>"><a href="#" onclick="getViewTemplete(<?=$_SESSION['DataLogin']['idperfil']?>);"><i class="fa fa-dashboard  "></i> <span>Dashboard</span></a></li>
            <!-- li><a href="#" onclick="getMenu(2,0)"><i class="fa fa-cubes  "></i> <span>Estrategias</span> </a></li>
            <li class="hidden" ><a href="#" onclick="getMenu(8,0)"><i class="fa fa-calendar  "></i> <span>Calendario</span> </a></li>
            <li class="treeview hidden">
                <a href="#">
                    <i class="fa fa-diamond"></i>
                    <span>Apps</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-users"></i> Contactos</a></li>
                    <li><a href="#"><i class="fa fa-newspaper-o"></i> Noticias</a></li>
                    <li><a href="#"><i class="fa fa-comments"></i> Mensajes</a></li>
                </ul>
            </li>
            <li><a href="#" onclick="getMenu(3,0)"><i class="fa fa-suitcase  "></i> <span>Cartera</span> </a></li>
            <li><a href="#" onclick="getMenu(4,0)"><i class="fa fa-folder-open-o  "></i> <span>Gestion</span> </a></li>
            <li><a href="#" onclick="getMenu(5,0)"><i class="fa fa-line-chart  "></i> <span>Reportes</span> </a></li -->
            <?php
            /**
             * $OptionView = 0;
            for($i=0;$i<count($_SESSION['data_menu']);$i++){

            $NombreModulo = $_SESSION['data_menu'][$i]['nombre'];
            $FaIcon = $_SESSION['data_menu'][$i]['icon'];
            $ScriptEventOnClick = $_SESSION['data_menu'][$i]['onclick'];

            $OptionView = ($_SESSION['data_menu'][$i]['consultar'] + $_SESSION['data_menu'][$i]['agregar'] + $_SESSION['data_menu'][$i]['editar'] + $_SESSION['data_menu'][$i]['eliminar']);

            if($OptionView > 0){
            echo '<li><a href="#" '.$ScriptEventOnClick.' ><i class="fa '.$FaIcon.'"></i> <span>'.$NombreModulo.'</span>  </a> </li>';
            }
            }
             */

            if(count($_SESSION['Menu'])>0){
                for($i=0;$i<count($_SESSION['Menu']);$i++){

                    $Menu = $_SESSION['Menu'][$i];
                    $NombreModulo = $_SESSION['Menu'][$i]['Nombre'];
                    $FaIcon = $_SESSION['Menu'][$i]['Icono'];

                    $OptionView = ($Menu['Leer']+$Menu['Crear']+$Menu['Actualizar']+$Menu['Borrar']+$Menu['Reportes']+$Menu['Importar']+$Menu['Exportar']);
                    $Funcion = $Menu['Funcion']."(".$Menu['Parametros'].")";

                    if($Menu['TipoOpcion'] == '1' && $OptionView > 0 ){
                        if($Menu['idestado'] == 1){
                            echo "<li><a href='#' onclick='$Funcion'><i class='".$FaIcon."'></i> <span> ".$NombreModulo."</span></a></li>";
                        }
                    }

                }
                //Validar si tiene acceso a los reportes

            }
            ?>
            <li><a href="#" onclick="gnlogin_out()"><i class="fa fa-sign-out text-red"></i>  <span>Salir</span><i class="fa fa-close text-red pull-right"></i></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
