/**
 * Created by agomez on 11/01/2018.
 */

$(document).ready(function(){
    $('#login_user').focus();


});

function fn_login(){


    if($.trim($("#login_user").val()) == ""){
        MyAlert("Ingrese el usuario","alert");
    }else if($.trim($("#login_pass").val()) == ""){

        MyAlert("Ingrese su contraseña","alert");

    }else{

        var strData = {usuario:$("#login_user").val(),password:$("#login_pass").val(),web:true};

        $.ajax({
            url:'controller/login/ControllerAuth.php',
            type:"post",
            dataType:"json",
            async:true,
            cache:false,
            beforeSend:function(){
                //script para terminar el loading
                fnloadSpinner(1);
            },
            data:strData
        }).done(function (response) {

            console.log(response);
            fnloadSpinner(2);
            if(response.result){

                localStorage.setItem('key','12345');
                location.reload();

            }else{
                MyAlert(response.message);
            }

        }).fail(function (jqhr,textStatus,errno) {
            fnloadSpinner(2);
            getthowError(jqhr,textStatus);

        });


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
    if (mensaje === undefined) mensaje = " ";

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
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div class='text-white text-bold'  style='margin-top:" + heightdivsito + "px; font-size:20px;'><span class='fa fa-2x fa-spinner fa-spin '></span><br><span style='font-size: 10px;font-weight: normal'>espere un momento</span></div></div>";

    //creamos el div que bloquea grande------------------------------------------
    div = document.createElement("div");
    div.id = "WindowLoad";
    div.style.width = ancho + "px";
    div.style.height = alto + "px";
    $("body").append(div);

    //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
    input = document.createElement("input");
    input.id = "focusInput";
    input.type = "text"

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

        console.log(textStatus);
        console.log(jqXHR);

        MyAlert('Requested JSON parse failed.','danger');

    } else if (textStatus === 'timeout') {

        MyAlert('Time out error.','danger');

    } else if (textStatus === 'abort') {

        MyAlert('Ajax request aborted.','danger');

    } else {

        MyAlert('Uncaught Error: ' + jqXHR.responseText,'danger');

    }

};
