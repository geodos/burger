<?php
include('./function.php');


if (isset($_SESSION['user'])&& $_SESSION['user']['role']==2 ) {
    if(isset($_POST['categorie'])){
    
        $exist=false;
        // on fait un select sur l'ensemble des marques de la table marque que l'on met dans un tableau
        $selectStr= 'SELECT * FROM categorie';
        $selectQuery =$bdd->query($selectStr);
        $donnee = $selectQuery->fetchAll();
    
    
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
    
if (isset($_POST['categorie'])) {
addcat ($bdd,$_POST['categorie']);
}

?>