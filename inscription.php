<?php 
    require_once "entity/Utilisateur.php";
    require_once "entity/UtilisateursController.php"; ?>

    <script language="javascript">
        document.title = "Inscription";
    </script>
    
    <?php
    require_once "structure/header.php"; 
    
    //POUR wampp
    //definition de constante 
    //  define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/GeveditPlus/');
    //  define('URL','/GeveditPlus/');

    //POUR xampp
    // definition de constante 
    // define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/GeveditPlus/');
    // define('URL','http://localhost/GeveditPlus/');


    //Connexion à la BDD
    $bddPDO = new PDO('mysql:host=localhost;dbname=gevedit', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $controller = new UtilisateursController($bddPDO);

    if($_POST){

        // On filtre les données récupérées par le formulaire pour éviter les injections de code
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
            // fonction htmlentities qui permet de proteger des caracteres speciaux
            // ENT_QUOTES => retire les guillemets
            $_POST[$indice] = addslashes($valeur);
            // fonction addslashes qui permet d'ajouter des antislashes
        }
        
        // Essaie pour récupérer la photo
        $photo_bdd = '';
        if(!empty($_FILES['photo']['name'])){
        // si le champs photo n'est pas vide
        $nom_photo = $_POST['nom'] . '_' . $_FILES['photo']['name'] ;
        // $nom_photo contien la concatenation du nom utilisateur et du nom de la photo
        $photo_bdd = URL . "photo/$nom_photo";
        // $photo_bdd contient l'url de la photo (le chemin de la photo)
        $photo_dossier = RACINE_SITE . "photo/$nom_photo";
        // $photo_dossier contient le chemin absolu de la photo dans notre dossier photo (vide de base)
        copy($_FILES['photo']['tmp_name'], $photo_dossier);
        // la fonction copy permet de copier la photo dans le dossier photo
        // ne pas oublier le enctype="multipart/form-data" dans le formulaire
        // pour le traitement des fichier medias
        }

        // On précise le fuseau horaire qui servira à la date d'inscription
        date_default_timezone_set('Europe/Paris');
        
        $utilisateur = new Utilisateur([
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['code_postal'],
            'role' => $_POST['role'],
            'photo' => $photo_bdd,
            'mdp' => $_POST['mdp'],
            'date_inscription' => date('Y-m-d H:i:s'),
        ]);

        if($utilisateur->isUserValid()){
            $controller->insert($utilisateur);
            header('Location: connexion.php');
        } 
   
    }   

?>


<section class="container col-md-6 mx-auto m-1">
    <h1 class="text-center">Inscription</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">         
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
        </div>    
        <div class="mb-3">          
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="nom" name="prenom" placeholder="Votre prénom">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse email">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Tel</label>
            <input type="text" class="form-control" id="tel" name="tel" placeholder="Votre numéro de téléphone">
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Votre adresse">
        </div>
        <div class="mb-3">
            <label for="code_postal" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Votre code postal">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Statut</label>
            <select name="role" id="role">
                <option value="">--Choississez votre statut</option>
                <option value="club">Club</option>
                <option value="internaute">Internaute</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" placeholder="Votre photo">
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Choississez un mot de passe sûr">
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</section>
<?php require_once "structure/footer.php"; ?>
