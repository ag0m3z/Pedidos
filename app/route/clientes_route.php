<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 04/04/2018
 * Time: 06:27 PM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\ClienteValidation,
    App\Middleware\AuthMiddleware;

/**
 * Request para listar los Clientes
 */
$app->post('/getClientes/{limit}/{pagina}',function($request,$response,$args){

    if(!is_numeric($args['limit']) || !is_numeric($args['pagina'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El limite y la pagina deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->cliente->listar($args['limit'],$args['pagina']))
        );

})->add(new AuthMiddleware($app));

/**
 * Listar el cliente Solicitado
 */
$app->post('/getCliente/{id}',function($request,$response,$args){

    if(!is_numeric($args['id'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El id del cliente deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->cliente->obtener($args['id']))
        );
})->add(new AuthMiddleware($app));


/**
 * Metodo para registrar el cliente
 */
$app->post('/getRegistrarCliente',function ($request,$response,$args){

    try{
        $dataToken = $request->getHeaderLine('key');

        Auth::Check($dataToken);

        $keyToken = Auth::GetData($dataToken);

    }catch (Exception $e){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode( array('result'=>false,'message'=>$e->getMessage()) )
            );
    }

    if(isset($keyToken->idusuario)){
        $idusuario_alta = $keyToken->idusuario; //Usuario Registra
    }else{
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode( array('result'=>false,'message'=>'usuario invalido o sin acceso') )
            );
    }

    $r = ClienteValidation::validate($request->getParsedBody());

    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }


    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->cliente->registrar($request->getParsedBody(),$idusuario_alta )));

})->add(new AuthMiddleware($app));

/**
 * Metoto para Actualizar el cliente
 */
$app->post('/getActualizarCliente',function($request,$response,$args){

    try{
        $dataToken = $request->getHeaderLine('key');

        Auth::Check($dataToken);

        $keyToken = Auth::GetData($dataToken);

    }catch (Exception $e){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode( array('result'=>false,'message'=>$e->getMessage()) )
            );
    }

    if(isset($keyToken->idusuario)){
        $idusuario_alta = $keyToken->idusuario; //Usuario Registra
    }else{
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode( array('result'=>false,'message'=>'cliente invalido o sin acceso') )
            );
    }

    $r = ClienteValidation::validate($request->getParsedBody(),true);
    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->cliente->actualizar($request->getParsedBody(),$idusuario_alta)));


})->add(new AuthMiddleware($app));

/**
 * Desactivar el cliente
 */
$app->post('/getDesactivarCliente/{id}',function($request,$response,$args){

    try{
        $dataToken = $request->getHeaderLine('key');

        Auth::Check($dataToken);

        $keyToken = Auth::GetData($dataToken);

    }catch (Exception $e){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode( array('result'=>false,'message'=>$e->getMessage()) )
            );
    }

    if(isset($keyToken->idusuario)){
        $idusuario_alta = $keyToken->idusuario; //Usuario Registra
    }else{
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode( array('result'=>false,'message'=>'cliente invalido o sin acceso') )
            );
    }


    $id = $args['id'];

    if(!is_numeric($id)){

        return $response->withHeader('Content-Type','application/json')
            ->write(json_encode(array('result'=>false,'message'=>'Valor no valido, debe ser numerico ')));

    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->cliente->desactivar($id,$idusuario_alta)));

})->add(new AuthMiddleware($app));

