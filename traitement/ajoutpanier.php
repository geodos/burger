
<?php
include('../model/backoffice/function.php');
include('../model/function.php');

?>

<section>


<?php
if(isset($_GET['id'])){

    if(isset($_SESSION['panier'])){
        $product=selProduitbyID($bdd,$_GET['id']);
        if(empty($product)){
            die("ce produit n'existe pas");
        } else {
        $_SESSION['panier']->add($_GET['id']);
        header('Location: index.php?page=vuepanier');
    }
}

    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = Panier::getInstance();
        $_SESSION['panier']->add($_GET['id']);
        header('Location: index.php?page=vuepanier');
}
} else {
    echo "vous n'avez pas selectionne de produit";
} 
    


    //$produit = selProduitbyID($bdd,$_GET['id']);
    //if(empty($produit)){
      //  echo "ce produit n'existe pas";
    //}
    // $panier-> add($produit['ID']);
    // echo 'le produit a été ajouté au panier <a href="javasript:history:back()" >retour selection</a>';

    


?>

</section>