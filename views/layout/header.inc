<header class="main-header">
    <!-- Logo -->
    <a href="#" onclick="location.reload()" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b> <?=substr("SPV",0,4)?></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><i class="fa fa-balance-scale"></i> SIAC</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown hidden ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-clock-o animated flip  "></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa text-green fa-bold"></i> Baño</a></li>
                        <li><a href="#"><i class="fa text-green fa-cutlery"></i> Comida</a></li>
                        <li><a href="#"><i class="fa text-warning fa-eye"></i> Ver Estados</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o animated  flip  "></i>
                        <span id="alert_bell" class="label label-danger">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header text-bold">Existencias Bajas</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul id="list_bell" class="menu">
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="Pantalla Completa" onclick="requestFullScreen()"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a>
                </li>
                <li class="">
                    <div class="hidden navbar-form navbar-right" method="post" >
                        <div class="form-group">
                            <input type="text" id="head_buscar_cliente" style="border-radius: 15px " class="form-control " placeholder=" Buscar Folio, clientes">
                        </div>
                    </div>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> <?=$_SESSION['DataLogin']['nickname']?>
                    </a>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li class="hidden">
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>