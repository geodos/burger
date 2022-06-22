
<?php
include('../model/backoffice/function.php');
include('../model/function.php');

$produits= selProduitplusImages($bdd);
    


/*
if ($_GET['page']=='panier'){
    $_SESSION['panier']=array();
    $_SESSION['panier']['ID_produit']=array();
    $_SESSION['panier']['quantité']=array();
   
    $IDuser = hexdec(uniqid());
    createPanier($bdd,$IDuser);
}
*/

?>

<body>
<main>

<div class="burgers">
    <div class="burgersrow">
        <div class="burgerswrap">
            <?php foreach($produits as $produit){if ($produit['ID_categorie']== '1'){ ?>
                <div class="box">
                    <div class="product full">
                        <a href="#">
                        <img src="
                        <?php echo $produit['nom_image'];?>" alt="">
                        </a>
                        <div class="description">
                        <?= $produit['nom_produit'];?>
                        </div>
                        <a href="" class="price"><?= number_format($produit['prix_produit'],2,',',' ');?></a>
                        <a href="index.php?page=ajoutpanier&id=<?= $produit['produit_id'];?>" class="add">ajouter</a>
                    </div>
                </div>
                <?php
                    }}
                ?>
                
        </div>
    </div>
</div>


<div class="boissons">
    <div class="boissonsrow">
        <div class="boissonswrap">
            <?php foreach($produits as $produit){if ($produit['ID_categorie']== '3'){ ?>
                <div class="box">
                    <div class="product full">
                        <a href="#">
                        <img src="
                        <?php echo $produit['nom_image'];?>" alt="">
                        </a>
                        <div class="description">
                        <?php echo $produit['nom_produit'];?>
                        </div>
                        <a href="" class="price"><?php echo number_format($produit['prix_produit'],2,',',' ');?></a>
                        <a href="index.php?page=ajoutpanier&id=<?php echo $produit['produit_id'];?>" class="add">ajouter</a>
                    </div>
                    <?php
                        }}
                    ?>
                </div>
                
        </div>
    </div>
</div>

  
<!--
<section id="burgers">
    
    <div id = "commande-burgers">
        <div id ="hamburger">
            <img src="../public/assets/images/17983979905507956-s.jpg" alt="">
            <figcaption>Le Hamburger </figcaption>
            <form action="" method="POST" class="produit"> 
            <input type="button" name="Hamburger" value="Ajouter au panier" class="ajout-panier">
            </form>
        </div>
    
        <div id ="original">  
            <img src="../public/assets/images/les-burgers-de-papa_burger-du-moment-Votez-Papa.png" alt="">
            <figcaption>L'Original</figcaption>
                </div>

                <div id = "bacon">      
            <img src="../public/assets/images/les-burgers-de-papa_le-cre-meuuh-nouveau-burger-du-moment-saint-marcellin.png" alt="">
            <figcaption> Le Bacon </figcaption>
        </div>
    </div>
-->
    


</section>

</main> 
</body>
</html>