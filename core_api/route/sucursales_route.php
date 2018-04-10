<?php
/**
 * Created by PhpStorm.
 * User: alejandro.gomez
 * Date: 04/04/2018
 * Time: 06:27 PM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\SucursalValidation,
    App\Middleware\AuthMiddleware;

/**
 * Request para listar las sucursales
 * @limit //limite a llamar
 * @pagina //paginas a mostrar
 */
$app->post('/getSucursales/{limit}/{pagina}',function($request,$response,$args){

    if(!is_numeric($args['limit']) || !is_numeric($args['pagina'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El limite y la pagina deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->sucursal->listar($args['limit'],$args['pagina']))
        );

})->add(new AuthMiddleware($app));

/**
 * Listar la sucursal Solicitado
 */
$app->post('/getSucursal/{id}',function($request,$response,$args){

    if(!is_numeric($args['id'])){
        return $response->withHeader('Content-Type','application/json')
            ->write(
                json_encode(array('result'=>false,'message'=>'El id de la sucursal deben ser numericos'))
            );
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->usuario->obtener($args['id']))
        );
})->add(new AuthMiddleware($app));


/**
 * Metodo para registrar la sucursal
 */
$app->post('/getRegistrarSucursal',function ($request,$response,$args){

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

    $r = SucursalValidation::validate($request->getParsedBody());

    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }


    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->sucursal->registrar($request->getParsedBody(),$idusuario_alta )));

})->add(new AuthMiddleware($app));

/**
 * Metoto para Actualizar la sucursal
 */
$app->post('/getActualizarSucursal',function($request,$response,$args){

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

    $r = SucursalValidation::validate($request->getParsedBody(),true);
    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->sucursal->actualizar($request->getParsedBody(),$idusuario_alta)));


})->add(new AuthMiddleware($app));

//Desactivar la sucursal solicitada
$app->post('/getDesactivarSucursal/{id}',function($request,$response,$args){

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
        ->write(json_encode($this->model->sucursal->desactivar($id,$idusuario_alta)));

})->add(new AuthMiddleware($app));

