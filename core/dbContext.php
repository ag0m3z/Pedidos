<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:19 PM
 */

namespace core;


abstract class dbContext
{
    private $conexion ;

    private $dataSource = array(
        "diver"=>"Oracle Mysql Server",
        "bdHost"=>"localhost",
        "bdUser"=>"root",
        "bdPass"=>"",
        "bdData"=>"pedidos",
        "port"=>"3306"
    );

    /*private $dataSource = array(
        "diver"=>"Oracle Mysql Server",
        "bdHost"=>"localhost",
        "bdUser"=>"hockmaco_pedidos",
        "bdPass"=>"Masterkey.88",
        "bdData"=>"hockmaco_pedidos",
        "port"=>"3306"
    );*/


    /*private $dataSource = array(
          "diver"=>"Oracle Mysql Server",
          "bdHost"=>"192.168.2.55",
          "bdUser"=>"pexpress",
          "bdPass"=>"M@st3rkey",
          "bdData"=>"SINTEGRALGNL",
          "port"=>"3306"
      );*/

    /*private $dataSource = array(
        "diver"=>"Oracle Mysql Server",
        "bdHost"=>"localhost",
        "bdUser"=>"root",
        "bdPass"=>"",
        "bdData"=>"SINTEGRALGNL",
        "port"=>"3306"
    );*/


    // atributos publicos
    public $_query ;
    public $_rows = array();
    public $_confirm = false ;
    public $_message = '';

    public function __construct($data_base = null,$data_server = array('bdHost'=>'','bdUser'=>'','bdPass'=>'','bdData'=>'','port'=>''))
    {

        $this->conexion = new \mysqli(
            $this->dataSource['bdHost'],
            $this->dataSource['bdUser'],
            $this->dataSource['bdPass'],
            $this->dataSource['bdData'],
            $this->dataSource['port']
        ) ;

        if ($this->conexion->connect_errno) {

            $this->_message = "Connect failed: ". $this->conexion->connect_error ;
            $this->_confirm = false;
            core::JsonResult($this->_message);
            exit();


        }else{
            $this->conexion->query("SET NAMES 'utf8'");
            //$this->conexion->query("SET NAMES 'utf8'");
            $this->_confirm = true;
            $this->_message = "conexion exitosa";
        }


    }

    //funciones para sanatizar las consultas
    private function clean_input($input) {

        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
            '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-l�nea
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    public function get_sanatiza($input) {

        if (is_array($input)) {
            foreach($input as $var=>$val) {
                $output[$var] = $this->get_sanatiza($val);
            }
        }
        else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input  = $this->clean_input($input);
            $output =   $this->conexion->real_escape_string($input);
        }
        return $output;
    }

    public function get_escape_mysql($data){

        return $this->conexion->real_escape_string($data);

    }

    // funcion para ejecutar solomante el query sin guardar el resultado
    public function execute_query(){


        if (!$this->conexion->query($this->_query)) {

            $this->_message = "Mesaje de error: " . $this->conexion->errno. " " . $this->conexion->error ;
            $this->_confirm = false;

        }else{
            $this->_confirm = true;
            $this->_message = 'Consulta exitosa';
        }


    }

    public function last_id(){
        return $this->conexion->insert_id;
    }

    public function get_result_multi_query(){

        unset($this->_rows);

        if (!$this->conexion->multi_query($this->_query)) {
            $this->_message = "Mesaje de error: " . $this->conexion->errno. " " . $this->conexion->error ;
            $this->_confirm = false;
        }

        do {
            if ($resultado = $this->conexion->store_result()) {
                $this->_rows[] = $resultado->fetch_all();
                $resultado->free();

            } else {
                if ($this->conexion->errno) {
                    $this->_message = "Store failed: (" . $this->conexion->errno . ") " . $this->conexion->error;
                    $this->_confirm = false;
                }
            }
        } while ($this->conexion->more_results() && $this->conexion->next_result());
        $this->_confirm = true;
        $this->_message = "Consulta Exitosa";

    }

    public function get_result_query($assoc = false, $json = false){

        unset($this->_rows);

        if(!$result = $this->conexion->query($this->_query)){

            $this->_message = "Mesaje de error: " . $this->conexion->errno. " " . $this->conexion->error ;
            $this->_confirm = false;

        }else{


            if($assoc){
                while($this->_rows[] = $result->fetch_assoc()) ;
            }else{
                while($this->_rows[] = $result->fetch_array()) ;
            }


            $this->conexion->next_result();  //Prepara el siguiente juego de resultados de una llamada
            $result->free_result(); //Libera la memoria asociada al resultado.
            array_pop($this->_rows) ;

            if($json){
                for($i=0;$i < count($this->_rows);$i++){

                    $data[] =$this->_rows[$i];

                }

                $this->_rows = json_encode($data);
            }

            $this->_confirm = true;

        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.

        $this->conexion->close();
    }

}