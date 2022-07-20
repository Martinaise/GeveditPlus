<?php require "structure/header.php";

require "entity/Utilisateur.php";
require "entity/UtilisateursController.php";
?>


<?php

    //INSTANCIATION DE PDO
    // define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT '].'/GeveditPlus/');
    // define('URL','/GeveditPlus/');
  
    //POUR xampp
    // definition de constante 
    // define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/GeveditPlus/');
    // define('URL','http://localhost/GeveditPlus/');

   $bddPDO = new pdo('mysql:host=localhost;dbname=gevedit', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   // INSTANCIATION DE LA CLASSE Utilisateurcontroller
   
   $utilisateur_controller = new UtilisateursController($bddPDO);
   // RECUPERATION DU Utilisateur PAR SON ID

   
   if ($_GET['id_utilisateur']) {
       $utilisateur = $utilisateur_controller->afficherUtilisateurParId($_GET['id_utilisateur']);
   }
   // DECLARATION DE LA VARIABLE produit
   
   $message = '';
   if ($_POST) {
      
       // ON INSTANCIE UN OBJET PRODUIT ET INITIALISATION DES VARIABLES
       $utilisateur = new Utilisateur([
        'id_utilisateur' => $_GET['id_utilisateur'],
           'nom' => $_POST['nom'],
           'prenom' => $_POST['prenom'],
           'email' => $_POST['email'],
           'adresse' => $_POST['adresse'],
           'code_postal' => $_POST['code_postal'],
           'tel' => $_POST['tel'],
           'mdp' => $_POST['mdp'],
        ]);


     
       // ON VERIFIE SI LE UTILISATEUR EST VALIDE
       if ($utilisateur->isUserValid()) {
           // ON MET UN A JOUR DE utilisateur GRACE A LA FONCTION SUIVANTE:
           $utilisateur_controller->modifierUtilisateurParId($utilisateur);
           $message .= '<div class="alert alert-success" role="alert">Utilisateur modifié avec succès</div>';
           header('location:profil.php');
       } else {
           // ON RECUPERE LES ERREURS
           $erreurs = $utilisateur->getErreurs();
           $message .= '<div class="alert alert-danger" role="alert">utilisateur n\'est pas valide</div>';
       }
   }


    // if (empty($erreur)) { // si $erreur est vide alors on peut inserer dans la bdd

    // // // TODO: GESTION DE LA PHOTO
    // // $photo_bdd = '';
    // // if(!empty($_FILES['photo']['name'])){
    // // // si le champs photo n'est pas vide
    // //    $nom_photo = $_POST['pseudo'] . '_' . $_FILES['photo']['name'] ;
    // //   // $nom_photo contien la concatenation du pseudo et du nom de la photo
    // //    $photo_bdd = URL . "photo/$nom_photo";
    // //  // $photo_bdd contien l'url de la photo (le chemain de la photo)
    // //    $photo_dossier = RACINE_SITE . "photo/$nom_photo";
    // // // $photo_dossier contien le chemain absolut de la photo dans notre dossier photo (vide de base)
    // //    copy($_FILES['photo']['tmp_name'], $photo_dossier);
    // //    // la fonction copy permet de copier la photo dans le dossier photo
    // //   // ne pas oublier le enctype="multipart/form-data" dans le formulaire
    // //   // pour le taitement des fichier medias

    // // }

    //      if(empty($_POST['mdp'])){
    //         $pdo->query("UPDATE membre SET pseudo = '$_POST[pseudo]', nom = '$_POST[nom]', prenom = '$_POST[prenom]', email = '$_POST[email]', ville = '$_POST[ville]', code_postal = '$_POST[code_postal]', adresse = '$_POST[adresse]', photo = '$photo_bdd' WHERE id_membre = '$_GET[id]'");
    //      }else{
    //         $pdo->query("UPDATE membre SET pseudo = '$_POST[pseudo]', nom = '$_POST[nom]', prenom = '$_POST[prenom]', email = '$_POST[email]', ville = '$_POST[ville]', code_postal = '$_POST[code_postal]',mdp = '$mdp', adresse = '$_POST[adresse]', photo = '$photo_bdd' WHERE id_membre = '$_GET[id]'");
    //      }

    //       $content .= '<div class="alert alert-success">Mise a jour pris en compte</div>';
    // }
    // $content .= $erreur ;

?>

<h1 class="text-center">Modifier utilisateur</h1>
<section class="col-md-6 mx-auto m-1">
     
    <form method="post" action="" enctype="multipart/form-data">

        <label for="nom">Nom  </label>
        <input type="text" name="nom"id="nom" class="form-control" placeholder="nom" value="<?= $_SESSION['utilisateur']['nom'] ?>">

        <label for="prenom">prenom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Votre prenom" value= "<?= $_SESSION['utilisateur']['prenom'] ?>">

        <label for="email">email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Votre email" value="<?= $_SESSION['utilisateur']['email'] ?>">

        <!-- <label for="photo">Photo</label>
        <input type="text" name="photo" id="photo" class="form-control" placeholder="Votre photo" value="= $utilisateur['photo'] ?>">
       

        <label for="photo2">photo2</label>
        <input type="photo2" name="photo2" id="photo2" class="form-control" placeholder="Votre photo2" value="= $utilisateur['photo2'] ?>"> -->

        <label for="adresse">adresse</label>
        <input type="adresse" name="adresse" id="adresse" class="form-control" placeholder="Votre adresse" value="<?= $_SESSION['utilisateur']['adresse'] ?>">

        <label for="code_postal">code_postal</label>
        <input type="code_postal" name="code_postal" id="code_postal" class="form-control" placeholder="Votre code_postal" value="<?= $_SESSION['utilisateur']['code_postal'] ?>">

        <label for="tel">tel</label>
        <input type="tel" name="tel" id="tel" class="form-control" placeholder="Votre tel" value="<?= $_SESSION['utilisateur']['tel'] ?>">

        <label for="mdp">mdp</label>
        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Votre mdp">

        <br>

        
        <div class="mt-2">
            <button class="btn btn-dark">Modifier</button>
        </div>

    </form>






</section>











<?php require "structure/footer.php";?>


