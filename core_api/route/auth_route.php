<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 28/03/2018
 * Time: 11:46 PM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Middleware\AuthMiddleware;

$app->post('/getRequestAuth', function ($request, $response, $args) {

    $parametros = $request->getParsedBody();

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->auth->autentificar($parametros['usuario'],$parametros['password']))
        );

});