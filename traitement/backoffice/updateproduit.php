<?php
include('../model/backoffice/function.php');

if (isset($_GET['update'])) {
$update=$_GET['update'];
// on selectionne les données du produit que l'on souhaite modifier
$donnee = getProduitById($bdd,$update);


// on selectionne TOUS les produits de la BD
$allproduits= selProduits($bdd);

// on selectionne TOUTE la liste des catégories
$categories= selCategories($bdd);
}


if (isset($_POST['produit'])){
    
    $produit=$_POST['produit'];
    $prix=$_POST['prix'];
    $categorie=$_POST['categorie'];
   
    // on selectionne l'entièreté des produits

    $exist=false;

    foreach($allproduits as $data){    
        if ($data['nom_produit'] == $produit && $data['prix_produit']==$prix && $data['ID_categorie']==$_POST['categorie'] ) {
        $exist=true;    
        echo '<p class="alert">Produit deja existant</p><br>';
        echo '<a href="index.php">Retour à l\'accueil</a>';
        }
    }
    

        if($exist==false) {
        updateProduit($bdd,$_GET['update'],$_POST['produit'],$_POST['prix'],$_POST['categorie']);
       
        echo '<p class="alert">Modification enregistrée</p><br>';
        echo '<a href="index.php">Retour à l\'accueil</a>';
        }
    }



?>


<section id= "update-produit">
    <?php
    if(isset($donnee[0])){
        echo "<img src='".$donnee[0]['nom_image']."' />";
    }

    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <select name="categorie" id="selectcat" required>
            <option value="">--Choisir la catégorie--</option>    
                <?php
            foreach($categories as $cat) {
                //si ID de la liste categorie et ID du produit qu'on update correspondent on selectionne l'ID en question et on affiche sa valeur par défaut
                if ($donnee['ID_categorie'] == $cat['ID']){
                    echo "<option value='$cat[ID]' selected>$cat[nom_categorie]</option>";
                }
            else {echo "<option value='$cat[ID]'>$cat[nom_categorie] </option>";}
            }
            
            ?>
            </select>
            <input type="number" name="ID" id="ID" value="<?php echo $_GET['update']; ?>" hidden />
            <input class="input" name="produit" id="produit" type="text" placeholder="Nom du produit" value="<?php echo $donnee['nom_produit'] ?>" required/>
            <input class="input" name="prix" id="prix" type="text" placeholder="Prix produit" value="<?php echo $donnee['prix_produit'] ?>" required/>
            <input name="userfile" type="file" value=""/>
            <input  type="submit" name="submit" value="Sauvegarder" required />

        </form>


