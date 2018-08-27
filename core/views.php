<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:07 PM
 */

namespace core;


class views
{

    private $_view ;
    private $_nameView ;
    private $_ruta = '';


    public function call_view($data_view = array()){

        $this->_view = $data_view[0] ;
        $this->_nameView = $data_view[1].".php" ;
        $this->_ruta = "views/$this->_view/$this->_nameView";

        if(views::isValid()){

            views::load();
        }

    }

    public function load(){

        include $this->_ruta;

    }

    public function isValid(){

        $valid=false;


        if(file_exists($file =  $this->_ruta)){
            $valid = true;
        }else{
            views::Error("Error la vista solicitada no existe: ".$this->_ruta);
        }

        return $valid;

    }

    public function Error($message){
        print  $message ;
    }

}