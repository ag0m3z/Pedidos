<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 28/03/2018
 * Time: 11:42 PM
 */

namespace App\Middleware;

use Exception,
    App\Lib\Auth;

class AuthMiddleware
{
    private $app = null;

    public function __construct($app){
        $this->app = $app;
    }

    public function __invoke($request, $response, $next){

        $c = $this->app->getContainer();
        $app_token_name = $c->settings['app_token_name'];

        $token = $request->getHeader($app_token_name);

        if(isset($token[0])) $token = $token[0];

        try {
            Auth::Check($token);
        } catch(Exception $e) {

            return $response->withHeader('Content-Type','application/json')
                ->withStatus(401)
                ->write(
                    json_encode(array('result'=>false,'message'=>'No autorizado','data'=>['error'=>$e->getMessage(),'token'=>$token]))
                );
        }

        return $next($request, $response);
    }
}