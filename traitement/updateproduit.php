<?php
include('../model/function.php');
if (isset($_GET['update'])) {
$update=$_GET['update'];
}
?>

<section id= "update-produit">
    <form action="" method="post" enctype="multipart/form-data">
        <select name="categorie" id="selectcat" required>
            <option value="">--Choisir la catégorie--</option>    
                <?php

            echo "<option value='$update[ID]'>$data[nom_categorie]</option>";
            
            ?>
            </select>
            <input class="input" name="produit" id="produit" type="text" placeholder="Nom du produit" required/>
            <input class="input" name="prix" id="prix" type="text" placeholder="Prix produit" required/>
            <input name="userfile" type="file"/>
            <input  type="submit" name="submit" value="Sauvegarder" required />

        </form>
