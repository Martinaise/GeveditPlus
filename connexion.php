<?php require_once "structure/header.php"; ?>

<script language="javascript">
    document.title = "Connexion";
</script>

<?php
    
    require_once "entity/Utilisateur.php";
    require_once "entity/UtilisateursController.php";

$bddPDO = new PDO('mysql:host=localhost;dbname=gevedit', 'root', '' ,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        
    $utilisateur = new UtilisateursController($bddPDO);

    if($_POST){
        $utilisateur->login($_POST['email'], $_POST['mdp']);
        header('Location: profil.php');
    }
?>

<h1 class="text-center">Connexion</h1>
<section class="col-md-6 mx-auto">
    <form method="post">
        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" value="">
        </div>
        <div>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Votre mot de passe" value="">
        </div>
        <button type="submit" class="btn btn-dark mt-2">Connexion</button>
    </form>
</section>

<?php require_once "structure/footer.php"; ?>