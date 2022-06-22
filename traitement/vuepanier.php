
    
<?php
include('../model/backoffice/function.php');
include('../model/function.php');

?>

<section>
<h1>VOTRE PANIER</h1>

    <?php
var_dump($_SESSION['panier']->panier);

if (isset($_SESSION['panier']) && !empty($_SESSION['panier']->panier)){

    foreach($_SESSION['panier']->panier as $key => $produitId){
        $produit = selProduitbyID($bdd, $produitId['id']);
        echo    '<div class="box">
                        <div class="product">           
                            <img src="'.$produit['nom_image'].'" alt="">
                            <div class="description">
                            <p>'.$produit['nom_produit'].'</p>
                            <p class="price">'.number_format($produit['prix_produit'],2,',',' ').' EUR</p>
                            <a href=index.php?page=supprimerpanier&remove='.$key.'>Supprimer</a>
                            </div>
                        </div>
                </div>';
    }
} else {
    echo 'Votre panier est vide';
}


?>
</section>
<div>
    <input type="text" name="validerpanier" value="JE COMMANDE" >
</div>