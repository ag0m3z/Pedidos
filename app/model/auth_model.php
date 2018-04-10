<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 28/03/2018
 * Time: 11:49 PM
 */

namespace App\Model;
use App\Lib\Auth;
use App\Lib\Response;

class AuthModel
{
    private $db;
    private $table = 'hspusuarios';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }

    public function autentificar($usuario,$password){

        $empleado = $this->db->from($this->table)
            ->where('usuario',$usuario)
            ->where('password',sha1($password))
            ->fetch();

        if(is_object($empleado)){

            $token = Auth::SignIn([
                'idusuario'=>$empleado->idusuario,
                'nombre'=>$empleado->nombre,
                'idestatus'=>$empleado->idestatus
            ]);

            $dataUsuario =
                [
                    'key'=>$token,
                    'idusuario'=>$empleado->idusuario,
                    'nombre'=>$empleado->nombre,
                    'usuario'=>$empleado->usuario,
                    'idestatus'=>$empleado->idestatus
                ];

            $this->response->data = $dataUsuario;
            return $this->response->SetResponse(true,'Usuario autentificado correctamente');

        }else{
            return $this->response->SetResponse(false,'Credenciales no validas');
        }
    }

}