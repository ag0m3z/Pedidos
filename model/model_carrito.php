<?php
/**
 * Created by PhpStorm.
 * User: USUARIO
 * Date: 29/06/2018
 * Time: 09:03 PM
 */
namespace models;

class model_carrito
{

    protected $cart_contents = array();
    private $total = 0;

    public function __construct()
    {
        $this->total = $_SESSION['cart']['total_item'];
    }

    public function getTotalItem(){
        return $this->total;
    }

    public function getTotal(){

        return $_SESSION['cart']['total'];

    }

    public function addCart($item = array() ){

        $this->total++;
        $_SESSION['cart']['total_item'] = $this->total;

        $item['subtotal'] = ($item['precio'] * $item['cantidad']);
        $item['uid'] =  md5(($_SERVER['REQUEST_TIME_FLOAT']+$this->total) * ($item['subtotal'] * $item['id']));

        $_SESSION['cart']['content'][] = $item;

        $_SESSION['cart']['total'] += (float)$item['subtotal'];

    }

    public function setSave(){

        if(count($_SESSION['cart']['content'])>0){

            $cart = $_SESSION['cart']['content'];

            $_SESSION['cart']['total_item'] = 0;
            $_SESSION['cart']['total'] = 0;

            for($i=0;$i <= count($cart);$i++){

                $_SESSION['cart']['total_item']++;

                $_SESSION['cart']['total'] += (float)$cart[$i]['subtotal'];

            }


        }else{
            unset($_SESSION['cart']['content']);
        }
    }

    public function getItem($id){

    }

    public function getPrint(){
        return $_SESSION['cart']['content'];
    }

    public function setDelete($id){

        for($i=0;$i<= count($_SESSION['cart']['content']);$i++){

            if($id == $_SESSION['cart']['content'][$i]['uid']){

                array_splice($_SESSION['cart']['content'],$i,1);
                //unset([$i]);
            }

        }

        $this->setSave();

    }

    public function setUpdate($uid,$data = array()){


        $this->setSave();
    }

    public function setDestroy(){
        unset($_SESSION['cart']);
    }
}