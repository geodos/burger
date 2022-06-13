
<?php

include('../model/function.php');


if(isset($_POST['nom'])) {
    $nom=strip_tags($_POST['nom']);
    $prenom=strip_tags($_POST['prenom']);
    $adresse=strip_tags($_POST['adresse']);
    $numero=htmlspecialchars($_POST['numero']);
    $email=htmlspecialchars($_POST['email']);
    $ville=htmlspecialchars($_POST['ville']);
    $emailconfirm=htmlspecialchars($_POST['emailconfirm']);
    $password=($_POST['password']);
    $passwordconfirm=($_POST['passwordconfirm']);
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $role = 1;
    $selVille = selVille($bdd,$ville);

    // si selUserest différent de null cela signifie que nous avons déja un utilisateur possédant l'email renseigné
    if (selUser($bdd,$email) !=null) {
        echo 'User déja existant. Merci de vous connecter';}
    //sinon si selUser == nul signifie que l'email n'existe pas et donc l'utilisateur. On ajoute une condition sur le check d'existence de la ville 
     else if (selUser($bdd,$email) ==null && selVille($bdd,$ville)!= null) {
             
            if($email==$emailconfirm && $password==$passwordconfirm) {
                //on sécurise le password  en le cryptant avec la fonction password_hash, le résultat est mis dans une variable que l'on va binder et insérer en BD via notre query. Nous aurons donc au final un password crypté en BD pour l'utilisateur 
            
                inscription($bdd,$nom,$prenom,$adresse,$email,$numero,$hash,$selVille['ID'],$role);
            }
            if ($password != $passwordconfirm) {
                echo "Le mot de passe ne correspond pas";
            }
            
            if ($email != $emailconfirm) {
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
            <input class="input" name="emailconfirm" id="emailconfirm" type="email" placeholder="Confirmer E-mail" required/>
            <input class="input" name="password" id="password" type="text" placeholder="Mot de passe" required/>
            <input class="input" name="passwordconfirm" id="passwordconfirm" type="text" placeholder="Confirmer mot de passe" required/>	 
            <button type="submit" id="submit" value="Rechercher">Sauvegarder </button>  

        </form>

    </section>

   