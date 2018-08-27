<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 13/06/2018
 * Time: 10:07 PM
 */

namespace core;

// Desactivar toda notificación de error
error_reporting(0);
date_default_timezone_set('America/Monterrey');

header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

class core
{
    public $INFO = "#00C0EF"; //Color CYAN
    public $PRIMARY = "#3C8DBC"; //Color PRIAMRY
    public $SUCCESS = "#00A65A"; //Color SUCCESS
    public $WARNING = "#F39C12"; //Color WARNING
    public $DANGER = "#DD4B39"; //Color DANGER

    public static $_nombreApp = "SIPV";
    public static $_versionApp = "18.0110.1";
    //static public  $SkinTheme = 'skin-blue-light';
    public static $SkinTheme = 'skin-siac';

    public static $JSON_NUMERIC_CHECK = false;

    public static function getFormatFolio($Folio = null,$Cantidad = 4,$String = "0"){
        $newNum = str_pad($Folio, $Cantidad,$String, STR_PAD_LEFT);
        return  $newNum;
    }

    public static function HeaderContetType($Type = "JSON"){

        $Type = strtolower($Type);

        echo header("Content-Type:application/".$Type."; charset=utf-8");

    }

    public static function JsonResult($Mensaje='Metodo no soportado',$response = false, $data = []){

        if(core::$JSON_NUMERIC_CHECK){
            echo json_encode(array("result"=>$response,"message"=>$Mensaje,"data"=>$data ),JSON_NUMERIC_CHECK);
            exit();
        }else{
            echo json_encode(array("result"=>$response,"message"=>$Mensaje,"data"=>$data ));
            exit();
        }

    }

    public static function  THEME_APP($THEME_APP){

        if($THEME_APP == NULL && $THEME_APP == ""){
            $THEME_APP = self::$SkinTheme;
        }

        return $THEME_APP;
    }

    public static function getCleanExport(){
        unset($_SESSION['EXPORT']);
    }

    public static function ROOT_APP(){
        $ruta = '/Siac/' ;
        return $ruta;
    }

    public static function APP_NAME($NombreApp = NULL){

        if($NombreApp == null){$NombreApp = self::$_nombreApp;}
        return $NombreApp." | ".self::$_versionApp;
    }

    public static function APP_VERSION($VersionApp = null){
        if($VersionApp == null){$VersionApp = self::$_versionApp;}
        return $VersionApp;
    }

    public static function getTitle(){

        print "<title>".self::APP_NAME()."</title>";

    }

    public static function setTitle($title = null){

        print "<script>
                    $('title').text('".self::APP_NAME($title)."');
                </script>";

    }

    public static function includeCSS($dir_path,$all_folder = false){
        if($all_folder){
            // Recorrer todas las hojas de estilo y agregarlas
            $path = $dir_path;
            $handle=opendir($path);
            if($handle){
                while (false !== ($entry = readdir($handle)))  {
                    if($entry!="." && $entry!=".."){
                        $fullpath = $path.$entry;
                        if(!is_dir($fullpath)){
                            echo "<link rel='stylesheet' type='text/css' href='".$fullpath."' />";

                        }
                    }
                }
                closedir($handle);
            }
        }else{
            // Adjuntar solo la Hoja de Estilo solicitada
            echo "<link rel='stylesheet' type='text/css' href='".$dir_path."' />";
        }
    }

    public static function includeJS($dir_path,$all_folder = false){
        if($all_folder){
            // Agregar todos los js y agregarlos
            $path = $dir_path;
            $handle=opendir($path);
            if($handle){
                while (false !== ($entry = readdir($handle)))  {
                    if($entry!="." && $entry!=".."){
                        $fullpath = $path.$entry;
                        if(!is_dir($fullpath)){

                            echo "<script type='text/javascript' src='".$fullpath."'></script>";

                        }
                    }
                }
                closedir($handle);
            }
        }else{
            // Agregar solo el js Solicitado
            echo "<script type='text/javascript' src='".$dir_path."'></script>";
        }
    }

    public static function mostrarFecha($size){

        $dia=date("N");
        if ($dia=="1") $dia="Lunes";
        if ($dia=="2") $dia="Martes";
        if ($dia=="3") $dia="Mi&eacute;rcoles";
        if ($dia=="4") $dia="Jueves";
        if ($dia=="5") $dia="Viernes";
        if ($dia=="6") $dia="S&aacute;bado";
        if ($dia=="7") $dia="Domingo";
        $mes=date("F");

        if ($mes=="January") $mes="Enero";
        if ($mes=="February") $mes="Febrero";
        if ($mes=="March") $mes="Marzo";
        if ($mes=="April") $mes="Abril";
        if ($mes=="May") $mes="Mayo";
        if ($mes=="June") $mes="Junio";
        if ($mes=="July") $mes="Julio";
        if ($mes=="August") $mes="Agosto";
        if ($mes=="September") $mes="Setiembre";
        if ($mes=="October") $mes="Octubre";
        if ($mes=="November") $mes="Noviembre";
        if ($mes=="December") $mes="Diciembre";
        $dia2=date("d");
        $ano=date("Y");

        return "$dia, $dia2 de $mes del $ano";


    }

    public static function MyAlert($message,$type){

        echo "<script> MyAlert('".$message."','".$type."'); </script>" ;

    }

    public static function getFormatoMoneda($numero, $cent = true){
        $final='';
        $moneda = 'pesos';
        $longitud = strlen($numero);
        $punto = substr($numero, -1,1);
        $punto2 = substr($numero, 0,1);
        $separador = ".";
        if($punto == "."){
            $numero = substr($numero, 0,$longitud-1);
            $longitud = strlen($numero);
        }
        if($punto2 == "."){
            $numero = "0".$numero;
            $longitud = strlen($numero);
        }
        $num_entero = strpos ($numero, $separador);
        $centavos = substr ($numero, ($num_entero));
        $l_cent = strlen($centavos);
        if($l_cent == 2){$centavos = $centavos."0";}
        elseif($l_cent == 3){$centavos = $centavos;}
        elseif($l_cent > 3){$centavos = substr($centavos, 0,3);}
        $entero = substr($numero, -$longitud,$longitud-$l_cent);
        if(!$num_entero){
            $num_entero = $longitud;
            $centavos = ".00";
            $entero = substr($numero, -$longitud,$longitud);
        }

        $start = floor($num_entero/3);
        $res = $num_entero-($start*3);
        if($res == 0){$coma = $start-1; $init = 0;}else{$coma = $start; $init = 3-$res;}
        $d= $init; $i = 0; $c = $coma;
        while($i <= $num_entero){
            if($d == 3 && $c > 0){$d = 0; $sep = ","; $c = $c-1;}else{$sep = "";}
            $final .=  $sep.$entero[$i];
            $i = $i+1; // todos los digitos
            $d = $d+1; // poner las comas
        }

        if(!$cent){$centavos = '';}

        if($moneda == "pesos")  {
            $moneda = "$";
            return $moneda." ".$final.$centavos;
        }
        elseif($moneda == "dolares"){$moneda = "USD";
            return $moneda." ".$final.$centavos;
        }
        elseif($moneda == "euros")  {$moneda = "EUR";
            return $final.$centavos." ".$moneda;
        }
    }
}