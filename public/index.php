

<?php
include('../class/Panier.php'); 
session_start(); 

?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <script src="https://kit.fontawesome.com/6123172110.js" crossorigin="anonymous"></script>
    <title>Burger Company</title>
</head>
<body>
    <header>
    <div class="logo">
    <img src="../public/assets/images/logo.png" alt="">
    </div>

    <nav>
        <ul>
            <li class="menu-deroulant">
                <a href="#">La carte</a>
                <ul class="sous-menu">
                    <li><a href="">Menus</a></li>
                    <li><a href="">Burgers</a></li>
                    <li><a href="">Frites</a></li>
                    <li><a href="">Boissons</a></li>
                </ul>
            </li>

            <li><a href="index.php?page=catalogue">Click&Collect</a></li>

            <li><a href="">A propos</a></li>

            <li><a href="">Contact</a></li>

            <li><a href= "../public/index.php"> Accueil </a> </li>

        </ul>
    

    </nav>
    <div id="panier">
    <a href="index.php?page=vuepanier"><i class="fa-solid fa-cart-shopping"></i></a>
    </div>

    <?php
    if (isset($_GET['page'])){
    $page= $_GET['page'];
    

    switch($page){


        case 'insertproduit': 
            if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==2){     
                echo '<div id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p></div>'
            ;}
            break;

        case 'insertcategorie': 
            if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==2){     
                echo '<div id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p>
                <a href="../traitement/deconnexion.php" id="deconnexion">Deconnexion</a></div>';
            }
            break;
        default : 
        

        
    }   
    } 
    else 
    { 
        if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==2){     
            echo '<div id= "user"><p> Bonjour '.($_SESSION['user']['prenom_user']).'</p></div>
           
            <div id="ajouts"><a href="index.php?page=insertproduit">Gestion produits</a>
            <a href="index.php?page=insertcategorie">Gestion categories</a>
            <a href="../traitement/deconnexion.php" id="deconnexion">Deconnexion</a></div>';
        }
        else if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['ID_role']==1) {
            echo '<div id= "user"><div> Bonjour '.($_SESSION['user']['prenom_user']).'</div>
            <div id="ajouts"><a href="../traitement/deconnexion.php" id="deconnexion">Deconnexion</a></div>';    
        }
        else {
        echo'<div id="user"><a href="index.php?page=inscription">Inscription</a>
        <a href="index.php?page=connexion">Connexion</a></div>';
        }
    }
?>



    </header>


<?php
if (isset($_GET['page'])){
 $page= $_GET['page'];

 switch($page){
     case 'insertcategorie': 
         include('../traitement/backoffice/insertcategorie.php');

         break;

     case 'connexion': 
         include('../traitement/connexion.php');

         break;

     case 'inscription': 
         include('../traitement/inscription.php');
         break;

         case 'deletecategorie': 
             include('../traitement/backoffice/deletecategorie.php');
             break;

         case 'updateproduit': 
                 include('../traitement/backoffice/updateproduit.php');
                 break;

         case 'carte':
             include('../traitement/carte.php');
             break;

         case 'insertproduit': 
         include('../traitement/backoffice/insertproduit.php');

         break;

        case 'catalogue';
        include('../traitement/catalogue.php');

        break;

        case 'ajoutpanier';
        include('../traitement/ajoutpanier.php');

        break;

        case 'supprimerpanier';
        include('../traitement/supprimerpanier.php');

        break;

        case 'vuepanier';
        include('../traitement/vuepanier.php');

        break;

        default: 
         include('../traitement/accueil.php');
       
     
     }


} else {
 include('../traitement/accueil.php');
}
    
?>
</body>
</html>
