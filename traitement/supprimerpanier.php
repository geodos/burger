<?php


if (isset($_GET['remove'])) {
    $remove=$_GET['remove'];
    $array=$_SESSION['panier']->panier;
    $cle=array_search($remove,$array);

    $_SESSION['panier']->del($remove);

     if (empty($array)) {
         echo "Votre panier est vide";
     }
   //foreach($array as $key =>$value){
    // if($value == $remove){
           // $_SESSION['panier']->del($remove); 
            //unset($array[$key]);
            
            header('Location: index.php?page=vuepanier');  
           

        }
        /*
       if ($value == $remove) {
       
        unset ();
        var_dump($_SESSION['panier']);
        */
   
    

  


//$ids = array_keys($_SESSION['panier']);
/*
if (empty($ids)){
    $products=array();
} else {
    $products = 'SELECT * FROM produits WHERE ID IN ('.implode(',',$ids).')';
}
*/


?>


