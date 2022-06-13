<?php

// données de connexion à la BD avec l'objet PDO
$host= 'localhost:8889';
$dbName = 'fastfood';
$user = 'root';
$mdp= 'root';
$charset = 'utf8';

try{
 $bdd= new PDO("mysql:host=$host;dbname=$dbName",$user,$mdp);
} catch(PDOException $fail) {
echo 'Erreur: '.$fail->getMessage();
die();
} 

?>