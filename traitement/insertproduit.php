
<?php
include('../model/function.php');

/* on appelle la fonction qui va nous retourner tous les produits existants et on les insère dans un tableau HTML*/
if (isset($_SESSION['user']) && $_SESSION['user']['ID_role']==2) {

    echo '<table>
                <tr>   
                <th>Categorie</th>
                <th>Nom du produit</th>
                <th>Prix produit</th>
                </tr>';
    
    $donnee = selProduitsJoinCat($bdd);  
    
    foreach ($donnee as $data) {
        echo "<tr>
        <td>$data[nom_categorie]</td>
        <td>$data[nom_produit]</td>
        <td>$data[prix_produit]</td>
        
        <td><a href=index.php?page=updateproduit&update=$data[ID]'>Modifier</a></td> 
        </tr>";
    }
    echo'</table>';
}
?>

<!-- Formlaire pour encoder un produit  -->
<section id= "renseigner">
    <form action="" method="post" enctype="multipart/form-data">
        <select name="categorie" id="selectcat" required>
            <option value="">--Choisir la catégorie--</option>    
            
            <?php



            //on appelle la fonction qui selectionne la liste des categories afin de les afficher dans un menu deroulant(balise selectHTML)
            $donnee1= selCategories($bdd);
            foreach ($donnee1 as $data) {
            echo "<option value='$data[ID]'>$data[nom_categorie]</option>";
            }
            ?>
            </select>
            <input class="input" name="produit" id="produit" type="text" placeholder="Nom du produit" required/>
            <input class="input" name="prix" id="prix" type="text" placeholder="Prix produit" required/>
            <input name="userfile" type="file"/>
            <input  type="submit" name="submit" value="Sauvegarder" required />

        </form>


<?php

if (isset($_SESSION['user'])&& $_SESSION['user']['ID_role']==2 ) {
        if(isset($_POST['produit'])){
            $produit=$_POST['produit'];
                $categorie=$_POST['categorie'];
                $prix=$_POST['prix'];
                $picture=$_FILES['userfile'];

                $exist= false;
                $targetDir = "assets/images/userImg/"; 
                $targetFile= $targetDir.basename($_FILES['userfile']['name']);
                $donnee2= selProduits($bdd);
            
            
                //on compare les produits aue nous avons en DB avec celui que l'utilisateur encode 
                foreach ($donnee2 as $data){
                    // si il y a un produit exactement identique on envoie un message à l'utilisateur 
                    if ($data['ID_categorie']==$categorie && $data['nom_produit']==$produit) {
                        $exist = true;
                        echo 'produit deja existant';
                    }
                }
            
                if($exist==false) {
                    // si les données ne correspondent pas avec un produit existant en BDD, alors on insère en BDD ce nouveau produit avec la fonction INSERT INTO, et on informe l'utilisateur avec un message à l'écran 
                    insertproduit($bdd,$produit,$prix,$categorie);
                      
                    if(file_exists($targetFile)) {
                        
                    echo "Désolé, le fichier existe déjà";
                        } else if (move_uploaded_file($_FILES["userfile"]["tmp_name"],$targetFile)) {
                        $donnee3 = selLastProd($bdd);
                        insertImage($bdd,$targetFile,$donnee3[0]);
                        
                        echo "le fichier ".htmlspecialchars(basename($_FILES["userfile"]["name"]))."a été ajouté";
                        } else {
                        echo "Désolé le chargement n'a pas fonctionné";
                        }
                }
            }
        } else {header('Location: index.php');
        }
        
            ?>
        </section>
