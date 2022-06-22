<?php


include('../model/bdd.php');

/**
 * connexion utilisateur
 *
 * @param PDO $bdd
 * @return void
 */
function connexion($bdd,$email,$password) {

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


    function createPanier($bdd,$IDuser){
        $queryStr = 'INSERT INTO panier (ID,ID_user) VALUES (null,:ID_user)'; 
        $query = $bdd->prepare($queryStr);
        $query->bindValue(':ID_user',$IDuser, PDO::PARAM_INT);
        $query->execute();
    }

    

    function selVille($bdd,$ville) {
        $selectVilleStr= 'SELECT * FROM ville WHERE nom_ville = :nom_ville';
        $selectVilleQuery = $bdd ->prepare($selectVilleStr);
        $selectVilleQuery -> bindValue (':nom_ville',$ville,PDO::PARAM_STR); 
        $selectVilleQuery->execute();
        $selectVille = $selectVilleQuery->fetch();
        return $selectVille;
        }

        function selUser($bdd,$email) {
            $selectUserStr= 'SELECT * FROM user WHERE email_user = :email_user';
            $selectUserQuery = $bdd ->prepare($selectUserStr);
            $selectUserQuery -> bindValue (':email_user', $email,PDO::PARAM_STR); 
            $selectUserQuery->execute();
            $selectUser = $selectUserQuery->fetch();
            return $selectUser;
            }

/*
            function addItemToCart($bdd,$id){
            if(isset($_SESSION['user'])&& !empty($_SESSION['user'])){
                $bddPanier= getPanierByUserId($bdd,$_SESSION['user]['ID_user']])
            }


            } else {if(isset($_SESSION['panier'])){
                array_push(($_SESSION['panier'],$id);
            
            } else 
            
            ?>