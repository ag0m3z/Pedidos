<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 28/03/2018
 * Time: 11:32 PM
 */

namespace App\Lib;

class Response
{
    public $result     = false;
    public $message    = 'Ocurrio un error inesperado.';
    public $data     = [];

    public function SetResponse($result, $m = '')
    {
        $this->result = $result;
        $this->message = $m;

        if(!$result && $m = '') $this->result = 'Ocurrio un error inesperado';

        return $this;
    }
}