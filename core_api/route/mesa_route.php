<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 04/04/2018
 * Time: 06:27 PM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\MesaValidation,
    App\Middleware\AuthMiddleware;

/**
 * Request para listar las mesas
 */

$app->post('/getMesas/{limit}/{pagina}',function($request, $response, $args){

    if(!is_numeric($args['limit']) || !is_numeric($args['pagina'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El limite y la pagina deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->mesa->listar($args['limit'],$args['pagina']))
        );

})->add(new AuthMiddleware($app));

/**
 * Request para ver la mesa solicitada
 */

$app->post('/getMesa/{id}',function($request, $response, $args){

    if(!is_numeric($args['id']) ){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El id deben ser numerico'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->mesa->obtener($args['id']))
        );

})->add(new AuthMiddleware($app));

/**
 * Registrar una Mesa
 */

$app->post('/getRegistrarMesa',function($request,$response,$args){

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

    $r = MesaValidation::validate($request->getParsedBody());

    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }


    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->mesa->registrar($request->getParsedBody(),$idusuario_alta )));


})->add(new AuthMiddleware($app));

/**
 * Metoto para Actualizar la Mesa
 */
$app->post('/getActualizarMesa',function($request,$response,$args){

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

    $r = MesaValidation::validate($request->getParsedBody(),true);
    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->mesa->actualizar($request->getParsedBody(),$idusuario_alta)));


})->add(new AuthMiddleware($app));


/**
 * Desactivar la Mesa
 */
$app->post('/getDesactivarMesa/{id}',function($request,$response,$args){

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
        ->write(json_encode($this->model->mesa->desactivar($id,$idusuario_alta)));

})->add(new AuthMiddleware($app));



