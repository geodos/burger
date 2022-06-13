<?php


include('../model/bdd.php');

/**
 * connexion utilisateur
 *
 * @param PDO $bdd
 * @return void
 */
function connexion($bdd) {
if(isset($_POST['email'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    // avec la commande SELECT on pointe sur la table user la ligne qui contient l'e-mail entré par l'utilisateur
    $selectStr= 'SELECT * FROM user WHERE email_user = :email';
    $selectQuery = $bdd ->prepare($selectStr);
    // on binde le token :mail avec l'email entré par l'utilisateur 
    $selectQuery -> bindValue (':email', $email,PDO::PARAM_STR); 
    $selectQuery->execute();
    // on fait un fetch et non un fetchAll car la query n'est censé retourner qu'un seul résultat 
    $selectUser = $selectQuery->fetch();
    

    if ($selectUser != null ) {
        $hash=$selectUser['mdp_user'];
        // on vérifie que le password renseigné par 'utilisateur et celui crypté en BD correspondent en appelant la fonction password_verify. le résultat est un booléen
        $passwordverify = password_verify($password,$hash);


        if ($passwordverify == true && $selectUser['email_user'] == $email) {
            echo 'Connexion réussie';
            $_SESSION['user']['nom_user'] = $selectUser['nom_user'];
            $_SESSION['user']['prenom_user'] = $selectUser['prenom_user'];
            $_SESSION['user']['adresse_user'] = $selectUser['adresse_user'];
            $_SESSION['user']['email_user'] = $selectUser['email_user'];
            $_SESSION['user']['mdp_user'] = $selectUser['mdp_user'];
            $_SESSION['user']['ID_ville'] = $selectUser['ID_ville'];
            $_SESSION['user']['ID_role'] = $selectUser['ID_role']; 
            header('Location: index.php');      
        }
        else {echo "Mot de passe incorrect. Veuillez réessayer";}
    }  
    else {echo "User inexistant";}

}  
 }





/**
 * ajout categorie
 *
 * @param PDO $bdd
 * @param STR $categorie
 * @return void
 */
function addcat($bdd,$categorie) {
    $queryStr = 'INSERT INTO categorie (ID, nom_categorie) VALUES (null, :nom_categorie)'; 
    $query = $bdd->prepare($queryStr);
    $query->bindValue(':nom_categorie',$categorie, PDO::PARAM_STR);
    $query->execute();
    header('Location: index.php');
    }
/**
 * ajout produit
 *
 * @param PDO $bdd
 * @param [type] $produit
 * @return void
 */
function addprod ($bdd,$produit) {
    $queryStr = 'INSERT INTO produit (ID, nom_produit,prix_produit,ID_categorie) VALUES (null, :nom_produit,:prix_produit,:ID_categorie)'; 
    $query = $bdd->prepare($queryStr);
    $query->bindValue(':categorie',$produit, PDO::PARAM_STR);
    $query->execute();
    header('Location: index.php');
    }

    /**
     * ajout utilisateur 
     *
     * @param PDO $bdd
     * @param STR $nom
     * @param STR $prenom
     * @param STR $adresse
     * @param STR $email
     * @param STR $numero
     * @param STR $hash
     * @param INT $ville
     * @param INT $role
     * @return void
     */


function inscription ($bdd,$nom,$prenom,$adresse,$email,$numero,$hash,$ville,$role) {
    
    $queryStr = 'INSERT INTO user (ID,nom_user,prenom_user,adresse_user,email_user,tel_user,mdp_user,ID_ville,ID_role) VALUES (null,:nom,:prenom,:adresse,:email,:tel,:mdp,:ID_ville,:ID_role)'; 
    $query = $bdd->prepare($queryStr);
    $query->bindValue(':nom',$nom, PDO::PARAM_STR);
    $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
    $query->bindValue(':adresse',$adresse, PDO::PARAM_STR);
    $query->bindValue(':email',$email, PDO::PARAM_STR);
    $query->bindValue(':tel',$numero, PDO::PARAM_STR);
    $query->bindValue(':mdp',$hash, PDO::PARAM_STR);
    $query->bindValue(':ID_ville',$ville, PDO::PARAM_INT);
    $query->bindValue(':ID_role',$role, PDO::PARAM_INT);
    $query->execute();
    echo 'Inscription enregistrée';
    /*header('Location: index.php'); */
    }

    /**
     * Selectioner la liste des villes en BD
     *
     * @param PDO $bdd
     * @param str $ville
     * @return array
     */
function selVille($bdd,$ville) {
$selectVilleStr= 'SELECT * FROM ville WHERE nom_ville = :nom_ville';
$selectVilleQuery = $bdd ->prepare($selectVilleStr);
$selectVilleQuery -> bindValue (':nom_ville',$ville,PDO::PARAM_STR); 
$selectVilleQuery->execute();
$selectVille = $selectVilleQuery->fetch();
return $selectVille;
}

/**
 * Selectionner la liste des categories en BD
 *
 * @param PDO $bdd
 * @return array
 */
function getCategories($bdd){
    $selectStr= 'SELECT * FROM categorie';
    $selectQuery =$bdd->query($selectStr);
    $donnee = $selectQuery->fetchAll();
    return $donnee;
}

/**
 * Selectionner la liste des Utilisateurs
 *
 * @param PDO $bdd
 * @param str $email
 * @return array
 */
function selUser($bdd,$email) {
$selectUserStr= 'SELECT * FROM user WHERE email_user = :email_user';
$selectUserQuery = $bdd ->prepare($selectUserStr);
$selectUserQuery -> bindValue (':email_user', $email,PDO::PARAM_STR); 
$selectUserQuery->execute();
$selectUser = $selectUserQuery->fetch();
return $selectUser;
}

/**
 * selecitonner les categories par ordre ascendant
 *
 * @param PDO $bdd
 * @return array
 */
function selCategories($bdd) {
$selectStr='SELECT * FROM categorie ORDER BY nom_categorie ASC';
$selectQuery =$bdd->query($selectStr);
$bddArray = $selectQuery->fetchAll();
return $bddArray;
}

/**
 * selectionner les produits
 *
 * @param PDO $bdd
 * @return array
 */
function selProduits($bdd) {
    $selectStr='SELECT * FROM produit';
    $selectQuery =$bdd->query($selectStr);
    $bddArray = $selectQuery->fetchAll();
    return $bddArray;
    }


/**
 * selectionner les produits et categories
 *
 * @param PDO $bdd
 * @return array
 */
function selProduitsJoinCat($bdd) {
        $selectStr='SELECT * FROM produit INNER JOIN categorie on ID_categorie = categorie.ID' ;
        $selectQuery =$bdd->query($selectStr);
        $bddArray = $selectQuery->fetchAll();
        return $bddArray;
        }

        

function insertproduit($bdd,$nom,$prix,$categorie) {
    $queryStr = 'INSERT INTO produit (ID, nom_produit, prix_produit,ID_categorie) VALUES (null, :nom_produit, :prix_produit, :ID_categorie)'; 
    $query = $bdd->prepare($queryStr);
    $query->bindValue(':nom_produit',$nom, PDO::PARAM_STR);
    $query->bindValue(':prix_produit',$prix, PDO::PARAM_STR);
    $query->bindValue(':ID_categorie',$categorie, PDO::PARAM_INT);
    $query->execute();
    echo 'produit ajouté au catalogue';
}


/**
 * selectionner le dernier produit en BD
 *
 * @param PDO $bdd
 * @return array
 */
function selLastProd($bdd) {
$selectProd = 'SELECT MAX(ID) FROM produit';
$selectQuery =$bdd->query($selectProd);
$produitID = $selectQuery->fetch();
return $produitID;
}

/**
 * insertion image en DB
 *
 * @param PDO $bdd
 * @param STR $targetFile
 * @param INT $produit
 * @return void
 */
function insertImage ($bdd,$targetFile,$produit) {
    $imageStr = 'INSERT INTO imageproduit (ID, nom_image, ID_produit) VALUES (null, :nom_image, :ID_produit)'; 
    $queryImage = $bdd->prepare($imageStr);
    $queryImage->bindValue(':nom_image',$targetFile, PDO::PARAM_STR);
    $queryImage->bindValue(':ID_produit',$produit, PDO::PARAM_INT);
    $queryImage->execute();
}

/**
 * supprimer une catégorie
 *
 * @param PDO $bdd
 * @return void
 */
function deleteCat($bdd){
if (isset($_GET['delete'])){
    $delete=$_GET['delete'];

    $queryStr='DELETE FROM categorie WHERE categorie.ID = :ID';
    $query = $bdd ->prepare($queryStr);
    $query -> bindValue (':ID',$delete,PDO::PARAM_INT); 
    $query->execute();
    header('Location: index.php');  
}
}


function selProduitbyID($bdd,$update) {
$queryStr = 'SELECT * FROM produit INNER JOIN categorie on ID_categorie = categorie.ID WHERE produit.ID = :ID';
$query = $bdd ->prepare($queryStr);
$query-> bindValue(':ID',$update, PDO::PARAM_INT);
$query->execute(); 

}

?>