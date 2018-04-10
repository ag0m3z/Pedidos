<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 27/03/2018
 * Time: 09:11 PM
 */

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>



    var settings2 = {
        "async": true,
        "crossDomain": true,
        "url": "http://localhost/pedidos/api/getRequestAuth",
        "method": "POST",
        "headers": {
            "content-type": "application/x-www-form-urlencoded",
            "cache-control": "no-cache",
            "postman-token": "3637c3c1-32d2-8153-6487-4aa0e81d2ca7"
        },
        "data": {
            "usuario": "agomez",
            "password": "admin"
        }
    };

    $.ajax(settings2).done(function (response) {
        console.log(response);

        if(response.result){

            var isKey = response.data.key;

            localStorage.setItem('token_app',isKey);

            var setplatillo = {
                "async": true,
                "crossDomain": true,
                "url": "http://localhost/pedidos/api/getRegistrarPlatillo",
                "method": "POST",
                "headers": {
                    "key": isKey,
                    "cache-control": "no-cache",
                    "postman-token": "bb82df1b-a27f-e933-29c2-78847c7f4666",
                    "content-type": "application/x-www-form-urlencoded"
                },
                "data": {
                    "idempresa": "1",
                    "nombre": "Tacos de Carne Asada"
                }
            };

            $.ajax(setplatillo).done(function (response2) {
                console.log(response2);
            });
        }
    });


</script>

