<?php
// on appelle la fonction qui connecte l'utilisateur
include('../model/function.php');

if(isset($_POST['email'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    connexion($bdd,$email,$password);
}
?>



<section class= "renseigner">

<div class= "message-user">
    <h2> Veuillez entrer vos identifiants de connexion</h2>
</div>

<div class="formulaire-connexion">
<form action="" method="post">
         <ul>
    <li><input class="input" name="email" id="email" type="text" placeholder="E-mail" required/></li>
    <li><input class="input" name="password" id="password" type="text" placeholder="Password" required/></li>	 
    <li><input type="submit" id="connexion" value="Connexion"></li>
    </ul>
</form>
</div>

</section>

