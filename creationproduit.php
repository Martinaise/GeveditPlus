<?php require "structure/header.php";
require "entity/Produit.php";
require "entity/ProduitsController.php"; ?>

<!-- define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/GeveditPlus/');
define('URL','/GeveditPlus/');
$bddPDO = new PDO('mysql:host=localhost;dbname=gevedit','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); -->


<script language="javascript">
    document.title = "Nouveau Produit";
</script>

<?php



$bddPDO = new PDO('mysql:host=localhost;dbname=gevedit','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


$produit_controller = new ProduitsController($bddPDO);

if ($_POST){
   foreach ($_POST as $indice => $valeur) {

    $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);

      $_POST[$indice] = addslashes($valeur);
   }

    //TODO: GESTION DE LA PHOTO
    $photo_bdd = '';
    if(!empty($_FILES['photo']['name'])){
    // si le champs photo n'est pas vide
        $nom_photo = $_POST['categorie'] . '_' . $_FILES['photo']['name'] ;
        // $nom_photo contien la concatenation du nom et du nom de la photo
        $photo_bdd = URL . "photo/$nom_photo";
    // $photo_bdd contien l'url de la photo (le chemain de la photo)
        $photo_dossier = RACINE_SITE . "photo/$nom_photo";
    // $photo_dossier contien le chemain absolut de la photo dans notre dossier photo (vide de base)
        copy($_FILES['photo']['tmp_name'], $photo_dossier);
        // la fonction copy permet de copier la photo dans le dossier photo
    // ne pas oublier le enctype="multipart/form-data" dans le formulaire
        // pour le taitement des fichier medias

    }   

    $photo2_bdd = '';
    if(!empty($_FILES['photo2']['name'])){
        $nom_photo = $_POST['categorie'] . '_' . $_FILES['photo2']['name'] ;
        $photo2_bdd = URL . "photo/$nom_photo";
        $photo_dossier = RACINE_SITE . "photo/$nom_photo";
        copy($_FILES['photo2']['tmp_name'], $photo_dossier);
    }   

    date_default_timezone_set("Europe/Paris");
    

    $produit = new Produit([
        "id_utilisateur" => $_SESSION['utilisateur']['id_utilisateur'],
        "nom" => $_POST['nom'],
        "description" => $_POST['description'],
        "categorie"  =>  $_POST['categorie'],
        "photo" =>  $photo_bdd,
        "photo2" =>  $photo2_bdd,
        "date_creation" => date("Y-m-d H:i:s"),
        "prix" =>  $_POST['prix'],
    ]);
        //if(!$produit->isProduitValid()){
            //$produit->getErreurs();
       // }else{
            $produit_controller->inserer($produit);
            header('Location: gestionproduit.php');
     //   }

}
?>
<h1 class="text-center text-muted">Ajout produit</h1>
<section class="col-md-6 mx-auto m-1">

    <form method="post" action="" enctype="multipart/form-data">
        <label for="nom">Nom du produit</label>
        <input type="text" name="nom" id="nom" class="form-control" placeholder="Titre du produit"  value="">
        <label for="description">Description du produit</label>
        <textarea name="description" id="description" class="form-control" placeholder="Description du produit" required></textarea>

        <label for="categorie">Catégorie du produit</label>
        <select name="categorie" id="categorie" required  class="form-control">
            <option value="">Choisissez une catégorie</option>
            <option value="zen">Zen</option>
            <option value="oxygene">Oxygene</option>
            <option value="danse">Danse</option>
            <option value="energy">Energy</option>
        </select>

        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control" placeholder="Votre photo" required value="">

        <label for="photo2">Photo2</label>
        <input type="file" name="photo2" id="photo2" class="form-control" placeholder="Votre photo2" required value="">

        <label for="prix">Prix du produit</label>
        <input min="0" type="number" name="prix" id="prix" class="form-control" placeholder="Prix du produit" required value="">
        

        <button type="submit" class=" m-2 btn btn-dark">Ajouter</button>
    </form>
</section>

<?php require "structure/footer.php"; ?>