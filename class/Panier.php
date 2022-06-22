<?php
class Panier{

    public $panier = [];
    private static $instance = null;

    function __construct(){
    }

    function add($product_id) {
        $product = [];
        $productExist = false;
        for($i=0; $i <= sizeof($this->panier); $i++){
            if($this->panier[$i]['id'] == $product_id){
                $this->panier[$i]['qte'] += 1;
                $productExist = true;
                break;
            }
        }

        if($productExist == false){
            $product['id'] = $product_id;
            $product['qte'] = 1;
            array_push($this->panier, $product);
            unset($product);
        }
    }

    function del($product_id) {
        if($this->panier[$product_id]['qte'] > 1){
            $this->panier[$product_id]['qte'] -= 1;
        }else{
            unset($this->panier[$product_id]);
        }
    }

    
    /*
    function del($product_id) {
        foreach($this as $key => $value){
            if ($value == $product_id){
            unset($this->panier[$key]);
        }
        }
       
    } 
    */
 

    static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new Panier();
        }
        return self::$instance;
    }
}
?>