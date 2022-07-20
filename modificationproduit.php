<?php require "structure/header.php";

require "entity/Produit.php";
require "entity/ProduitsController.php";
?>

<script language="javascript">
    document.title = "Modification Produit";
</script>


<?php
//    //INSTANCIATION DE PDO
//     define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT '].'/GeveditPlus/');
//     define('URL','/GeveditPlus/');
//     $bddPDO = new pdo('mysql:host=localhost;dbname=gevedit', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

   // INSTANCIATION DE LA CLASSE produitcontroller
   
   $produit_controller = new ProduitsController($bddPDO);
   // RECUPERATION DU PRODUIT PAR SON ID
   if ($_GET['id_produit']) {
       $produit = $produit_controller->afficherProduitParId($_GET['id_produit']);
   }
   // DECLARATION DE LA VARIABLE produit
   
   $message = '';
   if ($_POST) {
       // ON INSTANCIE UN OBJET PRODUIT ET INITIALISATION DES VARIABLES
       $produit = new Produit([
           'id_produit' => $_GET['id_produit'],
           'nom' => $_POST['nom'],
           'description' => $_POST['description'],
           'categorie' => $_POST['categorie'],
           'prix' => $_POST['prix']
       ]);
       // ON VERIFIE SI LE PRODUIT EST VALIDE
       if ($produit->isProduitValid()) {
           // ON MET UN A JOUR DE PRODUIT GRACE A LA FONCTION SUIVANTE:
           $produit_controller->modifierProduitParId($produit);
           $message .= '<div class="alert alert-success" role="alert">Produit modifié avec succès</div>';
           header('location:gestionproduit.php');
       } else {
           // ON RECUPERE LES ERREURS
           $erreurs = $produit->getErreurs();
           $message .= '<div class="alert alert-danger" role="alert">produit n\'est pas valide</div>';
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

<h1 class="text-center">Modifier le  produit</h1>
<section class="col-md-6 mx-auto m-1">
     <?= $content ?>
    <form method="post" action="" enctype="multipart/form-data">

        <label for="nom">Nom  du produit</label>
        <input type="text" name="nom"id="nom" class="form-control" placeholder="nom" value="<?= $produit['nom'] ?>">

        <label for="description">description du produit</label>
        <input type="text" name="description" id="description" class="form-control" placeholder="Votre description" value= "<?= $produit['description'] ?>">

        <label for="categorie">categorie du produit</label>
        <input type="text" name="categorie" id="categorie" class="form-control" placeholder="Votre categorie" value="<?= $produit['categorie'] ?>">

        <label for="photo">Photo</label>
        <input type="text" name="photo" id="photo" class="form-control" placeholder="Votre photo" value="<?= $produit['photo'] ?>">

        <label for="photo2">photo2</label>
        <input type="photo2" name="photo2" id="photo2" class="form-control" placeholder="Votre photo2" value="<?= $produit['photo2'] ?>">

        <label for="prix">prix</label>
        <input type="prix" name="prix" id="prix" class="form-control" placeholder="Votre prix" value="<?= $produit['prix'] ?>">

        <br>

        
        <div class="mt-2">
            <button class="btn btn-dark">Enregistrer</button>
        </div>

    </form>






</section>











<?php require "structure/footer.php";?>


