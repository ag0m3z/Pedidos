<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/03/2018
 * Time: 02:10 AM
 */

use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsuarioValidation,
    App\Middleware\AuthMiddleware;

/**
 * Request para listar los usuarios
 * @limit //limite de los usuarios a llamar
 * @pagina //paginas de usuarios a mostrar
 */
$app->post('/getUsuarios/{limit}/{pagina}',function($request,$response,$args){

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->usuario->listar($args['limit'],$args['pagina']))
        );

})->add(new AuthMiddleware($app));

/**
 * Listar el usuario Solicitado
 */
$app->post('/getUsuario/{id}',function($request,$response,$args){

    return $response->withHeader('Content-Type','application/json')
        ->write(
            json_encode($this->model->usuario->obtener($args['id']))
        );
})->add(new AuthMiddleware($app));

/**
 * Metodo para registrar los usuarios
 */
$app->post('/getRegistrarUsuario',function ($request,$response,$args){

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

    $idusuario_alta = $keyToken->idusuario; //Usuario Registra

    $r = UsuarioValidation::validate($request->getParsedBody());

    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }


  return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->usuario->registrar($request->getParsedBody(),$idusuario_alta )));

})->add(new AuthMiddleware($app));

/**
 * Metoto para Actualizar los empleados
 * @idusuario
 * @idempleado
 * @nickname
 * @usuario
 * @password
 */
$app->post('/getActualizarUsuario',function($request,$response,$args){

    $r = UsuarioValidation::validate($request->getParsedBody(),true);
    if(!$r->result){
        return $response->withHeader('Content-Type','application/json')
            ->withStatus(422)
            ->write(json_encode($r));
    }

    return $response->withHeader('Content-Type','application/json')
        ->write(json_encode($this->model->usuario->actualizar($request->getParsedBody())));


})->add(new AuthMiddleware($app));

//Desactivar el usuario solicitado
$app->post('/getDesactivarUsuario/{id}',function($request,$response,$args){

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
        ->write(json_encode($this->model->usuario->desactivar($id,$idusuario_alta)));

})->add(new AuthMiddleware($app));

