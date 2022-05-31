<?php


include('./bdd.php');

function addcat($bdd,$categorie) {
    $queryStr = 'INSERT INTO categorie (ID, nom_categorie) VALUES (null, :nom_categorie)'; 
    $query = $bdd->prepare($queryStr);
    $query->bindValue(':nom_categorie',$categorie, PDO::PARAM_STR);
    $query->execute();
    header('Location: index.php');
    }

function addprod ($bdd,$produit) {
    $queryStr = 'INSERT INTO produit (ID, nom_produit,prix_produit) VALUES (null, :nom_produit,:prix_produit)'; 
    $query = $bdd->prepare($queryStr);
    $query->bindValue(':categorie',$produit, PDO::PARAM_STR);
    $query->execute();
    header('Location: index.php');
    }


?>