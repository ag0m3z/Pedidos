<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 14/06/2018
 * Time: 10:42 PM
 */

include "../../core/core.php";
include "../../core/session.php";
include "../../core/seguridad.php";

use core\core,core\session,core\seguridad;

$connect = new seguridad();
$connect->_query = "
    SELECT idKey,tema,imgMenu,NombreEmpresa,Colonia,Calle,Telefono1,Telefono2,Celular,Logo, 
          if(AperturaCierre=1,'checked','')as AperturaCierre,
          if(HorarioAcceso=1,'checked','')as HorarioAcceso,
          if(ServicioDomicilio=1,'checked','')as ServicioDomicilio,
          if(CambiarClave = 1,'checked','')as CambiarClave,
          if(Ticket = 1,'checked','')as Ticket,
          if(TicketLogo = 1,'checked','')as TicketLogo,
          if(TicketTelefono = 1,'checked','')as TicketTelefono,
          if(TicketAutomatico=1,'checked','')as TicketAutomatico,
          if(TicketAgrupacion=1,'checked','')as TicketAgrupacion,
          if(CerrarPantallaTicket = 1, 'checked','')as CerrarPantallaTicket,
          Licencia,FechaExp,
          HoraCierreSistema
    FROM config WHERE idKey=1
";

$connect->get_result_query(true);
$data = $connect->_rows[0];
$HoraCierre = substr($data['HoraCierreSistema'],0,5);
?>
<script>

    $('#horacierresystem option[value="<?=$HoraCierre?>"]').attr("selected",true);

    $("img[name='<?=$data['imgMenu']?>']").addClass("bg-green imgactive");
    $('#logo_empresa').change(function(e) {
        setAddImage(e);
        fnreadURL(e);
    });
</script>
<div class="row row-sm">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-gears"></i> Configuraciones
            </div>
            <div class="toolbars">
                <button onclick="setSaveConfiguracion()" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
            </div>
            <div class="box-body">

               <div class="row row-sm">

                   <div class="col-md-6">

                       <div class="row row-sm">
                           <div class="col-md-6">

                               <div class="form-group">
                                   <label>Nombre </label>
                                   <input class="form-control" value="<?=$data['NombreEmpresa']?>"  title="Nombre de la Empresa" placeholder="Nombre de la Empresa" type="text" id="nombre_empresa">
                               </div>
                               <div class="form-group">
                                   <label>Colonia </label>
                                   <input class="form-control" value="<?=$data['Colonia']?>" title="Colonia de la Empresa" placeholder="Colonia" type="text" id="colonia">
                               </div>
                               <div class="form-group">
                                   <label>Calle </label>
                                   <input class="form-control" value="<?=$data['Calle']?>" title="Calle de la Empresa" placeholder="Calle" type="text" id="calle">
                               </div>

                           </div>

                           <div class="col-md-6">
                               <div class="form-group">
                                   <label>Telefono 1 </label>
                                   <input class="form-control" value="<?=$data['Telefono1']?>" title="Telefono de la Empresa" placeholder="Telefono 1" type="text" id="tel1">
                               </div>
                               <div class="form-group">
                                   <label>Telefono 2 </label>
                                   <input class="form-control" value="<?=$data['Telefono2']?>" title="Telefono 2" placeholder="Telefono 2" type="text" id="tel2">
                               </div>
                               <div class="form-group">
                                   <label>Celular </label>
                                   <input class="form-control" value="<?=$data['Celular']?>" title="Celular de la Empresa" placeholder="Celular" type="text" id="celular">
                               </div>
                           </div>

                           <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hora de Cierre</label>
                                    <select id="horacierresystem" title="Hora de Cierre de Caja" class="form-control">
                                        <option value="00:00">12:00 PM</option>
                                        <option value="00:30">12:30 PM</option>
                                        <option value="01:00">1:00 AM</option>
                                        <option value="01:30">1:30 AM</option>
                                        <option value="02:00">2:00 AM</option>
                                        <option value="02:30">2:30 AM</option>
                                        <option value="03:00">3:00 AM</option>
                                        <option value="03:30">3:30 AM</option>
                                        <option value="04:00">4:00 AM</option>
                                        <option value="04:30">4:30 AM</option>
                                    </select>
                                </div>
                           </div>

                       </div>

                       <div class="row row-sm">

                           <div class="col-md-6">

                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="apertura" <?=$data['AperturaCierre']?> type="checkbox"> Solicitar Apertura y Cierre de Caja
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="acceso_restringido" <?=$data['HorarioAcceso']?> type="checkbox"> Restringir acceso fuera de horario
                                       </label>
                                   </div>
                               </div>
                               <div class="checkbox">
                                   <label>
                                       <input id="serv_domicilio" <?=$data['ServicioDomicilio']?> type="checkbox"> Servicio a Domicilio
                                   </label>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="cambiar_clave" <?=$data['CambiarClave']?> type="checkbox"> Cambiar Contraseña de Administrador cada 3 Meses
                                       </label>
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input disabled  type="checkbox"> Se requiere Apertura de mesa
                                       </label>
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input disabled checked type="checkbox"> Busqueda de cliente, requiere costo a domimcilio
                                       </label>
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input disabled type="checkbox"> Activar modulo pago de servicios
                                       </label>
                                   </div>
                               </div>

                           </div>

                           <div class="col-md-6">
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="print_ticket" <?=$data['Ticket']?> type="checkbox"> Imprimir Ticket
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="logo_ticket" <?=$data['TicketLogo']?> type="checkbox"> Mostrar Logo en Ticket
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="tel_ticket" <?=$data['TicketTelefono']?> type="checkbox"> Mostrar Telefonos
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="group_ticket" <?=$data['TicketAgrupacion']?> type="checkbox"> Agrupar Productos en Ticket
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="automatico_ticket" <?=$data['TicketAutomatico']?> type="checkbox"> Impresion Directa del Ticket
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input id="close_ticket" <?=$data['CerrarPantallaTicket']?> type="checkbox"> Cerrar Ventana del Ticket
                                       </label>
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input disabled type="checkbox"> Activar modulo almacen
                                       </label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="checkbox">
                                       <label>
                                           <input disabled type="checkbox"> Activar modulo inventarios
                                       </label>
                                   </div>
                               </div>

                           </div>

                       </div>

                   </div>
                   <div class="col-md-6">
                       <div class="row row-sm">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label>Tema </label>
                                   <select title="Tema de la aplicación" id="tema" class="form-control">
                                       <option value="<?=$data['tema']?>"><?=$data['tema']?></option>
                                       <option value="skin-siac">Aqua</option>
                                       <option value="skin-red">Red</option>
                                       <option value="skin-black">Black</option>
                                       <option value="skin-blue">Blue</option>
                                       <option value="skin-blue-gray">Gray</option>
                                       <option value="skin-green">Green</option>
                                       <option value="skin-yellow">Yellow</option>
                                       <option value="skin-purple">Purple</option>
                                   </select>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label>Side Bar </label>
                                   <input class="form-control" value="<?=$data['imgMenu']?>" readonly onclick="setOpenModal('mdlSidebar')"  title="Imagen en Menu" placeholder="Imagen en Menu" type="text" id="sidebar">
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label class="control-label" for="inputSuccess1">Licencia</label>
                                   <input type="text" readonly class="form-control" placeholder="No de Licencia" id="licencia" aria-describedby="helpBlock2">
                                   <span id="helpBlock2" class="help-block"><a href="#">Solicitar / Cambiar Licencia</a> </span>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label class="control-label" for="inputSuccess1">Expiración</label>
                                   <input type="text" class="form-control" placeholder="Expiración" id="inputSuccess1" aria-describedby="helpBlock2">
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="form-group img-responsive">
                                   <img width="220" id="imgLogo" onclick="$('#logo_empresa').click();" class="img-thumbnail cursor-pointer imgsidebar" src="wcontent/img/logos/logo.png">
                                   <input class="hidden" type="file"  accept="file_extension| ,.gif, .jpg, .png," name="logo_empresa" id="logo_empresa" />
                               </div>
                           </div>
                       </div>
                   </div>

               </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlSidebar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Imagen de Sidebar
            </div>
            <div class="modal-body">

                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-1.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-1.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-3.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-3.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-4.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-4.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-5.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-5.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-6.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-6.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-7.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-7.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable "><img class="img-thumbnail imgsidebar" width="95" name="sidebar-8.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-8.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-9.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-9.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-10.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-10.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-11.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-11.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-12.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-12.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-13.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-13.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-16.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-16.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-17.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-17.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-19.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-19.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-20.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-20.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-21.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-21.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="sidebar-22.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/sidebar-22.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="black.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/black.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="red.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/red.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="blue.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/blue.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="green.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/green.jpg"></a>
                <a href="#" onclick="setSideBar($(this))" class="hoverable"><img class="img-thumbnail imgsidebar" width="95" name="white.jpg" style="height: 135px !important;" src="wcontent/img/sidebar/white.jpg"></a>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>