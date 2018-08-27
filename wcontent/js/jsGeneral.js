/**
 * Created by agomez on 29/11/2016.
 *  SenderAjax(urlPhp,nameView,params,idDiv,is_type,stringData)
 * Created by alejandro.gomez on 14/11/2016.
 */

/**
 * Funciones Generales del Sistema
 * SIAC ( Sistema de Administracion y Cobranza )
 * @type {boolean}
 */

var validar_cierre = false;
var refresh01;

var URL;

/**
 * Funciones de Calendario
 */

//Funcion para la pantalla completa
function requestFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||    // metodo alternativo
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {               // metodos actuales
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

var buttonBootBox = {

    confirm: {
        label: '<i class="fa fa-check"></i> Aceptar',
        className: 'btn-default'
    },cancel: {
        label: '<i class="fa fa-times"></i> Cancelar',
        className: 'btn-danger'
    },
};

$("#head_buscar_cliente").on('keyup', function (e) {
    if (e.keyCode == 13) {
        // Do something

        //getSearchAcunt(this.value);

    }
});

function lpad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function getViewTemplete (idperfil) {

    var nameTemplete = "home/ViewTemplete01.php";

    if(idperfil > 1){
        nameTemplete = "home/ViewTemplete02.php";
        getViewCaja();
    }else{
        $.ajax({
            url: "views/" + nameTemplete,
            data: {idperfil: idperfil},
            type:'get'
        }).done(function( data ) {
            $("#div_general").html(data);
        }).fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log("Request Failed: " + err);
            MyAlert("Error al cargar la vista: " + nameTemplete);
        });
    }

}

function setSideBar(e){

    var namePicture = e[0].children[0].name;
    $("#sidebar").val(namePicture);
    $(".imgsidebar").removeClass("bg-green");
    $("img[name='"+namePicture+"']").addClass("bg-green imgactive");
    $('.modal').modal('toggle');
}

function getMessage (messages,pTitle,typemsg,timer){

    if(timer){
        timer = 3500;
    }

    switch (typemsg){

        case "system":
            PNotify.prototype.options.delay = timer;
            PNotify.prototype.options.styling = "jqueryui";
            PNotify.desktop.permission();
            (new PNotify({
                title: pTitle,
                text: messages,
                type: 'info',
                desktop: {
                    desktop: true
                }
            })).get().click(function(e) {
                if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
            });
            break;
        case "notice":
            PNotify.prototype.options.delay = timer;
            new PNotify({
                title: pTitle,
                text: messages,
                type: typemsg
            });
            break;
        case "info":
            //PNotify.prototype.options.styling = "jqueryui";
            PNotify.prototype.options.delay = timer;
            new PNotify({
                title: pTitle,
                text: messages
            });
            break;
        case "success":
            PNotify.prototype.options.delay = timer;
            new PNotify({
                title: pTitle,
                text: messages,
                type: typemsg
            });
            break;
        case "error":
            PNotify.prototype.options.delay = timer;
            new PNotify({
                title: pTitle,
                text: messages,
                type: typemsg
            });
            break;
        case "danger":
            PNotify.prototype.options.delay = timer;
            new PNotify({
                title: pTitle,
                text: messages,
                type: typemsg
            });
            break;
        case "warning":
            PNotify.prototype.options.delay = timer;
            new PNotify({
                title: pTitle,
                text: messages,
                type: typemsg
            });
            break;
        case null:
            PNotify.prototype.options.delay = timer;
            PNotify.prototype.options.styling = "jqueryui";
            new PNotify(messages);
            break;
        default :
            PNotify.prototype.options.delay = timer;
            PNotify.prototype.options.styling = "jqueryui";
            PNotify.prototype.options.addclass = 'border-success';
            new PNotify(messages);
            break;
    }
}

function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();

}

function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();
    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = " Cargando espere un momento....";
    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
    //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div class='text-black' style='margin-top:" + heightdivsito + "px; font-size:16px;'>"+
        "<div class='preloader pl-size-l'><div class='spinner-layer pl-teal'><div class='circle-clipper left'><div class='circle'></div> </div><div class='circle-clipper right'><div class='circle'></div> </div></div> " +
        "</div><br>"+mensaje+"</div></div>";
    //creamos el div que bloquea grande------------------------------------------
    div = document.createElement("div");
    div.id = "WindowLoad";
    div.style.width = ancho + "px";
    div.style.height = alto + "px";
    $("body").append(div);
    //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
    input = document.createElement("input");
    input.id = "focusInput";
    input.type = "text";
    //asignamos el div que bloquea
    $("#WindowLoad").append(input);
    //asignamos el foco y ocultamos el input text
    $("#focusInput").focus();
    $("#focusInput").hide();
    //centramos el div del texto
    $("#WindowLoad").html(imgCentro);
}

function fnloadSpinner(opc){
    switch (opc){
        // mostrar fa-Spinner
        case 1:
            jsShowWindowLoad();
            break;
        case 2:
            // Ocultar fa-Spinner
            jsRemoveWindowLoad();
            break;
        default :
            MyAlert("error no se encontro la opci&oacute;n solicitada","error");
            break;
    }
}

function MyAlert(message,isType){
    bootbox.dialog({
        title:"Alerta",
        message:message,
        size:"small",
        buttons:{
            ok:{
                label:"Aceptar",
                className:"btn-primary btn-sm"
            }
        }
    });
}

var getthowError = function (jqXHR,textStatus) {
    if (jqXHR.status === 0) {
        MyAlert('Not connect: Verify Network.','danger');
    } else if (jqXHR.status == 404) {
        MyAlert('Requested page not found [404]','danger');
    } else if (jqXHR.status == 500) {
        MyAlert('Internal Server Error [500].','danger');
    } else if (textStatus === 'parsererror') {
        MyAlert('Requested JSON parse failed.','danger');
    } else if (textStatus === 'timeout') {
        MyAlert('Time out error.','danger');
    } else if (textStatus === 'abort') {
        MyAlert('Ajax request aborted.','danger');
    } else {
        MyAlert('Uncaught Error: ' + jqXHR.responseText,'danger');
    }
};

function setRemoveDiv(idDiv) {

    //$("#"+idDiv).parentNode.id.remove();

    var a = function(e){
        return e[0].parentNode.id;
    };

    var idPadre = a($("#"+idDiv));

    $("#"+idPadre).html('');
}

function setCloseModal(idDiv) {

    if(idDiv){
        $('#'+idDiv).modal('toggle');
    }else{
        $('.modal').modal('toggle');
    }

    setTimeout(function () {
        setRemoveDiv(idDiv);
    },700);


}

function setCreateDiv(nameDiv) {
    $("#showmodal").html("<div id='content"+nameDiv+"'></div>");
}

function setFormatoMoneda(opc,valor) {

    switch (opc){
        case 1:
            //Desconvertir formato moneda
            var cadena = valor.replace('$', "");
            cadena = cadena.replace(',',"");
            //console.log(cadena);
            return cadena;
            break;
    }

    alert(cadena);

    return valor;

}

function setOpenModal(idModal,staticMdl,onFocusAuto){

    if(staticMdl){
        $('#'+idModal).attr('data-backdrop','static');
    }

    $('#'+idModal).modal('toggle');

    if(onFocusAuto){
        setTimeout(function() { $('.modal-body').find('input').first().focus(); }, 500);
    }

    $("#"+idModal).draggable({
        handle: ".modal-header"
    });
}
/**
 *
 * Funciones para el listado
 * de los catalogos
 *
 */
function getCatalogos(p){
    $.ajax({
        url:'views/catalogos/ViewCatalogos.php',
        type:'post',
        data:{opc:p},
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function (content) {
        $("#div_general").html(content);
        fnloadSpinner(2);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
        fnloadSpinner(2);
    })
}
/**
 * Funciones Usuario
 */
function getListarUsuarios(opc,dataArray){
    $("#content_usuarios").addClass('no-padding');
    $("#content_usuarios").html('<table class="table table-hover table-striped table-bordered"><thead><tr class="bg-aqua-gradient"><th>Funciones</th><th>Nombre</th><th>Apellidos</th><th>Nickname</th><th>Usuario</th><th>Estatus</th><th>Fecha</th></tr></thead><tbody id="lista_usuarios"></tbody></table>');
    $.ajax({
        url:"controller/catalogos/ControllerUsuarios.php",
        data:{opc:opc,dataArray:dataArray,route:'listar'},
        type:"post",
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){

            var tablaUsuarios = '';
            console.log(response);
            if(response.data.length > 0){

                var rows = response.data;
                var selectorUsuarios = $("#lista_usuarios");

                selectorUsuarios.html(' ');
                for(i=0;i<rows.length;i++){

                    tablaUsuarios += "<tr><td><button onclick='getViewEditarUsuario(1,"+rows[i].idusuario+")' class='btn btn-default btn-sm '><i class='fa text-success fa-edit'></i></button> <button onclick='getDesactivarUsuario("+rows[i].idusuario+")' class='btn btn-default btn-sm'><i class='fa  text-danger fa-trash'></i></button></td><td>"+rows[i].nombre+"</td><td>"+rows[i].apellidos+"</td><td>"+rows[i].nickname+"</td><td>"+rows[i].usuario+"</td><td><span class='badge'>"+rows[i].NombreEstatus+"</span></td><td>"+rows[i].FechaAlta+"</td></tr>";
                }

                selectorUsuarios.html(tablaUsuarios);
            }

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

function getViewCatalogoUsuarios(){
    $.ajax({
        url:"views/catalogos/ViewCatalogoUsuarios.php",
        data:{opc:1},
        type:"post",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(contenido){
        $("#contenedor_catalogos").html(contenido);
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

function getViewBusarUsuario(opc){
    switch (opc) {
        case 1: //Mostrar Frm para editar empleado o contacto
            $.ajax({
                url: "views/catalogos/ViewBuscarUsuario.php",
                data: {opc: opc},
                type: "post"
            }).done(function (contenido) {
                $("#showmodal").html('');
                $("#showmodal").html(contenido);
            }).fail(function (jqXHR, textStatus, errno) {
                getthowError(jqXHR, textStatus);
            });
            break;
        case 2: //Editar empleado
            var idperfil = $("#idperfil").val(),
                idestatus = $("#idestatus").val(),
                txtcadena = $("#txtcadena").val();

            if($.trim(txtcadena)==""){txtcadena = "0";}
            getListarUsuarios(2,{idperfil:idperfil,idestatus:idestatus,txtcadena:txtcadena});
            break;
        default:
            MyAlert("la opcion no existe");
            break;
    }
}

function getViewEditarUsuario(opc,idusuario) {
    switch (opc) {
        case 1:
            $.ajax({
                url: "views/catalogos/ViewEditarUsuario.php",
                type: "post",
                data: {idusuario: idusuario}
            }).done(function (contenido) {

                $("#content_usuarios").html(contenido);

            }).fail(function (jqxhr, textStatus, errno) {
                getthowError(jqxhr, textStatus);
            });
            break;
        case 2:

            var nombre = $("#nombre_usuario").val(),
                apellidos = $("#apellidos_usuario").val(),
                idperfil = $("#perfil_usuario").val(),
                idestatus = $("#idestatus_usuario").val(),
                usuario = $("#usuario_usuario").val(),
                new_password = $("#new_password_usuario").val(),
                password = $("#password_usuario").val(),
                nickname = $("#nickname_usuario").val();

            if ($.trim(nombre) == "") {
                MyAlert("Ingrese el nombde");
            } else if (($.trim(apellidos) == "")) {
                MyAlert("Ingrese los apellidos del usuario");
            } else if ($.trim(usuario) == "") {
                MyAlert("Ingrese el nombre de usuario");
            } else if ($.trim(nickname) == "") {
                MyAlert("Ingrese el nickname del usuario");
            } else if ($.trim(password).length <= 4) {
                MyAlert("La contraseña debe ser mayor a 4 caracteres");
            } else {

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {
                        route: 'editar',
                        idusuario: idusuario,
                        nombre: nombre,
                        apellidos: apellidos,
                        idperfil: idperfil,
                        idestatus: idestatus,
                        usuario: usuario,
                        password: password,
                        new_password: new_password,
                        nickname: nickname
                    },
                    url: "controller/catalogos/ControllerUsuarios.php",
                    beforeSend: function () {
                        fnloadSpinner(1);
                    }
                }).done(function (response) {
                    console.log(response);

                    if (response.result) {
                        getMessage('Usuario editado', '', '', 2500);
                        getViewCatalogoUsuarios();
                    } else {
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function (jqXHR, textStatus, errno) {
                    getthowError(jqXHR, textStatus);
                    fnloadSpinner(2);
                });

            }

            break;
        default:
            MyAlert("Opcion no valida");
            break;
    }

}
/**
 * Funcion para desactivar el usuario
 * @param idusuario
 */
function getDesactivarUsuario(idusuario){

    if(idusuario == ""){
        MyAlert("El usuario no existe");
    }else{

        $.ajax({
            url:"controller/catalogos/ControllerUsuarios.php",
            type:"post",
            data:{
                route:'delete',
                idusuario:idusuario
            },
            dataType:"json",
            beforeSend:function () {
                fnloadSpinner(1);
            }
        }).done(function (response) {

            if(response.result){
                getMessage('','Usuario Desactivado','',2500);
                getListarUsuarios(1,1);
            }else{
                MyAlert(response.message);
            }

            fnloadSpinner(2);
        }).fail(function(jqxhr,textStatus,errno){
            getthowError(jqxhr,textStatus);
            fnloadSpinner(2);
        });

    }
}
//Cargar Pantalla para registrar nuevo empleado
function getViewNuevoUsuario(opc) {
    switch (opc){
        case 1: //Mostrar Formulario para el alta de usuario
            $.ajax({
                url:"views/catalogos/getViewNuevoUsuario.php",
                data:{object:1},
                type:"post",
                beforeSend:function () {
                    fnloadSpinner(1);
                }
            }).done(function(contenido){
                $("#content_usuarios").html('');
                $("#content_usuarios").html(contenido);
                fnloadSpinner(2);
            }).fail(function (jqXHR,textStatus,errno) {
                getthowError(jqXHR,textStatus);
                fnloadSpinner(2);
            });
            break;
        case 2: //Crear nuevo usuario
            var nombre = $("#nombre_usuario").val(),
                apellidos = $("#apellidos_usuario").val(),
                idperfil = $("#perfil_usuario").val(),
                idestatus = $("#idestatus_usuario").val(),
                usuario = $("#usuario_usuario").val(),
                password = $("#password_usuario").val(),
                nickname = $("#nickname_usuario").val();

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombde");
            }else if(($.trim(apellidos) == "")){
                MyAlert("Ingrese los apellidos del usuario");
            }else if(idperfil == 0){
                MyAlert("Seleccione el perfil del usuario");
            }else if($.trim(usuario) == ""){
                MyAlert("Ingrese el nombre de usuario");
            }else if($.trim(nickname)==""){
                MyAlert("Ingrese el nickname del usuario");
            }else if($.trim(password).length <= 4){
                MyAlert("La contraseña debe ser mayor a 4 caracteres");
            }else{

                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        route:'registrar',
                        nombre:nombre,
                        apellidos:apellidos,
                        idperfil:idperfil,
                        idestatus:idestatus,
                        usuario:usuario,
                        password:password,
                        nickname:nickname
                    },
                    url:"controller/catalogos/ControllerUsuarios.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){
                    console.log(response);

                    if(response.result){
                        getMessage('usuario registrado','Nuevo Usuario','',2500);
                        getViewCatalogoUsuarios();
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });

            }
            break;
        case 3:
            //Crear NickName al Usuario basado al empleado seleccionado
            var nombre = $("#idempleado option:selected").text();
            nombre = nombre.split(" ");
            $("#nombreCorto").val(nombre[0]+' '+nombre[1]);

            break;
        default:
            MyAlert("Opción invalida");
            break;
    }
}

/**
 * ###--> Catalogo de Mesas
 */
/**
 * Funcion para ver el Catalogo de las mesas
 */
function getViewCatalogoMesas(){
    $.ajax({
        url:"views/catalogos/ViewCatalogoMesas.php",
        data:{opc:1},
        type:"post",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(contenido){
        $("#contenedor_catalogos").html(contenido);
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}
/**
 * Funcion para listar las todas las mesas activas,
 * y por medio de la busqueda
 * @param opc
 * @param dataArray
 */
function getListarMesas(opc,dataArray){
    $("#content_mesas").addClass('no-padding');
    $("#content_mesas").html('<table class="table table-hover table-striped table-bordered"><thead><tr class="bg-aqua-gradient"><th>Funciones</th><th>Nombre</th><th>Estatus</th><th>Usuario Alta</th><th>Usuario UM</th><th>Fecha Alta</th><th>Fecha UM</th></tr></thead><tbody id="lista_mesas"></tbody></table>');
    $.ajax({
        url:"controller/catalogos/ControllerMesas.php",
        data:{opc:opc,dataArray:dataArray,route:'listar'},
        type:"post",
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){

            var tablaMesas = '';
            console.log(response);
            if(response.data.length > 0){

                var rows = response.data;
                var selectorMesas = $("#lista_mesas");

                selectorMesas.html(' ');
                for(i=0;i<rows.length;i++){

                    tablaMesas += "<tr><td><button onclick='getViewEditarMesa(1,"+rows[i].idmesas+")' class='btn btn-default btn-sm '><i class='fa text-success fa-edit'></i></button> <button onclick='getDesactivarMesa("+rows[i].idmesas+")' class='btn btn-default btn-sm'><i class='fa  text-danger fa-trash'></i></button></td><td>"+rows[i].nombre+"</td><td><span class='badge'>"+rows[i].NombreEstatus+"</span></td><td>"+rows[i].UsuarioAlta+"</td><td>"+rows[i].UsuarioUM+"</td><td>"+rows[i].FechaAlta+"</td><td>"+rows[i].FechaUM+"</td></tr>";
                }

                selectorMesas.html(tablaMesas);
            }

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}
/**
 * Funcion para desactivar la mesa
 * @param idmesas
 */
function getDesactivarMesa(idmesas){

    if(idmesas == ""){
        MyAlert("La mesa no existe");
    }else{

        $.ajax({
            url:"controller/catalogos/ControllerMesas.php",
            type:"post",
            data:{
                route:'delete',
                idmesas:idmesas
            },
            dataType:"json",
            beforeSend:function () {
                fnloadSpinner(1);
            }
        }).done(function (response) {

            if(response.result){
                getMessage('','Mesa Desactivada','',2500);
                getListarMesas(1,1);
            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function(jqxhr,textStatus,errno){
            getthowError(jqxhr,textStatus);
            fnloadSpinner(2);
        });

    }
}
/**
 * Funcion para Editar las Mesas
 * @param opc
 * @param idmesas
 */
function getViewEditarMesa(opc,idmesas) {
    switch(opc){
        case 1:
            $.ajax({
                url:"views/catalogos/ViewEditarMesa.php",
                type:"post",
                data:{idmesas:idmesas}
            }).done(function (contenido) {
                $("#showmodal").html('');
                $("#showmodal").html(contenido);

            }).fail(function (jqxhr,textStatus,errno) {
                getthowError(jqxhr,textStatus);
            });
            break;
        case 2:

            var nombre = $("#nombre_mesa").val(),
                idestatus = $("#idestatus").val();

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombde");
            }else{
                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        opc:opc,
                        route:'editar',
                        nombre:nombre,
                        idestatus:idestatus,
                        idmesas:idmesas
                    },
                    url:"controller/catalogos/ControllerMesas.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){
                    if(response.result){
                        getMessage('Mesa editado','','',2500);
                        getViewCatalogoMesas();
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });

            }

            break;
        default:
            MyAlert("Opcion no valida");
            break;
    }
}
/**
 * Funcion para registrar una nueva mesa
 * @param opc
 */
function getViewRegistrarMesa(opc){
    switch(opc){
        case 1:
            $.ajax({
                url:"views/catalogos/ViewNuevaMesa.php",
                type:"post"
            }).done(function(contenido){
                $("#showmodal").html(contenido);
            }).fail(function (jqxhr,textStatus,errno) {
                getthowError(jqxhr,textStatus);
            });
            break;
        case 2:

            var nombre = $("#nombre_mesa").val(),
                idestatus = $("#idestatus").val();

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombre");
            }else{
                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        opc:opc,
                        route:'registrar',
                        nombre:nombre,
                        idestatus:idestatus
                    },
                    url:"controller/catalogos/ControllerMesas.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){
                    if(response.result){
                        getMessage('Mesa registrado','','',2500);
                        getListarMesas(1,{});
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });

            }

            break;
    }
}
/**
 * Funcion para buscar mesas
 * @param opc
 */
function getViewBusarMesa(opc){
    switch (opc) {
        case 1: //Mostrar Frm para Buscar la mesa
            $.ajax({
                url: "views/catalogos/ViewBuscarMesa.php",
                data: {opc: opc},
                type: "post"
            }).done(function (contenido) {
                $("#showmodal").html('');
                $("#showmodal").html(contenido);
            }).fail(function (jqXHR, textStatus, errno) {
                getthowError(jqXHR, textStatus);
            });
            break;
        case 2: //Editar Mesa
            var idestatus = $("#idestatus").val(),
                txtcadena = $("#txtcadena").val();

            if($.trim(txtcadena)==""){txtcadena = "0";}
            getListarMesas(2,{idestatus:idestatus,txtcadena:txtcadena});
            break;
        default:
            MyAlert("la opcion no existe");
            break;
    }
}

/**
 * Catalogo Platillos
 */
function getViewEditarPlatillo(opc,idplatillo) {
    switch(opc){
        case 1:
            $.ajax({
                url:"views/catalogos/ViewEditarPlatillo.php",
                type:"post",
                data:{idplatillo:idplatillo}
            }).done(function (contenido) {
                $("#content_platillos").html('');
                $("#content_platillos").html(contenido);

            }).fail(function (jqxhr,textStatus,errno) {
                getthowError(jqxhr,textStatus);
            });
            break;
        //Funcion para guardar la edicion del platillos
        case 2:

            var nombre = $("#nombre_platillo").val(),
                unidad_medida = $("#umedida_platillo").val(),
                piezas = $("#piezas_platillo").val(),
                idcategoria = $("#categoria_platillo").val(),
                idsubcategoria = $("#scategoria_platillo").val(),
                precio_venta = setFormatoMoneda(1,$("#pventa_platillo").val()),
                precio_compra = setFormatoMoneda(1,$("#pcompra_platillo").val()),
                idestatus = $("#idestatus_platillo").val();

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombre del platillo");
            }else if(idcategoria == 0) {
                MyAlert("Seleccione la categoría");
            }else if(idsubcategoria == 0 ) {
                MyAlert("Seleccione la SubCategoría");
            }else if((unidad_medida == 0)){
                MyAlert("Ingrese el tipo de unidad");
            }else if(piezas == "" || isNaN(piezas)){
                MyAlert("Ingrese la cantidad en piezas");
            }else if(precio_venta == ""){
                MyAlert("Ingrese el precio de venta");
            }else if(precio_compra == ""){
                MyAlert("Ingrese el precio de compra");
            }else{

                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        route:'editar',
                        idplatillo:idplatillo,
                        nombre:nombre,
                        idcategoria:idcategoria,
                        idsubcategoria:idsubcategoria,
                        unidad_medida:unidad_medida,
                        piezas:piezas,
                        precio_venta:precio_venta,
                        precio_compra:precio_compra,
                        idestatus:idestatus
                    },
                    url:"controller/catalogos/ControllerPlatillos.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){

                    if(response.result){
                        getMessage('Platillo editar correctamente','','',2500);
                        getViewCatalogoPlatillos(1);
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });

            }

            break;
        default:
            MyAlert("Opcion no valida");
            break;
    }
}

//Mostrar Platillos para agregar al carrito
function getMostrarPlatillos(opcion){

    $.ajax({
        url:"controller/caja/ControllerListaPlatillos.php",
        data:{opc:1},
        type:"post",
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){

            var data = response.data;

            var rows_top = '';
            var rows_platillos = '<div class="row row-sm">';
            var rows_extras = '<div class="row row-sm">';
            var rows_bebidas = '<div class="row row-sm">';

            if(data.top.length > 0){
                //Mostrar Platillos
                for(i=0;i <  data.top.length;i++){
                    rows_top += '<div onclick="getAgregarPlatilloCarrito('+opcion+','+data.top[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.top[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.top[i].nombre+'</p></div></div></div>';
                }
                rows_top += '</div>';
            }

            if(data.platillos.length > 0){
                //Mostrar Platillos
                for(i=0;i <  data.platillos.length;i++){
                    rows_platillos += '<div onclick="getAgregarPlatilloCarrito('+opcion+','+data.platillos[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.platillos[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.platillos[i].nombre+'</p></div></div></div>';
                    //rows_platillos += '<button style="height: 150px;" class="btn no-padding btn-app btn-default">'+data.platillos[i].nombre+'<br><img width="60"  src="wcontent/img/platillos/'+data.platillos[i].url_img+'" /></button>';
                }
                rows_platillos += '</div>';
            }

            if(data.extras.length > 0 ){
                //Mostrar extras
                for(i=0;i <  data.extras.length;i++){
                    rows_extras += '<div onclick="getAgregarPlatilloCarrito('+opcion+','+data.extras[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.extras[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.extras[i].nombre+'</p></div></div></div>';
                    //rows_extras += '<button style="height: 150px;" class="btn no-padding btn-app btn-default">'+data.extras[i].nombre+'<br><img width="60" src="wcontent/img/platillos/'+data.extras[i].url_img+'" /></button>';
                }
                rows_extras += "</div>";
            }

            if(data.bebidas.length > 0 ){
                //Mostrar bebidas
                for(i=0;i <  data.bebidas.length;i++){
                    rows_bebidas += '<div onclick="getAgregarPlatilloCarrito('+opcion+','+data.bebidas[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.bebidas[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.bebidas[i].nombre+'</p></div></div></div>';
                    //rows_bebidas += '<button style="height: 150px;" class="btn no-padding btn-app btn-default">'+data.bebidas[i].nombre+'<br><img width="60" src="wcontent/img/platillos/'+data.bebidas[i].url_img+'" /></button>';
                }
                rows_bebidas += "</div>";
            }

            console.log(response);

            $("#home").html('<div class="row"><div class="col-md-12 mt-4">'+rows_top+'</div></div>');
            $("#platillos").html('<div class="row"><div class="col-md-12 mt-4">'+rows_platillos+'</div></div>');
            $("#extras").html('<div class="row"><div class="col-md-12 mt-4">'+rows_extras+'</div></div>');
            $("#bebidas").html('<div class="row"><div class="col-md-12 mt-4">'+rows_bebidas+'</div></div>');

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

//Mostrar platillo para agregar al pedido
function getMostrarPlatillosEdicion(idpedido){

    $.ajax({
        url:"controller/caja/ControllerListaPlatillos.php",
        data:{opc:1},
        type:"post",
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){

            var data = response.data;

            var rows_top = '';
            var rows_platillos = '<div class="row row-sm">';
            var rows_extras = '<div class="row row-sm">';
            var rows_bebidas = '<div class="row row-sm">';

            if(data.platillos.length > 0){
                //Mostrar Platillos
                for(i=0;i <  data.platillos.length;i++){
                    rows_platillos += '<div onclick="setAgregarPlatillo('+idpedido+','+data.platillos[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.platillos[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.platillos[i].nombre+'</p></div></div></div>';
                    //rows_platillos += '<button style="height: 150px;" class="btn no-padding btn-app btn-default">'+data.platillos[i].nombre+'<br><img width="60"  src="wcontent/img/platillos/'+data.platillos[i].url_img+'" /></button>';
                }
                rows_platillos += '</div>';
            }

            if(data.extras.length > 0 ){
                //Mostrar extras
                for(i=0;i <  data.extras.length;i++){
                    rows_extras += '<div onclick="setAgregarPlatillo('+idpedido+','+data.extras[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.extras[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.extras[i].nombre+'</p></div></div></div>';
                    //rows_extras += '<button style="height: 150px;" class="btn no-padding btn-app btn-default">'+data.extras[i].nombre+'<br><img width="60" src="wcontent/img/platillos/'+data.extras[i].url_img+'" /></button>';
                }
                rows_extras += "</div>";
            }

            if(data.bebidas.length > 0 ){
                //Mostrar bebidas
                for(i=0;i <  data.bebidas.length;i++){
                    rows_bebidas += '<div onclick="setAgregarPlatillo('+idpedido+','+data.bebidas[i].id+')" class="col-md-2 btPlattiloCart col-xs-3"><div class="card bg-gray hoverable animated flipInX " style="border: 2px #ECF0F5;min-height: 130px;max-height: 130px;"><div class="card-image small"><div class="img-contenedor cursor-pointer"><img src="wcontent/img/platillos/'+data.bebidas[i].url_img+'" style="max-height: 70px;" class="img-responsive"></div></div><div class="card-content " style="word-wrap: break-word;"><p class="text-center text-bold">'+data.bebidas[i].nombre+'</p></div></div></div>';
                    //rows_bebidas += '<button style="height: 150px;" class="btn no-padding btn-app btn-default">'+data.bebidas[i].nombre+'<br><img width="60" src="wcontent/img/platillos/'+data.bebidas[i].url_img+'" /></button>';
                }
                rows_bebidas += "</div>";
            }

            console.log(response);

            $("#home").html('<div class="row"><div class="col-md-12 mt-4">'+rows_top+'</div></div>');
            $("#platillos").html('<div class="row"><div class="col-md-12 mt-4">'+rows_platillos+'</div></div>');
            $("#extras").html('<div class="row"><div class="col-md-12 mt-4">'+rows_extras+'</div></div>');
            $("#bebidas").html('<div class="row"><div class="col-md-12 mt-4">'+rows_bebidas+'</div></div>');

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}
/**
 * Funcion para listar los platillos
 * @param opc
 * @param dataArray
 */
function getListarPlatillos(opc,dataArray){
    $("#content_platillos").addClass('no-padding');
    $("#content_platillos").html('<table class="table table-hover table-striped table-bordered"><thead><tr class="bg-aqua-gradient"><th>Funciones</th><th>Nombre</th><th>Categoría</th><th>Subcategoría</th><th>Precio Venta</th><th>Estatus</th><th>Usuario Alta</th><th>Fecha Alta</th></tr></thead><tbody id="lista_platillos"></tbody></table>');
    $.ajax({
        url:"controller/catalogos/ControllerPlatillos.php",
        data:{opc:opc,dataArray:dataArray,route:'listar'},
        type:"post",
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){

            var tablaPlatillos = '';
            console.log(response);
            if(response.data.length > 0){

                var rows = response.data;
                var selectorPlatillos = $("#lista_platillos");

                selectorPlatillos.html(' ');

                for(i=0;i<rows.length;i++){
                    tablaPlatillos += "<tr><td><button onclick='getViewEditarPlatillo(1,"+rows[i].idplatillo+")' class='btn btn-default btn-sm '><i class='fa text-success fa-edit'></i></button> <button onclick='getDesactivarPlatillo("+rows[i].idplatillo+")' class='btn btn-default btn-sm'><i class='fa  text-danger fa-trash'></i></button></td><td>"+rows[i].nombre+"</td><td>"+rows[i].NombreCategoria+"</td><td>"+rows[i].NombreSubCategoria+"</td><td class='currency' >"+rows[i].precio_venta+"</td><td><span class='badge'>"+rows[i].NombreEstatus+"</span></td><td>"+rows[i].UsuarioAlta+"</td><td>"+rows[i].FechaAlta+"</td></tr>";
                }

                selectorPlatillos.html(tablaPlatillos);
                $('.currency').numeric({prefix:'$ ', cents: true});
            }

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

/**
 * Funcion para ver el catalogo de platillos
 */
function getViewCatalogoPlatillos(){
    $.ajax({
        url:"views/catalogos/ViewCatalogoPlatillos.php",
        data:{opc:1},
        type:"post",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(contenido){
        $("#contenedor_catalogos").html(contenido);
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

/**
 * Pantalla para registrar nuevo platillo
 * @param opc
 */
function getViewNuevoPlatillo(opc) {
    switch (opc){
        case 1: //Mostrar Formulario para el alta del platillo
            $.ajax({
                url:"views/catalogos/getViewNuevoPlatillo.php",
                data:{object:1},
                type:"post",
                beforeSend:function () {
                    fnloadSpinner(1);
                }
            }).done(function(contenido){
                $("#content_platillos").html('');
                $("#content_platillos").html(contenido);
                fnloadSpinner(2);
            }).fail(function (jqXHR,textStatus,errno) {
                getthowError(jqXHR,textStatus);
                fnloadSpinner(2);
            });
            break;
        case 2: //Crear nuevo platillo
            var nombre = $("#nombre_platillo").val(),
                unidad_medida = $("#umedida_platillo").val(),
                piezas = $("#piezas_platillo").val(),
                idcategoria = $("#categoria_platillo").val(),
                idsubcategoria = $("#scategoria_platillo").val(),
                precio_venta = setFormatoMoneda(1,$("#pventa_platillo").val()),
                precio_compra = setFormatoMoneda(1,$("#pcompra_platillo").val()),
                idestatus = $("#idestatus_platillo").val();

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombre del platillo");
            }else if(idcategoria == 0) {
                MyAlert("Seleccione la categoría");
            }else if(idsubcategoria == 0 ) {
                MyAlert("Seleccione la SubCategoría");
            }else if((unidad_medida == 0)){
                MyAlert("Ingrese el tipo de unidad");
            }else if(piezas == "" || isNaN(piezas)){
                MyAlert("Ingrese la cantidad en piezas");
            }else if(precio_venta == ""){
                MyAlert("Ingrese el precio de venta");
            }else if(precio_compra == ""){
                MyAlert("Ingrese el precio de compra");
            }else{

                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        route:'registrar',
                        nombre:nombre,
                        idcategoria:idcategoria,
                        idsubcategoria:idsubcategoria,
                        unidad_medida:unidad_medida,
                        piezas:piezas,
                        precio_venta:precio_venta,
                        precio_compra:precio_compra,
                        idestatus:idestatus
                    },
                    url:"controller/catalogos/ControllerPlatillos.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){
                    console.log(response);

                    if(response.result){
                        getMessage('Platillo registrado correctamente','','',2500);
                        getViewCatalogoPlatillos(1);
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });

            }
            break;
        case 3:
            //Crear NickName al Usuario basado al empleado seleccionado
            var nombre = $("#idempleado option:selected").text();
            nombre = nombre.split(" ");
            $("#nombreCorto").val(nombre[0]+' '+nombre[1]);

            break;
        default:
            MyAlert("Opción invalida");
            break;
    }
}

function getDesactivarPlatillo(idplatillo){

    if(idplatillo == ""){
        MyAlert("El platillo no existe");
    }else{

        $.ajax({
            url:"controller/catalogos/ControllerPlatillos.php",
            type:"post",
            data:{
                route:'delete',
                idplatillo:idplatillo
            },
            dataType:"json",
            beforeSend:function () {
                fnloadSpinner(1);
            }
        }).done(function (response) {

            if(response.result){
                getMessage('Platillo desactivado','','',2500);
                getListarPlatillos(1,1);
            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function(jqxhr,textStatus,errno){
            getthowError(jqxhr,textStatus);
            fnloadSpinner(2);
        });

    }
}


/**
 * Catalogo de Clientes
 */

/**
 * Funcion para listar los clientes
 */
function getListarClientes(opc,dataArray){
    $("#content_clientes").addClass('no-padding');
    $("#content_clientes").html('<table class="table table-hover table-striped table-bordered"><thead><tr class="bg-aqua-gradient"><th>Funciones</th><th>Nombre</th><th>Estatus</th><th>Usuario Alta</th><th>Usuario UM</th><th>Fecha Alta</th><th>Fecha UM</th></tr></thead><tbody id="lista_clientes"></tbody></table>');
    $.ajax({
        url:"controller/catalogos/ControllerCliente.php",
        data:{opc:opc,dataArray:dataArray,route:'listar'},
        type:"post",
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){

            var tablaMesas = '';
            console.log(response);
            if(response.data.length > 0){

                var rows = response.data;
                var selectorMesas = $("#lista_clientes");

                selectorMesas.html(' ');
                for(i=0;i<rows.length;i++){

                    tablaMesas += "<tr><td><button onclick='getViewEditarCliente(1,"+rows[i].idcliente+")' class='btn btn-default btn-sm '><i class='fa text-success fa-edit'></i></button> <button onclick='getDesactivarCliente("+rows[i].idcliente+")' class='btn btn-default btn-sm'><i class='fa  text-danger fa-trash'></i></button></td><td>"+rows[i].nombre+ " " +rows[i].apellidos+"</td><td><span class='badge'>"+rows[i].NombreEstatus+"</span></td><td>"+rows[i].UsuarioAlta+"</td><td>"+rows[i].UsuarioUM+"</td><td>"+rows[i].FechaAlta+"</td><td>"+rows[i].FechaUM+"</td></tr>";
                }

                selectorMesas.html(tablaMesas);
            }

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

/**
 * Funcion para desactivar un cliente
 * @param idcliente
 */
function getDesactivarCliente(idcliente){

    if(idcliente == ""){
        MyAlert("El cliente no existe");
    }else{

        $.ajax({
            url:"controller/catalogos/ControllerCliente.php",
            type:"post",
            data:{
                route:'delete',
                idcliente:idcliente
            },
            dataType:"json",
            beforeSend:function () {
                fnloadSpinner(1);
            }
        }).done(function (response) {

            if(response.result){
                getMessage('Cliente Desactivado','','',2500);
                getListarMesas(1,1);
            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function(jqxhr,textStatus,errno){
            getthowError(jqxhr,textStatus);
            fnloadSpinner(2);
        });

    }
}

/**
 * Funcion para ver el catalogo de clientes
 */
function getViewCatalogoClientes(){
    $.ajax({
        url:"views/catalogos/ViewCatalogoClientes.php",
        data:{opc:1},
        type:"post",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(contenido){
        $("#contenedor_catalogos").html(contenido);
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

/**
 * Funcion para registrar nuevo cliente
 * @param opc
 */
function getViewRegistrarCliente(opc,object){

    switch(opc){
        // Mostrar Modal de nuevo cliente
        case 1:
            $.ajax({
                url:"views/catalogos/ViewNuevoCliente.php",
                type:"post",
                data:object
            }).done(function(contenido){
                $("#showmodal").html(contenido);
            }).fail(function (jqxhr,textStatus,errno) {
                getthowError(jqxhr,textStatus);
            });
            break;
        case 2:

            var nombre = $("#nombre_cliente").val(),
                apellidos = $("#apellido_cliente").val(),
                direccion = $("#direccion_cliente").val(),
                telefono = $("#telefono_cliente").val(),
                celular = $("#celular_cliente").val(),
                correo = $("#correo_cliente").val(),
                idestatus = $("#idestatus").val();

            console.log(object);

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombre");
            }else{
                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        frm:object,
                        opc:opc,
                        route:'registrar',
                        nombre:nombre,
                        apellidos:apellidos,
                        direccion:direccion,
                        telefono:telefono,
                        celular:celular,
                        correo:correo,
                        idestatus:idestatus
                    },
                    url:"controller/catalogos/ControllerCliente.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){
                    if(response.result){
                        getMessage(response.message,'','',2500);
                        if(object.frm == "caja"){
                            $("#cliente_pedido").val(response.data.idcliente+"-"+nombre+" "+apellidos);
                        }
                        setCloseModal("mdlNuevoCliente");
                        //getListarMesas(1,{});
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });

            }

            break;
    }
}

/**
 * Funcion para editar el cliente
 * @param opc
 * @param idcliente
 */
function getViewEditarCliente(opc,idcliente) {
    switch(opc){
        case 1:
            $.ajax({
                url:"views/catalogos/ViewEditarCliente.php",
                type:"post",
                data:{idcliente:idcliente}
            }).done(function (contenido) {
                $("#showmodal").html('');
                $("#showmodal").html(contenido);

            }).fail(function (jqxhr,textStatus,errno) {
                getthowError(jqxhr,textStatus);
            });
            break;
        case 2:

            var nombre = $("#nombre_cliente").val(),
                apellidos = $("#apellido_cliente").val(),
                direccion = $("#direccion_cliente").val(),
                telefono = $("#telefono_cliente").val(),
                celular = $("#celular_cliente").val(),
                correo = $("#correo_cliente").val(),
                idestatus = $("#idestatus").val();

            if($.trim(nombre) == ""){
                MyAlert("Ingrese el nombre");
            }else{

                $.ajax({
                    type: "POST",
                    dataType:"json",
                    data: {
                        opc:opc,
                        route:'editar',
                        nombre:nombre,
                        apellidos:apellidos,
                        direccion:direccion,
                        telefono:telefono,
                        celular:celular,
                        correo:correo,
                        idestatus:idestatus,
                        idcliente:idcliente
                    },
                    url:"controller/catalogos/ControllerCliente.php",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){
                    if(response.result){
                        getMessage('Cliente editado','','',2500);
                        getViewCatalogoClientes();
                    }else{
                        MyAlert(response.message);
                    }
                    fnloadSpinner(2);
                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });
            }

            break;
        default:
            MyAlert("Opcion no valida");
            break;
    }
}

/**
 * Funcion para buscar clientes
 * @param opc
 */
function getViewBusarCliente(opc){
    switch (opc) {
        case 1: //Mostrar Frm para buscar cliente
            $.ajax({
                url: "views/catalogos/ViewBuscarCliente.php",
                data: {opc: opc},
                type: "post"
            }).done(function (contenido) {
                $("#showmodal").html('');
                $("#showmodal").html(contenido);
            }).fail(function (jqXHR, textStatus, errno) {
                getthowError(jqXHR, textStatus);
            });
            break;
        case 2: //Buscar Cliente

            var idestatus = $("#idestatus").val(),
                txtcadena = $("#txtcadena").val();

            if($.trim(txtcadena)==""){txtcadena = "0";}
            getListarClientes(2,{idestatus:idestatus,txtcadena:txtcadena});
            break;
        default:
            MyAlert("la opcion no existe");
            break;
    }
}

/**
 * Funciones de Caja
 */

/**
 * Funciones de Pedidos
 */

function getDetallePedido(idpedido,detalles) {

    console.log(detalles);

    idpedido = parseInt(idpedido);
    console.log(idpedido);

    $('#idorden_pedido').val(idpedido);
    $("#total_detalle_items").text(0);

    var nombre = '',telefono ='',total =0 , subtotal = 0, mesa = '', items = '',domicilio='',costo_domicilio=0,lista_detalle = $("#lista_detalle_pedido"),cont=0;

    if(detalles.detalle.length > 0){
        for(i=0;i < detalles.detalle.length;i++){

            if(detalles.detalle[i].idpedido == idpedido){
                subtotal = parseFloat(detalles.detalle[i].precio_venta * detalles.detalle[i].cantidad);
                items += '<tr class="h5" ><td><img width="55" src="wcontent/img/platillos/'+detalles.detalle[i].url_img+'"></td><td>'+detalles.detalle[i].NombrePlatillo+'</td><td class="currency">'+detalles.detalle[i].precio_venta+'</td><td class="text-center">'+detalles.detalle[i].cantidad+'</td><td class="currency">'+subtotal+'</td></tr>';
                if(detalles.detalle[i].adomicilio == 1){
                    domicilio = "<tr class='h5'><td><i class='fa fa-motorcycle fa-2x'></i></td><td>Servicio a domicilio</td><td class='currency'>"+detalles.detalle[i].costo_domicilio+"</td><td class='text-center'>1</td><td class='currency'>"+detalles.detalle[i].costo_domicilio+"</td></tr>";
                }
                costo_domicilio = parseFloat(detalles.detalle[i].costo_domicilio);
                $('#cliente_pedido').val(detalles.detalle[i].NombreCliente);
                $('#telefono_pedido').val(detalles.detalle[i].telefono);
                $('#mesa_pedido').val(detalles.detalle[i].NombreMesa);
                $('#estatus_pedido').val(detalles.detalle[i].idestatus);
                total += subtotal;
                cont++;

            }
        }

        $("#total_detalle_items").text(cont);
    }else{
        $('#lista_detalle_pedido').html(' ');
    }

    items += domicilio;
    items += '<tr class="h4 text-bold"><td colspan="4" class="text-right">Total:</td><td class="currency bg-black text-white">'+(total+costo_domicilio)+'</td></tr>';

    lista_detalle.html(items);
    $(".currency").numeric();
}

function getCancelarPedido(idpedido){

    bootbox.confirm({
        title: "Cancelacion de pedido",
        message: "Esta seguro cancelar el pedido.",
        size:"small",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Aceptar'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    url:"controller/caja/ControllerPedidos.php",
                    type:"post",
                    data:{
                        route:"cancel",
                        idpedido:idpedido
                    },
                    dataType:"json",
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function(response){

                    console.log(response);

                    if(response.result){

                        getMessage(response.message,'','success',1500);
                        getViewPedidos();

                    }else{
                        MyAlert(response.message,'error');
                    }

                }).fail(function(jqXHR,textStatus,errno){
                    getthowError(jqXHR,textStatus);
                }).complete(function(){
                    fnloadSpinner(2);
                });
            }
        }
    });

}

//Listar todos los pedidos, de acuerdo al estatus
function getListarPedidos(idestatus){

    $.ajax({
        url:"controller/caja/ControllerPedidos.php",
        type:"post",
        dataType:'json',
        data:{
            route:'listar',
            idestatus:idestatus
        },
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function (response) {
        if(response.result){
            console.log(response);

            $("#total_pedidos_items").text(response.data.pedidos.length);

            if(response.data.pedidos.length > 0){

                var items = '',content_list = $('#lista_pedidos');
                for(i=0;i<response.data.pedidos.length;i++){
                    items += '<tr><td>'+response.data.pedidos[i].idpedido+'</td><td>'+response.data.pedidos[i].NombreCliente+'</td><td class="currency">'+response.data.pedidos[i].Total+'</td><td><button value="'+response.data.pedidos[i].idpedido+'" title="Ver Pedido" class="btn btnVerPedido btn-xs btn-info" ><i class="fa fa-eye"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Editar Pedido" value="'+response.data.pedidos[i].idpedido+'" class="btn btnEditarPedido btn-xs btn-primary" ><i class="fa fa-edit"></i></button> &nbsp;&nbsp;&nbsp;&nbsp; <button title="Cancelar Pedido" onclick="getCancelarPedido('+response.data.pedidos[i].idpedido+')" class="btn btn-xs btn-danger" ><i class="fa fa-close"></i></button></td></tr>';
                }

                content_list.html(items);

                $('.currency').numeric({prefix:'$ ', cents: true});

                $(".btnVerPedido").on('click',function(e){
                    console.log(e);
                    getDetallePedido(e.currentTarget.value,response.data);
                });

                $(".btnEditarPedido").on('click',function(e){
                    console.log(e);
                    getViewEditarPedidos(e.currentTarget.value);
                });

            }else{
                $('#lista_pedidos').html(' ');
                $('#lista_detalle_pedido').html(' ');
            }

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
        fnloadSpinner(2);
    });

}

function setCrearTicket(idpedido){

    if(idpedido == null){
        MyAlert("Ingrese el numero de Folio");
    }else if(idpedido == 0 ){
        MyAlert("Ingrese el numero de Folio");
    }else if(isNaN(idpedido)){
        MyAlert("Ingrese el numero de Folio");
    }else{
        var win = window.open("views/caja/ViewTicket.php?pc=2&qp="+idpedido+"","","location=no,width=100,height=500,scrollbars=NO,menubar=NO,titlebar=NO,toolbar=NO");
        setTimeout(function () { win.close();}, 3500);
    }
}

function setCobrarPedido(idpedido){

    var totalImporte = $("#importe_total").val(),
        importeRecibido = $("#importe_pagado").val();

    totalImporte = setFormatoMoneda(1,totalImporte);
    importeRecibido = setFormatoMoneda(1,importeRecibido);

    if(parseFloat(importeRecibido) < parseFloat(totalImporte)){
        MyAlert("Ingrese la cantidad correcta "+totalImporte + "-"+importeRecibido);
    }else{

        $.ajax({
            url:"controller/caja/ControllerPedidos.php",
            type:"post",
            data:{
                route:"cobrar",
                idpedido:idpedido,
                importe_venta:totalImporte,
                importe_pagado:importeRecibido,
                tipo_pago:1
            },
            dataType:"json",
            beforeSend:function () {
                fnloadSpinner(1);
            }
        }).done(function(response){
            console.log(response);
            if(response.result){

                //Listar pedidos activos
                getViewCaja();
                $("#idbotoncobrar").remove();
                $(".control_cobrar").addClass("hidden");
                $(".control_cambio").removeClass("hidden");
                $("#importe_cambio").val(response.data.Cambio);
                $("#importe_pagado").attr('disabled',true);
                //$("#idbotonimprimir").removeClass("hidden");
                $(".currency").numeric();
                setCrearTicket(idpedido);

            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function(jqXHR,textStatus,errno){
            getthowError(jqXHR,textStatus);
            fnloadSpinner(2);
        });

    }


}

function setAddImage(e){
    console.log(e);

    var file = e.target.files[0],
        imageType = /image.*/;

    if (!file.type.match(imageType))
        return;

    var reader = new FileReader();
    reader.onload = setImgOnload;
    reader.readAsDataURL(file);
}

function setImgOnload(e) {
    console.log(e);
    var result=e.target.result;
    $('#imgLogo').attr("src",result);
}

function setSaveConfiguracion() {

    var AppKey = localStorage.getItem('key');

    var nombre = $("#nombre_empresa").val(),
        colonia = $("#colonia").val(),
        calle = $("#calle").val(),
        tel1 = $("#tel1").val(),
        tel2 = $("#tel2").val(),
        celular = $("#celular").val(),
        tema = $("#tema").val(),
        logo = $("#logo").val(),
        sidebar = $("#sidebar").val(),
        licencia = $("#licencia").val(),
        apertura = $("#apertura").is(':checked'),
        acceso_restringido = $("#acceso_restringido").is(':checked'),
        serv_domicilio = $("#serv_domicilio").is(':checked'),
        cambiar_clave = $("#cambiar_clave").is(':checked'),
        print_ticket = $("#print_ticket").is(':checked'),
        logo_ticket = $("#logo_ticket").is(':checked'),
        tel_ticket = $("#tel_ticket").is(':checked'),
        group_ticket = $("#group_ticket").is(':checked'),
        automatico_ticket = $("#automatico_ticket").is(':checked'),
        close_ticket = $("#close_ticket").is(':checked');

    console.log(close_ticket);

    $.ajax({
        url:"controller/config/ControllerConfig.php",
        type:"post",
        dataType:"json",
        data:{
            key:AppKey,
            nombre:nombre,
            colonia:colonia,
            calle:calle,
            tel1:tel1,
            tel2:tel2,
            celular:celular,
            tema:tema,
            logo:logo,
            sidebar:sidebar,
            licencia:licencia,
            apertura:apertura,
            acceso_restringido:acceso_restringido,
            serv_domicilio:serv_domicilio,
            cambiar_clave:cambiar_clave,
            print_ticket:print_ticket,
            logo_ticket:logo_ticket,
            tel_ticket:tel_ticket,
            group_ticket:group_ticket,
            automatico_ticket:automatico_ticket,
            close_ticket:close_ticket
        },
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function (response) {

        if (response.result){

            getMessage('Datos Acutalizados','','success',1800);

            location.reload();

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });

}

function getViewCobrar(idpedido) {

    $.ajax({
        url:"views/caja/ViewCobrar.php",
        type:"post",
        data:{idpedido:idpedido}
    }).done(function (contenido) {
        $("#idgeneral").html(contenido);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
    });

}

function getViewMovimientos(opc){

    $.ajax({
        url:"controller/caja/ControllerPedidos.php",
        type:"post",
        data:{
            route:'movimientos',
            opc:opc
        },
        dataType:"json",
        beforeSend:function(){
            fnloadSpinner(1);
        }
    }).done(function(response){
        var items='',stotal=0;
        console.log(response);
        $("#content_caja").html('<div class="row row-sm"><div class="col-md-12 "><div class="box  box-info"><div class="toolbars"><button class="btn btn-primary btn-sm" onclick="getViewCaja()"><i class="fa fa-arrow-left"></i> Regresar</button></div> <div class="box-body table-responsive"> <table class="table table-hover table-striped table-condensed" ><thead><tr><th>Pedido</th><th>Cliente</th><th>Serv. Domicilio</th><th class="text-right">Importe Total</th><th class="text-right">Importe Recibido</th><th>Tipo de Pago</th><th>Cajero</th><th>Fecha</th></tr></thead><tbody id="lista_movimientos"></tbody></table> </div> </div></div></div>');
        if(response.result){

            if (response.data.length > 0){
                for (i=0; i < response.data.length;i++){
                    stotal = parseFloat(stotal +  parseFloat(response.data[i].importe_venta) );
                    items += '<tr><td>'+response.data[i].idpedido+'</td><td>'+response.data[i].NombreCliente+'</td><td>'+response.data[i].adomicilio+'</td><td class="currency">'+response.data[i].importe_venta+'</td><td class="currency">'+response.data[i].importe_pagado+'</td><td>'+response.data[i].tipo_pago+'</td><td>'+response.data[i].nickname+'</td><td>'+response.data[i].FechaAlta+'</td></tr>';
                }
            }

            items += "<tr><td colspan='3' class='text-right text-bold'>Total: </td><td class='currency border-gray text-bold h5'>"+stotal+"</td><td colspan='4'></td></tr>";

            $("#lista_movimientos").html(items);
            $(".currency").numeric();

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}


/**
 * Funcion para agregar el cliente al pedido
 */
function getAgregarClientePedido(idcliente,opc){
    $.ajax({
        url:"controller/catalogos/ControllerCliente.php",
        type:"post",
        dataType:"json",
        data:{route:'get',idcliente:idcliente},
        beforeSend:function(){
            fnloadSpinner(1);
        }
    }).done(function (response) {
        console.log(response);
        if(response.result){

            $("#cliente_pedido").val(idcliente+"-"+response.data[0].nombre+" "+response.data[0].apellidos);
            $("#direccion_pedido").val(response.data[0].direccion);
            setCloseModal('mdlBuscarCliente');

            setTimeout(function(){getViewCostoServicio(opc) },500);

        }else{
            MyAlert(response.message,"error");
        }
        fnloadSpinner(2);
    }).fail(function(jqXHR,textStatus,error){
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}

function setCancelarPlatillo(idpedido,idplatillo){

    console.log(idplatillo);

    bootbox.confirm({
        title: "Cancelacion de Platillo",
        message: "Esta seguro cancelar el platillo.",
        size:"small",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Aceptar'
            }
        },
        callback: function (result) {

            if(result){

                $.ajax({
                    url:"controller/caja/ControllerPedidos.php",
                    type:"POST",
                    dataType:"json",
                    data:{
                        route:"delete",
                        iddetalle_pedido:idplatillo,
                        idpedido:idpedido
                    },
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function (response) {

                    if(response.result){

                        $('#servicio_domicilio').prop('checked',false);
                        getMostrarPedidos(idpedido);



                    }else{
                        MyAlert(response.message);
                    }

                    fnloadSpinner(2);
                }).fail(function (jqhr,textStatus,errno) {

                    fnloadSpinner(2);
                    getthowError(jqhr,textStatus);

                });

            }
        }
    });

}

function getMostrarPedidos(idpedido) {
    $.ajax({
        url:"controller/caja/ControllerPedidos.php",
        type:"post",
        dataType:'json',
        data:{
            route:'get',
            idpedido:idpedido
        },
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function (response) {
        if(response.result){

            console.log(response);

            if(response.data.length > 0 ){

                var lista = $("#list_cart_ventas"),item = '',con=0,subtotal=0,total=0;

                var idcliente = response.data[0].idcliente,
                    nombre = response.data[0].NombreCliente,
                    telefono = response.data[0].telefono,
                    idmesa = response.data[0].NombreMesa;

                for(i=0; i < response.data.length;i++){

                    con++;
                    subtotal = (response.data[i].precio_venta * response.data[i].cantidad);
                    item += "<tr><td>"+con+"</td><td>"+response.data[i].NombrePlatillo+"</td><td>"+response.data[i].precio_venta+"</td><td>"+response.data[i].cantidad+"</td><td>"+subtotal+"</td><td><button onclick='setCancelarPlatillo("+idpedido+","+response.data[i].iddetalle+")' class='btn btn-xs btn-danger'><i class='fa fa-close'></i></button></td></tr>";
                    total = (total + subtotal);
                }

                $("#btnServDomicilio").removeClass("btn-success").addClass("btn-default");
                if(response.data[0].costo_domicilio > 0){
                    item += "<tr><td>"+con+"</td><td>Costo domicilio</td><td>"+response.data[0].costo_domicilio+"</td><td>1</td><td>"+response.data[0].costo_domicilio+"</td><td><button onclick='setCancelarPlatillo("+idpedido+",\"CXS\" )' class='btn btn-xs btn-danger'><i class='fa fa-close'></i></button></td></tr>";
                    total = (total + parseFloat(response.data[0].costo_domicilio));
                    $("#btnServDomicilio").removeClass("btn-default").addClass("btn-success");
                }

                if(response.data[0].adomicilio == 1){
                    $("#servicio_domicilio").prop('checked',true);
                }

                lista.html(item);
                $("#cliente_pedido").val(idcliente + "-"+nombre);
                $("#mesa_pedido").val(idmesa);
                $("#direccion_pedido").val(idcliente + "-"+nombre);
                $("#costo_domicilio").val(response.data[0].costo_domicilio);


                $("#ledcaja").text(total);
                $(".currency").numeric();
            }


        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
        fnloadSpinner(2);
    });
}

function getBuscarPedido() {

    var idpedido = $("#idpedido").val();

    if(idpedido == 0){
        MyAlert("Ingrese el folio del pedido");
    }else if(isNaN(idpedido)){
        MyAlert("Ingrese el folio del pedido");
    }else{
        $.ajax({
            url:"controller/caja/ControllerPedidos.php",
            type:"post",
            dataType:'json',
            data:{
                route:'get',
                idpedido:idpedido
            },
            beforeSend:function () {
                fnloadSpinner(1);
            }
        }).done(function (response) {
            if(response.result){

                console.log(response);



                if(response.data.length > 0 ){
                    getDetallePedido(idpedido,{detalle:response.data});
                }


            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function (jqxhr,textStatus,errno) {
            getthowError(jqxhr,textStatus);
            fnloadSpinner(2);
        });
    }
}

/**
 * Funcion para Agregar el Platillo
 */

function setCrearPedido(viewResponse){

    var cliente = $("#cliente_pedido").val(),
        mesa = $("#mesa_pedido").val(),
        sdomicilio = $("#servicio_domicilio").is(':checked'),
        direccion = $("#direccion_pedido").val(),
        nproductos = $("#list_cart_ventas tr").length;

    var idcliente = cliente.split('-');
    idcliente = idcliente[0];

    var idmesa = mesa.split("-");
    idmesa = idmesa[1];

    if(sdomicilio){
        idmesa = 1;
    }

    if($.trim(cliente) == ""){
        MyAlert("Seleccione un cliente");
    }else if($.trim(mesa) == ""){
        MyAlert("Seleccione una mesa ");
    }else if(sdomicilio == true &&  $.trim(direccion) == "" ){
        MyAlert("Ingrese el domicilio del cliente");
    }else if(sdomicilio == false &&  $.trim(direccion) != "" ){
        MyAlert("Ingrese el costo del servicio a domicilio");
    }else if(idcliente == 1 && sdomicilio == true){
        MyAlert("Seleccione un cliente, distinto a mostrador. para el servicio a domicilio");
    }else if(nproductos <= 0 ){
        MyAlert("Seleccione almenos un producto al pedido");
    }else{
        var costodomicilio = 0;
        if(sdomicilio){
            sdomicilio = 1;
            costodomicilio = $("#costo_domicilio").val();

        }else{
            sdomicilio = 0;
        }

        $.ajax({
            url:"controller/caja/ControllerPedidos.php",
            type:"post",
            dataType:"json",
            data:{
                route:'agregar',
                idcliente:idcliente,
                idmesa:idmesa,
                sdomicilio:sdomicilio,
                costodomicilio:costodomicilio,
                direccion:direccion
            },
            beforeSend:function(){
                fnloadSpinner(1);
            }
        }).done(function(response){

            if(response.result){

                console.log(response);
                if(viewResponse == 1){
                    getMessage("Pedido creado correctaemnte","","success",3500);
                    getViewCaja();
                }else if(viewResponse == 2){
                    //Mostrar Caja y Cobrar
                    getViewCaja();
                    getViewCobrar(response.data[0].id);
                }

            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function (jqXHR,textStatus,errno) {
            getthowError(jqXHR,textStatus);
            fnloadSpinner(2);
        });

    }

}

function getAgregarPlatilloCarrito(opcion,idplatillo){

    $.ajax({
        url:"controller/caja/ControllerCarritoPedidos.php",
        type:"post",
        dataType:"json",
        data:{
            opcion:opcion,
            idplatillo:idplatillo,cantidad:1,route:'addcart'
        },
        beforeSend:function(){
            fnloadSpinner(1);
        }
    }).done(function (response) {

        if(response.result){
            console.log(response);

            switch (opcion){
                case 1:
                    getListarPlatilloCarrito(response.data);
                    break;
                case 2:
                    getMostrarPedidos();
                    break;
                default:
                    MyAlert("Opcion no valida");
                    break;
            }

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,error) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });

}


function setAgregarPlatillo(idpedido,idplatillo){

    $.ajax({
        url:"controller/caja/ControllerPedidos.php",
        type:"post",
        dataType:"json",
        data:{
            id:idpedido,
            idplatillo:idplatillo,cantidad:1,route:'set'
        },
        beforeSend:function(){
            fnloadSpinner(1);
        }
    }).done(function (response) {

        if(response.result){
            console.log(response);
            getMostrarPedidos(idpedido);

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,error) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });

}
/**
 * Funcion para listar los platillos del carrito
 * @param data
 */
function getListarPlatilloCarrito(data){

    var tabla_pedido_carrito = $("#list_cart_ventas"),itemsCarrito = '',cont=0,total=0;

    if(data == null){
        data = 0;
    }

    if(data.length > 0){

        for(i=0;i < data.length;i++){
            cont++;
            itemsCarrito += "<tr><td>"+cont+"</td><td>"+data[i].descripcion+"</td><td class='currency' >"+data[i].precio+"</td><td>"+data[i].cantidad+"</td><td class='text-right currency' >"+data[i].subtotal+"</td><td><button onclick='getQuitarPlatilloCarrito(\""+data[i].uid+"\",\""+data[i].id+"\")' class='btn btn-xs btn-danger'><i class='fa fa-close'></i></button></td></tr>";
            total += data[i].subtotal;
        }
    }

    tabla_pedido_carrito.html(itemsCarrito);
    $("#ledcaja").text(total);
    $('.currency').numeric({prefix:'$ ', cents: true});


}
/**
 * Funcion para eliminar el platillo del carrito
 * @param uid
 */
function getQuitarPlatilloCarrito(uid,id){

    $.ajax({
        url:"controller/caja/ControllerCarritoPedidos.php",
        type:"post",
        data:{
            route:'delete',
            uid:uid
        },
        dataType:"json",
        beforeSend:function(){
            fnloadSpinner(1);
        }
    }).done(function(response){

        if(response.result){
            if (id == "CXS"){

                $("#servicio_domicilio").attr('checked',false);

                $("#costo_domicilio").val("0");

                if($("#btnServDomicilio").hasClass('btn-success')){
                    $("#btnServDomicilio").removeClass('btn-success').addClass('btn-default');
                }else{
                    $("#btnServDomicilio").removeClass('btn-default').addClass('btn-success');
                }
            }
            getListarPlatilloCarrito(response.data);
        }else{
            MyAlert(response.message);
        }

        fnloadSpinner(2);
    }).fail(function(jqXHR,textStatus,errno){
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });


}
/**
 * Funcion para buscar cliente
 */
function getBuscarCliente(opc){
    switch (opc){
        case 1:
            $.ajax({
                url:"views/caja/ViewBuscarCliente.php",
                type:"post",
                data:{opc:opc}
            }).done(function (contenido) {
                $("#idgeneral").html(contenido);
            }).fail(function (jqxhr,textStatus,errno) {
                getthowError(jqxhr,textStatus);
            });
            break;
        case 2:

            var telefono = $("#textBusqueda").val();
            var idpedido = $("#btnfolio").val();
            var opc2 = 1;

            if(idpedido > 0 ){
                opc2 = 2;
                console.log('vengo de edicion de pedido');
            }


            $.ajax({
                url:"controller/catalogos/ControllerCliente.php",
                data:{opc:opc,dataArray:{txtcadena:telefono},route:'listar'},
                type:"post",
                dataType:"json",
                beforeSend:function () {
                    fnloadSpinner(1);
                }
            }).done(function(response){

                if(response.result){

                    var listaClientes = '',
                        contentCliente = $("#lista_busqueda_cliente");

                    if(response.data.length > 0){

                        for(i=0;i<response.data.length;i++){
                            listaClientes += '<tr onclick="getAgregarClientePedido('+response.data[i].idcliente+','+opc2+')" class="cursor-pointer" ><td>'+response.data[i].nombre+'</td><td>'+response.data[i].telefono+'</td><td>'+response.data[i].direccion+'</td></tr>';
                        }

                    }
                    console.log(listaClientes);
                    contentCliente.html(listaClientes);

                }else{
                    MyAlert(response.message);
                }

                fnloadSpinner(2);
            }).fail(function (jqXHR,textStatus,errno) {
                getthowError(jqXHR,textStatus);
                fnloadSpinner(2);
            });

            break;
        default:
            MyAlert("Opcion no encontrada","error");
            break;
    }
}

/**
 * ### END Funciones Generales
 **
 *
 *========================================================
 *
 *========================================================*
 **
 /**
 * Funciones de la Aplicacion General
 */
function gnlogin_out(){

    bootbox.confirm({
        title: "Salir del Sistema",
        message: "Esta seguro de salir del sistema.",
        size:"small",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Aceptar'
            }
        },
        callback: function (result) {

            if(result){

                $.ajax({
                    url:"controller/login/ControllerLogOut.php",
                    type:"POST",
                    dataType:"json",
                    data:{},
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function (response) {

                    if(response.result){
                        location.reload();
                    }


                }).fail(function (jqhr,textStatus,errno) {

                    fnloadSpinner(2);
                    getthowError(jqhr,textStatus);

                });

            }
        }
    });
}

/**
 * Funciones para la configuracion del sistema
 */
function getViewConfiguracion(){
    $.ajax({
        url:"views/configuraciones/ViewConfiguraciones.php",
        type:"get"
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    });
}

/**
 *Funciones para ver las graficas
 */
function getViewGraficas(){
    $.ajax({
        url:"views/reportes/ViewGraficas.php",
        type:"get"
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    });
}

/**
 * Funciones para los reportes Generales
 */
function getViewReportes(){
    $.ajax({
        url:"views/reportes/ViewReportes.php",
        type:"get"
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    });
}
/**
 * Funciones para la administracion de la caja
 */
function getValidarCierreAnterior(){
    $.ajax({
        url:"controller/caja/ControllerApertura.php",
        type:"post",
        data:{
            route:"validarCierre"
        },
        dataType:"json",
        beforeSend:function(){
            fnloadSpinner(1);
        }
    }).done(function (response) {
        console.log(response);
        if (response.result){
            switch (response.data.response){
                case 'cierre':
                    $.ajax({
                        url:"views/caja/ViewCajaCierre.php",
                        type:"post",
                        data:{
                            fecha:response.data.FechaActual,
                            fechacierre:response.data.FechaUltimoCierre,
                            montocierre:response.data.MontoCierre
                        }
                    }).done(function (contenido) {
                        $("#div_general").html(contenido);
                    }).fail(function (jqxhr,textStatus,errno) {
                        getthowError(jqxhr,textStatus);
                    });
                    break;
                default:
                    $.ajax({
                        url:"views/caja/ViewCaja.php",
                        type:"get"
                    }).done(function (contenido) {
                        $("#div_general").html(contenido);
                    }).fail(function (jqxhr,textStatus,errno) {
                        getthowError(jqxhr,textStatus);
                    });
                    break;
            }
        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
        fnloadSpinner(2);
    });
}

function setCierre(){

    var fechacierre = $("#fechacierre").val(),
        montocierre = $("#montocierre").val();

    if ($.trim(fechacierre) == ""){
        MyAlert("Ingrese la fecha cierre");
    }else if (isNaN(parseFloat(montocierre))){
        MyAlert("El monto de cierre debe ser numerico");
    }else{
        $.ajax({
            url:"controller/caja/ControllerApertura.php",
            type:"post",
            data:{
                route:"setCierre",
                fechacierre:fechacierre,
                montocierre:montocierre
            }
        }).done(function (response) {
            console.log(response);
            if (response.result){
                $.ajax({
                    url:"views/caja/ViewCaja.php",
                    type:"get"
                }).done(function (contenido) {
                    $("#div_general").html(contenido);
                }).fail(function (jqxhr,textStatus,errno) {
                    getthowError(jqxhr,textStatus);
                });
            }else{
                MyAlert(response.message);
            }
            fnloadSpinner(2);
        }).fail(function (jqxhr,textStatus,errno) {
            getthowError(jqxhr,textStatus);
            fnloadSpinner(2);
        });
    }
}

function getViewCaja(){
    getValidarCierreAnterior();
}

function getExportReportesExcel() {
    window.open("views/reportes/ViewExportReport.php?pc=2&qp=1","","location=no,width=400,height=700,scrollbars=SI,menubar=NO,titlebar=NO,toolbar=NO");
}

function getBuscarReporte(){

    var FechaInicial = $("#fechainicial").val(),
        FechaFinal = $("#fechafinal").val(),
        idplatillo = $("#idplatillo").val(),
        idmesero = $("#idmesero").val(),
        idcajero = $("#idcajero").val(),
        idmesa = $("#idmesa").val(),
        idcliente = $("#idcliente").val(),
        adomicilio = $("#adomicilio").val(),
        idcategoria = $("#idcategoria").val(),
        idsubcategoria = $("#idsubcategoria").val(),
        tipocancelacion = $("#tipocancelacion").val();

    var report = $('input[name=inlineRadioOptions]:checked').val();

    console.log(report);

    $.ajax({
        url:"controller/reportes/ControllerReportes.php",
        type:"post",
        dataType:"json",
        data:{
            route:report,
            FechaInicial:FechaInicial,
            FechaFinal:FechaFinal,
            idplatillo:idplatillo,
            idmesero:idmesero,
            idcajero:idcajero,
            idmesa:idmesa,
            idcliente:idcliente,
            adomicilio:adomicilio,
            idcategoria:idcategoria,
            idsubcategoria:idsubcategoria,
            tipocancelacion:tipocancelacion
        },
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function(response){
        console.log(response);
        if(response.result){

            var data = response.data;

            if( Object.keys(data).length > 0 && Object.keys(data) != null ){
                var tablelist = '';
                switch (report){

                    case 'reporte01':
                        $("#ttlregistros").text(Object.keys(data).length);
                        tablelist = "<table class='table table-condensed table-hover table-striped' ><thead><tr><th class='text-center' colspan='7'>Reporte Ventas General</th></tr><tr><th>Pedido</th><th>Cliente</th><th class='text-right'>Serv. Domicilio</th><th class='text-right'>Importe Total</th><th class='text-center'>Tipo de Pago</th><th>Cajero</th><th>Fecha</th></tr></thead><tbody>";
                        var items = '',ttdomicilio = 0,total = 0;

                        for(i=0;i<Object.keys(data).length;i++){

                            items += '<tr><td>'+data[i].idpedido+'</td><td>'+data[i].NombreCliente+'</td><td class="text-right">'+data[i].adomicilio+'</td><td class="currency">'+data[i].importe_venta+'</td><td class="text-center">'+data[i].tipo_pago+'</td><td>'+data[i].nickname+'</td><td>'+data[i].FechaAlta+'</td></tr>';
                            if(data[i].adomicilio == "SI"){
                                ttdomicilio = (parseFloat(ttdomicilio) + parseFloat(data[i].importe_venta));
                            }
                            total = (parseFloat(total) + parseFloat(data[i].importe_venta));
                        }

                        items += "<tfoot><tr><th colspan='2'></th><th class='currency'>"+ttdomicilio+"</th><th class='currency'>"+total+"</th><th colspan='3'></th></tr></tfoot>";
                        tablelist += items + "</tbody></table>";
                        break;
                    case 'reporte02':
                        $("#ttlregistros").text(Object.keys(data).length);
                        tablelist = "<table class='table table-condensed table-hover table-striped' ><thead><tr><th class='text-center' colspan='5'>Reporte Por Clientes</th></tr><tr><th>Cliente</th><th class='text-right'>Importe Total</th><th class='text-center'>Tipo de Pago</th><th>Cajero</th><th>Fecha</th></tr></thead><tbody>";
                        var items = '',ttdomicilio = 0,total = 0;

                        for(i=0;i<Object.keys(data).length;i++){

                            items += '<tr><td>'+data[i].NombreCliente+'</td><td class="currency">'+data[i].importe_venta+'</td><td class="text-center">'+data[i].tipo_pago+'</td><td>'+data[i].nickname+'</td><td>'+data[i].FechaAlta+'</td></tr>';
                            if(data[i].adomicilio == "SI"){
                                ttdomicilio = (parseFloat(ttdomicilio) + parseFloat(data[i].importe_venta));
                            }
                            total = (parseFloat(total) + parseFloat(data[i].importe_venta));
                        }

                        items += "<tfoot><tr><th colspan='1'></th><th class='currency'>"+total+"</th><th colspan='3'></th></tr></tfoot>";
                        tablelist += items + "</tbody></table>";
                        break;
                    case 'reporte04':
                        $("#ttlregistros").text(Object.keys(data).length);
                        tablelist = "<table class='table table-condensed table-hover table-striped small' ><thead><tr><th class='text-center' colspan='11'>Reporte Por Platillos</th></tr><tr><th>Cliente</th><th>Mesa</th> <th>Platillo</th><th>Categoría</th><th>SubCategoría</th><th>Domicilio</th><th class='text-right'>Costo Domic.</th><th class='text-right'>Precio Platillo</th><th class='text-center'>Tipo de Pago</th><th>Cajero</th><th>Fecha</th></tr></thead><tbody>";
                        var items = '',ttdomicilio = 0,total = 0;

                        for(i=0;i<Object.keys(data).length;i++){

                            items += '<tr><td>'+data[i].NombreCliente+'</td><td>'+data[i].idmesa+'</td><td>'+data[i].NombrePlatillo+'</td><td>'+data[i].NombreCategoria+'</td><td>'+data[i].NombreSubCategoria+'</td><td>'+data[i].NombreADomicilio+'</td><td class="currency">'+data[i].costo_domicilio+'</td><td class="currency">'+data[i].precio_venta+'</td><td class="text-center">'+data[i].tipo_pago+'</td><td>'+data[i].nickname+'</td><td>'+data[i].FechaAlta+'</td></tr>';
                            if(data[i].NombreADomicilio == "SI"){
                                ttdomicilio = (parseFloat(ttdomicilio) + parseFloat(data[i].costo_domicilio));
                            }
                            total = (parseFloat(total) + parseFloat(data[i].precio_venta));
                        }

                        items += "<tfoot><tr><th colspan='7' class='currency'>"+ttdomicilio+"</th><th class='currency'>"+total+"</th><th colspan='3'></th></tr></tfoot>";
                        tablelist += items + "</tbody></table>";
                        break;
                    case 'reporte05':
                        var TituloReporte = 'Reporte Cancelación por Notas';

                        if(tipocancelacion == 2){TituloReporte = 'Reporte Cancelación por Pedidos';}
                        $("#ttlregistros").text(Object.keys(data).length);
                        tablelist = "<table class='table table-condensed table-hover table-striped' ><thead><tr><th class='text-center' colspan='9'>"+TituloReporte+"</th></tr><tr><th>Pedido</th><th>Cliente</th><th class='text-right'>Serv. Domicilio</th><th class='text-right'>Importe Total</th><th class='text-center'>Tipo de Pago</th><th>Cajero Registra</th><th>Fecha Registro</th><th>Cajero Canc.</th><th>Fecha Canc.</tr></thead><tbody>";
                        var items = '',ttdomicilio = 0,total = 0;

                        for(i=0;i<Object.keys(data).length;i++){

                            items += '<tr><td>'+data[i].idpedido+'</td><td>'+data[i].NombreCliente+'</td><td class="text-right">'+data[i].adomicilio+'</td><td class="currency">'+data[i].importe_venta+'</td><td class="text-center">'+data[i].tipo_pago+'</td><td>'+data[i].nickname+'</td><td>'+data[i].FechaAlta+'</td><td>'+data[i].CejeroCancelacion+'</td><td>'+data[i].FechaCancelacion+'</td></tr>';
                            if(data[i].adomicilio == "SI"){
                                ttdomicilio = (parseFloat(ttdomicilio) + parseFloat(data[i].importe_venta));
                            }
                            total = (parseFloat(total) + parseFloat(data[i].importe_venta));
                        }

                        items += "<tfoot><tr><th colspan='2'></th><th class='currency'>"+ttdomicilio+"</th><th class='currency'>"+total+"</th><th colspan='3'></th></tr></tfoot>";
                        tablelist += items + "</tbody></table>";
                        break;
                }



                $("#table_response").html(tablelist);
                $(".currency").numeric();
            }else{
                getMessage("",'No se encontraron resultados','warning',2500);
                $("#ttlregistros").text("0");
                $("#table_response").html('');
            }

            $("#btnModalReportes").click();

        }else{
            MyAlert(response.message);
            $("#ttlregistros").text("0");
            $("#table_response").html('');
        }
        fnloadSpinner(2);
    }).fail(function(jqXHR,textStatus,errno){
       getthowError(jqXHR,textStatus);
       fnloadSpinner(2);
    });



}
/**
 * Funciones para los indicadores
 */
function getViewIndicadores(){
    $.ajax({
        url:"views/indicadores/ViewIndicadores.php",
        type:"get"
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    });
}
function getViewContabilidad(){
    $.ajax({
        url:"views/contabilidad/ViewContabilidad.php",
        type:"get"
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    });
}

/**
 * Funcion para mostrar la pantalla de pedidos
 */
function getViewPedidos(){
    $.ajax({
        url:"views/caja/ViewPedidos.php",
        type:"get"
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    })
}

function getViewModalTicket(idpedido) {

    $.ajax({
        url:"views/caja/ViewModalTicket.php",
        type:"post",
        data:{idpedido:idpedido}
    }).done(function (contenido) {
        $("#mdlticket").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    })

}

function getViewEditarPedidos(idpedido){
    $.ajax({
        url:"views/caja/ViewEditarPedido.php",
        type:"post",
        data:{idpedido:idpedido}
    }).done(function (contenido) {
        $("#div_general").html(contenido);
    }).fail(function (jqxhr,textStatus,errno) {
        getthowError(jqxhr,textStatus);
    });
}

function getViewCostoServicio(opc){

    var idpedido = 0;

    if(opc == 2){
        idpedido = $("#btnfolio").val();

    }

    console.log(idpedido);

    if($("#servicio_domicilio").is(":checked")){
        getMessage('El pedido ya cuenta con costo de servicio','','',1500);
    }else{
        $.ajax({
            url:"views/caja/ViewCostoServicio.php",
            type:"post",
            data:{
                opc:opc,
                idpedido:idpedido
            },
            beforeSend:function(){
                fnloadSpinner(1);
            }
        }).done(function (contenido) {
            $("#idgeneral").html(contenido);
            fnloadSpinner(2);
        }).fail(function(jqXHR,textStatus,errno){
            getthowError(jqXHR,textStatus);
            fnloadSpinner(2);
        });
    }

}

function setAgregarCostoDomicilio(costo,callbackView,idpedido){

    costo =  parseFloat(costo);

    if (isNaN(costo)){
        MyAlert("El costo debe ser numerico");
    }else if (parseFloat(costo) == 0){
        MyAlert("Ingrese el costo del servicio");
    }else{

        switch (callbackView){

            case 2:
                $.ajax({
                    url:"controller/caja/ControllerPedidos.php",
                    type:"post",
                    dataType:"json",
                    data:{
                        route:"adomicilio",
                        idpedido:idpedido,
                        costo:costo
                    },
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function (response) {

                    if($("#btnServDomicilio").hasClass('btn-success')){
                        $("#btnServDomicilio").removeClass('btn-success').addClass('btn-default');
                    }else{
                        $("#btnServDomicilio").removeClass('btn-default').addClass('btn-success');
                    }

                    $("#servicio_domicilio").prop("checked",true);
                    $("#costo_domicilio").val(costo);

                    getViewEditarPedidos(idpedido);

                    setTimeout(function () {
                        setCloseModal("mdlDomicilio",true);
                    },400);


                    fnloadSpinner(2);
                }).fail(function (jqXHR,textStatus,errno) {
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });
                break;
            default:
                $.ajax({
                    url:"controller/caja/ControllerCarritoPedidos.php",
                    type:"post",
                    dataType:"json",
                    data:{route:"addcart",opcion:2,idplatillo:'CXS',cantidad:1,precio:costo,descripcion:"Costo domicilio"},
                    beforeSend:function () {
                        fnloadSpinner(1);
                    }
                }).done(function (response) {

                    if($("#btnServDomicilio").hasClass('btn-success')){
                        $("#btnServDomicilio").removeClass('btn-success').addClass('btn-default');
                    }else{
                        $("#btnServDomicilio").removeClass('btn-default').addClass('btn-success');
                    }

                    $("#servicio_domicilio").prop("checked",true);
                    $("#costo_domicilio").val(costo);

                    getListarPlatilloCarrito(response.data);

                    setTimeout(function () {
                        setCloseModal("mdlDomicilio",true);
                    },400);


                    fnloadSpinner(2);
                }).fail(function (jqXHR,textStatus,errno) {
                    getthowError(jqXHR,textStatus);
                    fnloadSpinner(2);
                });
                break;
        }

    }
}

function setDashboardHome(){

    var dataMeses = [];

    $.ajax({
        url:"controller/home/ControllerHome.php",
        type:"post",
        data:{},
        dataType:"json",
        beforeSend:function () {
            fnloadSpinner(1);
        }
    }).done(function (response) {

        if(response.result){

            $("#venta_del_dia").text(response.data.totalVentasDia);
            $("#venta_domicilio").text(response.data.totalVentasDomicilio);
            $("#total_venta").text(response.data.totalVentas);
            $("#ventas_canceladas").text(response.data.totalCancelacionesDia);

            if(response.data.totalPedidos != null){
                if(response.data.totalPedidos.length > 0 ){
                    var terminados = '',pendientes='';
                    var totalpedidos = response.data.totalPedidos;
                    var textColor = 'text-gray';
                    for(i=0;i< totalpedidos.length;i++){

                        if(totalpedidos[i].adomicilio == 1){
                            textColor = 'text-green';
                        }

                        if(totalpedidos[i].idestatus == 1){
                            pendientes += '<tr><td>'+totalpedidos[i].idpedido+'</td><td>'+totalpedidos[i].NombreCliente+'</td><td>'+totalpedidos[i].FechaAlta+'</td><td><i class="fa '+textColor+' fa-motorcycle"></i></td><td>'+totalpedidos[i].Total+'</td></tr>';
                        }else if(totalpedidos[i].idestatus == 2){
                            terminados += '<tr><td>'+totalpedidos[i].idpedido+'</td><td>'+totalpedidos[i].NombreCliente+'</td><td>'+totalpedidos[i].FechaAlta+'</td><td><i class="fa '+textColor+' fa-motorcycle"></i></td><td>'+totalpedidos[i].Total+'</td></tr>';
                        }

                    }

                    $("#list_terminados").html(terminados);
                    $("#list_pedientes").html(pendientes);

                }
            }

            dataMeses = response.data.totalMeses;
            console.log(dataMeses);
            $(".currency").numeric();

            var chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 15,
                        beta: 15,
                        depth: 50,
                        viewDistance: 25
                    }
                },
                title: {
                    text: 'Grafica de Ventas '
                },
                subtitle: {
                    text: 'Ventas por mes'
                },
                plotOptions: {
                    column: {
                        depth: 25
                    }
                },
                xAxis: {
                    categories: Highcharts.getOptions().lang.shortMonths
                },
                yAxis: {
                    title: {
                        text: 'Total de ventas'
                    }
                },
                series: [{
                    name:"Total",
                    data: [
                        parseFloat(dataMeses.Ene),parseFloat(dataMeses.Feb),parseFloat(dataMeses.Mar),
                        parseFloat(dataMeses.Abr),parseFloat(dataMeses.May),parseFloat(dataMeses.Jun),
                        parseFloat(dataMeses.Jul),parseFloat(dataMeses.Ago),parseFloat(dataMeses.Sep),
                        parseFloat(dataMeses.Oct),parseFloat(dataMeses.Nov),parseFloat(dataMeses.Dic)
                    ]
                }]
            });

        }else{
            MyAlert(response.message);
        }
        fnloadSpinner(2);
    }).fail(function (jqXHR,textStatus,errno) {
        getthowError(jqXHR,textStatus);
        fnloadSpinner(2);
    });
}