<?php
require_once "../models/Cart.php";

class CartController {
    private $cart;

    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $this->cart = new Cart();
    }

    // add item
    public function add($id){
        $this->cart->add($id);
    }

    // update quantity
    public function update($id, $qty){
        $this->cart->update($id, $qty);
    }

    // remove item
    public function remove($id){
        $this->cart->remove($id);
    }

    // get cart
    public function get(){
        return $this->cart->get();
    }
}
?>