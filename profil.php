<?php
require_once "structure/header.php";
require_once "entity/Utilisateur.php";
require_once "entity/UtilisateursController.php";?>

<script language="javascript">
    document.title = "Profil";
</script>

<?php

// session_start();


// Action de suppression du profil
// $resultat = $pdo->query("SELECT * FROM utilisateurs WHERE id_utilisateur = $_GET[id]");
// $utilisateur = $resultat->fetch(PDO::FETCH_ASSOC);

// if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
//     $pdo->query('DELETE FROM utilisateurs WHERE id_utilisateur = ' .$_GET['id']);
//     header('location:espaceprofil.php');
// }

?>

<h1 class="text-center text-muted">Bienvenue sur votre profil<?= " " . $_SESSION['utilisateur']['nom'] ." ". $_SESSION['utilisateur']['prenom'] ?></h1>
<hr>

<div class="d-flex justify-content-center">
    <?php  echo ("<div style='width:100px;height:100px;border-radius:50%;background-image:url(".$_SESSION['utilisateur']['photo'].");background-size:cover;background-position:center;background-repeat:no-repeat;'></div>")?>
</div>

Voici vos informations: <br/>

Votre nom: <?= $_SESSION['utilisateur']['nom'] ?> <br/>
Votre prenom: <?= $_SESSION['utilisateur']['prenom'] ?> <br/>
Votre email: <?= $_SESSION['utilisateur']['email'] ?> <br/>
Votre tel: <?= $_SESSION['utilisateur']['tel'] ?> <br/>
Votre adresse: <?= $_SESSION['utilisateur']['adresse'] ?> <br/>
Votre code_postal: <?= $_SESSION['utilisateur']['code_postal'] ?> <br/>


<a href="modificationprofil.php?id_utilisateur=<?= $_SESSION['utilisateur']['id_utilisateur']?>">Modifier mon profil</a> 
<br>
<a href="creationproduit.php">Ajout produit</a> 

<!-- ------------------------------------------------------------------------------------- -->
<!-- Modification et suppression du profil a voir -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Attention cette action et irreversible !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                etes vous sur de vouloir supprimer <?=  $_SESSION['utilisateur']['nom'] ?> <?=  $_SESSION['utilisateur']['prenom'] ?> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <?php echo "<a class='btn btn-danger' href='?action=suppression&id_utilisateur=" . $_SESSION['utilisateur']['id_utilisateur']."'>Supprimer</a>"; ?>
            </div>
        </div>
    </div>
</div>

<?php require 'structure/footer.php' ?>