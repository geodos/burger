<?php
include('../model/function.php');


if (isset($_SESSION['user']) && $_SESSION['user']['ID_role']==2) {

echo '<table>
            <tr>   
            <th>Categories</th>
            </tr>';

$donnee = selCategories($bdd);  
foreach ($donnee as $data) {
    echo "<tr>
    <td>$data[nom_categorie]</td>
    <td><a href='index.php?page=deletecategorie&delete=$data[ID]'>Supprimer</a></td> 
    </tr>";
}
echo'</table>';
}

if (isset($_SESSION['user'])&& $_SESSION['user']['ID_role']==2 ) {
    if(isset($_POST['categorie'])){
    
        $exist=false;
        // on fait un select sur l'ensemble des categories de la table categorie que l'on met dans un tableau
        $donnee = getCategories($bdd);
    
    
        foreach ($donnee as $data) {
            // on vérifique que la catégorie n'existe pas déjà, si c'est le cas on avise 'utilisateur 
            if ($data['categorie']==$_POST['categorie']) {
                $exist = true;
                echo 'catégorie deja existante';
            }
        }
    
        if($exist==false) {
            addcat($bdd,$_POST['categorie']);
    // si la categorien'existe pas en BDD on effectue une insertion 
            
            echo 'categorie ajoutée au catalogue';
        }
    }
    }
    else 
    {header('Location: index.php');}
    ?>
    
    <form action="" method="post">
        <p><input class="input" name="categorie" id="categorie" type="text" placeholder="categorie" required/></p>
	    <p><input  type="submit" name="submit" value="Envoyer" required /></p>
        </form>