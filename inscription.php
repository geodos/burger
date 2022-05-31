
<?php


if(isset($_POST['nom'])) {
    $nom=strip_tags($_POST['nom']);
    $prenom=strip_tags($_POST['prenom']);
    $adresse=strip_tags($_POST['adresse']);
    $numero=htmlspecialchars($_POST['numero']);
    $mail=htmlspecialchars($_POST['email']);
    $mailconfirm=htmlspecialchars($_POST['mailconfirm']);
    $password=($_POST['password']);
    $passwordconfirm=($_POST['passwordconfirm']);
    $selectVilleStr= 'SELECT * FROM villes WHERE nom_ville = :nom_ville';
    $selectVilleQuery = $bdd ->prepare($selectVilleStr);
    $selectVilleQuery -> bindValue (':nom_ville', $_POST['ville'],PDO::PARAM_STR); 
    $selectVilleQuery->execute();
    $selectVille = $selectVilleQuery->fetch();
    $role = 1;
    $selectUserStr= 'SELECT * FROM user WHERE email_user = :email_user';
    $selectUserQuery = $bdd ->prepare($selectUserStr);
    $selectUserQuery -> bindValue (':email_user', $_POST['email'],PDO::PARAM_STR); 
    $selectUserQuery->execute();
    $selectUser = $selectUserQuery->fetch();
    

    // si $selectUser est différent de null cela signifie que nous avons déja un utilisateur possédant l'email renseigné
    if ($selectUser !=null) {
        echo 'User déja existant. Merci de vous connecter';}
    //sinon si $selectUser == nul signifie que l'email n'existe pas et donc l'utilisateur. On ajoute une condition sur le check d'existence de la ville 
     else if ($selectUser==null && $selectVille!= null) {
             
            if($mail==$mailconfirm && $password==$passwordconfirm) {
                //on sécurise le password  en le cryptant avec la fonction password_hash, le résultat est mis dans une variable que l'on va binder et insérer en BD via notre query. Nous aurons donc au final un password crypté en BD pour l'utilisateur 
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $queryStr = 'INSERT INTO user (ID,nom_user,prenom_user,adresse_user,email_user,tel_user,mdp_user,ID_ville,ID_role) VALUES (null,:nom,:prenom,:adresse,:mail,:numero,:mdp,:ID_ville,:ID_role)'; 
                $query = $bdd->prepare($queryStr);
                $query->bindValue(':nom',$nom, PDO::PARAM_STR);
                $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
                $query->bindValue(':adresse',$adresse, PDO::PARAM_STR);
                $query->bindValue(':mail',$mail, PDO::PARAM_STR);
                $query->bindValue(':numero',$numero, PDO::PARAM_STR);
                $query->bindValue(':mdp',$hash, PDO::PARAM_STR);
                $query->bindValue(':ID_role',$role, PDO::PARAM_INT);
                $query->bindValue(':ID_ville_id',$selectVille['ville_id'], PDO::PARAM_INT);
                $query->execute();
                echo 'Inscription enregistrée';
            }
            if ($password != $passwordconfirm) {
                echo "Le mot de passe ne correspond pas";
            }
            
            if ($mail != $mailconfirm) {
                echo "L'e-mail ne correspond pas";
            }
        
    } else {
    echo 'ville non identifiée';}
}

    ?>



<section id= "renseigner">
    <form action="" method="post">
           
            <input class="input" name="nom" id="nom" type="text" placeholder="Nom" required/>
            <input class="input" name="prenom" id="prenom" type="text" placeholder="Prenom" required/>
            <input class="input" name="adresse" id="adresse" type="text" placeholder="Adresse" required/>
            <input class="input" name="ville" id="ville" type="text" placeholder="Ville" required/>
            <input class="input" name="numero" id="numero" type="text" placeholder="Numéro de téléphone" required/>	
            <input class="input" name="email" id="email" type="email" placeholder="E-mail" required/>
            <input class="input" name="mailconfirm" id="mailconfirm" type="email" placeholder="Confirmer E-mail" required/>
            <input class="input" name="password" id="password" type="text" placeholder="Mot de passe" required/>
            <input class="input" name="passwordconfirm" id="passwordconfirm" type="text" placeholder="Confirmer mot de passe" required/>	 
            <button type="submit" id="submit" value="Rechercher">Sauvegarder </button>  

        </form>

    </section>

   