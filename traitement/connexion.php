<?php
// on appelle la fonction qui connecte l'utilisateur
include('../model/function.php');
connexion($bdd);
?>



<section id= "renseigner">
    <form action="" method="post">
           
            <input class="input" name="email" id="email" type="text" placeholder="E-mail" required/>
            <input class="input" name="password" id="password" type="text" placeholder="Password" required/>	 
            <button type="submit" id="submit" value="Connexion">Connexion </button>  

        </form>

</section>

