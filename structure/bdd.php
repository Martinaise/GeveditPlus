<?php 
//Connexion à la base de données
$bddPDO = new PDO('mysql:host=localhost;dbname=gevedit', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// creation de la session permet de stocker des informations sur lesinternautes
session_start();

//POUR wampp
    //definition de constante 
    define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/GeveditPlus/');
    define('URL','/GeveditPlus/');

   //POUR xampp
   // definition de constante 
   //define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/GeveditPlus/');
   //define('URL','http://localhost/GeveditPlus/');
   
$content = '';
?>