

<?php
session_start();    
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/assets/style.css">
    <title>Burger Company</title>
</head>
<body>
<header>

<?php

   if (isset($_GET['page'])){
    $page= $_GET['page'];
    echo '<a href="../public/index.php">Accueil</a>';
    

    switch($page){
        case 'insertcategorie': 
            include('../traitement/insertcategorie.php');
            if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==2){     
                echo '<nav id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p>'
            ;}
            break;

        case 'connexion': 
            include('../traitement/connexion.php');
            if (!isset($_SESSION['user'])){     
                echo '<nav id= "user"><p> Veuillez entrer vos identifiants de connexion</p>';
            }
            break;

        case 'inscription': 
            include('../traitement/inscription.php');
            break;

            case 'deletecategorie': 
                include('../traitement/deletecategorie.php');
                break;

                case 'updateproduit': 
                    include('../traitement/updateproduit.php');
                    break;

        case 'insertproduit': 
            include('../traitement/insertproduit.php');
            if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==2){     
                    echo '<nav id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p>
                    <a href="../traitement/deconnexion.php" id="deconnexion">Deconnexion</a></nav>';
            }
            break;

        case 'updateproduit':
            include('../traitement/updateproduit.php');
            break;
    
        default: 
            include('../traitement/accueil.php');
            echo '<form action="" method="POST" id="navaccueil">
            <input type="text" name="" id="input" placeholder="Rechercher" required>  
            <input type="submit" id="submit" value="Rechercher">
            </form>';
        
        }


} else {
    include('../traitement/accueil.php');
    if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==2){     
        echo '<nav id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p>
        <a href="../traitement/deconnexion.php" id="deconnexion">Deconnexion</nav></a>
        <nav id="ajouts"><a href="index.php?page=insertcategorie">Catégories</a>
        <a href="index.php?page=insertproduit">Produits</a></nav>
        <form action="" method="POST" id="navaccueil">';
    
    }
    else if (isset($_SESSION['user']) && !empty($_SESSION['user']['prenom_user']) && $_SESSION['user']['ID_role']==1) {
        echo '<nav id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p>
        <a href="../traitement/deconnexion.php" id="deconnexion">Deconnexion</nav></a>
        <form action="" method="POST" id="navaccueil">
    <input type="text" name="produit" id="produit" placeholder="rechercher un produti" required>  
    <input type="submit" id="submit" value="Rechercher">
    </form>';
        
    }
    else {
    echo'<nav id="user"><a href="index.php?page=inscription">Inscription</a>
    <a href="index.php?page=connexion">Connexion</a></nav>
    <form action="" method="POST" id="navaccueil">
    <input type="text" name="produit" id="produit" placeholder="rechercher un produit" required>  
    <input type="submit" id="submit" value="Rechercher">
    </form>';
    }
}

?>
</header>

</body>
</html>