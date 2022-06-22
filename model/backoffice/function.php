<?php


include('../model/bdd.php');

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

    function selProduitplusImages($bdd) {
        $selectStr='SELECT *, produit.ID AS produit_id FROM produit INNER JOIN imageproduit on produit.ID = imageproduit.ID_produit';
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
        $selectStr='SELECT *,produit.ID AS ID_produit FROM produit INNER JOIN categorie on ID_categorie = categorie.ID' ;
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
$queryStr = 'SELECT * FROM produit INNER JOIN categorie on ID_categorie = categorie.ID INNER JOIN imageproduit on produit.ID = imageproduit.ID_produit WHERE produit.ID = :ID';
$query = $bdd ->prepare($queryStr);
$query-> bindValue(':ID',$update, PDO::PARAM_INT);
$query->execute(); 
$selectQuery = $query->fetch();
return $selectQuery;
}



function getImageByProdId($bdd, $id){
    $str = 'SELECT ID as image_id, nom_image FROM imageproduit WHERE ID_produit = :id';
    $query = $bdd->prepare($str);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    if($query->rowCount() > 0){
        return $query->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function getProduitById($bdd, $id){
    $produitStr = 'SELECT * FROM produit WHERE ID = :id';
    $prodQuery = $bdd->prepare($produitStr);
    $prodQuery->bindValue(':id', $id, PDO::PARAM_INT);
    $prodQuery->execute();
    $prod = $prodQuery->fetch(PDO::FETCH_ASSOC);
    $image = getImageByProdId($bdd, $id);
    if($image != false){
        array_push($prod, $image);
    }
    return $prod;
}


function updateProduit($bdd,$ID,$produit,$prix,$categorie) {

    $updateStr = "UPDATE produit SET nom_produit = :nom_produit, prix_produit=:prix_produit, ID_categorie=:ID_categorie WHERE ID=:ID";
    $query = $bdd->prepare($updateStr);
    $query->bindValue(':ID',$ID, PDO::PARAM_INT);
    $query->bindValue(':nom_produit',$produit, PDO::PARAM_STR);
    $query->bindValue(':prix_produit',$prix, PDO::PARAM_STR);
    $query->bindValue(':ID_categorie',$categorie,PDO::PARAM_INT);
    $query->execute();
}

function selProduitbyProductname($bdd,$produit) {
    $queryStr = 'SELECT * FROM produit INNER JOIN categorie on ID_categorie = categorie.ID WHERE nom_produit = :nom_produit';
    $query = $bdd ->prepare($queryStr);
    $query-> bindValue(':nom_produit',$produit, PDO::PARAM_INT);
    $query->execute(); 
    $selectQuery = $query->fetch();
    return $selectQuery;
}

/*
function selProduitbyIDimplode($bdd,$ids) {
    $queryStr = 'SELECT * FROM produit INNER JOIN categorie on ID_categorie = categorie.ID INNER JOIN imageproduit on produit.ID = imageproduit.ID_produit WHERE produit.ID = :ID IN ('.implode(',',$ids).')');
    $query = $bdd ->prepare($queryStr);
    $query-> bindValue(':ID',$update, PDO::PARAM_INT);
    $query->execute(); 
    $selectQuery = $query->fetch();
    return $selectQuery;
    }
*/

/*
function getProduiById($bdd,$userId){
    $str = 'SELECT * FROM panier WHERE ID_user = :id';
    $query = $bdd -> prepare($str);
    $query-> bindValue(':id',$userId, PDO::PARAM_INT);
    $query->execute(); 
    if($query->rowCount() > 0){
        return $query->fetch();

    } else {
        return false;
    }

}

function getProduitById($bdd,$id){

}

function setNewPanier($bdd,$productId,$userId) {
    prodInfo= getProduitById()
    $strPanier = 'INSERT INTO panier(ID,ID_user) VALUES (null, :ID, :ID_user)'; 
    $queryPanier = $bdd->prepare($strPanier);
    $queryPanier->bindValue(':ID',$productId, PDO::PARAM_STR);
    $queryPanier->bindValue(':ID_user',$userId, PDO::PARAM_INT);
    $queryPanier->execute();
}
*/
?>