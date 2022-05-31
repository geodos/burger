

<?php
session_start();
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Burger Company</title>
</head>
<body>



	<form action="insertcategorie.php" method="post">
        <p><input class="input" name="categorie" id="categorie" type="text" placeholder="categorie" required/></p>
	    <p><input  type="submit" name="submit" value="Envoyer" required /></p>
        </form>