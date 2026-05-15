<?php
class Cart {

    // add item
    public function add($id){
        if(!isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] = 1;
        } else {
            $_SESSION['cart'][$id]++;
        }
    }

    // update quantity
    public function update($id, $qty){
        if($qty > 0){
            $_SESSION['cart'][$id] = $qty;
        }
    }

    // remove item
    public function remove($id){
        unset($_SESSION['cart'][$id]);
    }

    // get cart
    public function get(){
        return $_SESSION['cart'] ?? [];
    }
}
?>