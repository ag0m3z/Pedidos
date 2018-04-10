<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 04/04/2018
 * Time: 06:27 PM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\PlatilloValidation,
    App\Middleware\AuthMiddleware;

/**
 * Request para listar los platillos
 * @limit //limite a llamar
 * @pagina //paginas a mostrar
 */
$app->post('/getPlatillos/{limit}/{pagina}',function($request,$response,$args){

    if(!is_numeric($args['limit']) || !is_numeric($args['pagina'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El limite y la pagina deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->platillo->listar($args['limit'],$args['pagina']))
        );

})->add(new AuthMiddleware($app));

/**
 * Listar platillo Solicitado
 */
$app->post('/getPlatillo/{id}',function($request,$response,$args){

    if(!is_numeric($args['id'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El id del platillo deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->platillo->obtener($args['id']))
        );
})->add(new AuthMiddleware($app));

/**
 * Metodo para registrar el platillo
 */
$app->post('/getRegistrarPlatillo',function ($request,$response,$args){

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

    $r = PlatilloValidation::validate($request->getParsedBody());

    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(200)
            ->write(json_encode($r));
    }


    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode(
                $this->model->platillo->registrar($request->getParsedBody(),$idusuario_alta)
            )
        );


})->add(new AuthMiddleware($app));

/**
 * Metoto para Actualizar el platillo
 */
$app->post('/getActualizarPlatillo',function($request,$response,$args){

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

    $r = PlatilloValidation::validate($request->getParsedBody(),true);
    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->platillo->actualizar($request->getParsedBody(),$idusuario_alta)));


})->add(new AuthMiddleware($app));

//Desactivar el platillo solicitada
$app->post('/getDesactivarPlatillo/{id}',function($request,$response,$args){

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


    $id = $args['id'];

    if(!is_numeric($id)){

        return $response->withHeader('Content-Type','application/json')
            ->write(json_encode(array('result'=>false,'message'=>'Valor no valido, debe ser numerico ')));

    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->platillo->desactivar($id,$idusuario_alta)));

})->add(new AuthMiddleware($app));

