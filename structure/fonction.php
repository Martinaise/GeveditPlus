<?php 
// Fonction qui verifie si un utilisateur est connecté
function internauteEstConnecte(){
    if(!isset($_SESSION['utilisateur']))
    {
        return false;
    }
    else
    {
        return true;
    }
}

// Fonction qui verifie si un utilisateur est admin

function internauteEstConnecteEtEstAdmin(){
   if(internauteEstConnecte() && $_SESSION['utilisateur']['role'] == "admin" ){
         return true;
    }
    else{
         return false;
   }
    
}
