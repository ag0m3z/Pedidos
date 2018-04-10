<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 04/04/2018
 * Time: 06:27 PM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\EmpresaValidation,
    App\Middleware\AuthMiddleware;

/**
 * Request para listar los Clientes
 */
$app->post('/getEmpresas/{limit}/{pagina}',function($request,$response,$args){

    if(!is_numeric($args['limit']) || !is_numeric($args['pagina'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El limite y la pagina deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->empresa->listar($args['limit'],$args['pagina']))
        );

})->add(new AuthMiddleware($app));

/**
 * Listar la Empresa Solicitada
 */
$app->post('/getEmpresa/{id}',function($request,$response,$args){

    if(!is_numeric($args['id'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El id del cliente deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->empresa->obtener($args['id']))
        );
})->add(new AuthMiddleware($app));


/**
 * Metodo para registrar la empresa
 */
$app->post('/getRegistrarEmpresa',function ($request,$response,$args){

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

    $r = EmpresaValidation::validate($request->getParsedBody());

    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }


    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->empresa->registrar($request->getParsedBody() )));

})->add(new AuthMiddleware($app));

/**
 * Metoto para Actualizar la empresa
 */
$app->post('/getActualizarEmpresa',function($request,$response,$args){

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

    $r = EmpresaValidation::validate($request->getParsedBody(),true);
    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->empresa->actualizar($request->getParsedBody())));


})->add(new AuthMiddleware($app));

/**
 * Desactivar la empresa
 */
$app->post('/getDesactivarEmpresa/{id}',function($request,$response,$args){

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
        ->write(json_encode(array('result'=>false,'message'=>'metodo no configurado')));

})->add(new AuthMiddleware($app));

