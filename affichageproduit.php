<?php
    require "entity/Produit.php";
    require "entity/ProduitsController.php";

    $bddPDO = new pdo('mysql:host=localhost;dbname=gevedit', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $controller = new ProduitsController($bddPDO);


 
    if(isset($_GET["recherche"])){
        $produits = $controller->rechercherProduits($_GET["recherche"]);
    }elseif(isset($_GET["prix"])){
        $produits = $controller->rechercherProduitsParPrix($_GET["prix"]);
    }else{
        $produits = $controller->afficherListProduits();
    }

?>

<?php require_once "structure/header.php"; ?>
<section1 class="haut">
    <h1>Gevedit-Plus</h1>
    <p><strong>La solution de vente et d'achat de matériel d'occasion</strong></p>
    <div class="search">
        <form class="d-flex" method="get">
            <input name="recherche" class="form-control me-2" type="search" placeholder="Produits ou catégories" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
        <form class="d-flex" method="get">
                <p class="affichePrix"></p>
                <input type="range" placeholder="Rechercher par prix max" name="prix" value="<?= isset($_GET['prix']) ? $_GET['prix'] : '' ?>" min="0" max="5000">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
    </div>
</section1>

<section class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nom :</th>
        <th scope="col">Description :</th>
        <th scope="col">Catégorie :</th>
        <th scope="col">Prix :</th>
        <th scope="col">Photo :</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($produits as $result) {
        echo '<tr>';
        echo '<th scope="row">' . $result['nom'] . '</th>';
        echo '<td>' . $result['description'] . '</td>';
        echo '<td>' . $result['categorie'] . '</td>';
        echo '<td>' . $result['prix'] . '€</td>';
        echo "<td><div style='width:50px;height:50px;border-radius:50%;background-image:url($result[photo]);background-size: cover;background-repeat:no-repeat;background-position:center'></div></td>";
        echo "<td><div style='width:50px;height:50px;border-radius:50%;background-image:url($result[photo2]);background-size: cover;background-repeat:no-repeat;background-position:center'></div></td>";
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</section>

<script>
// afficher la valeur du prix de la bar range
document.querySelector('.affichePrix').innerHTML = document.querySelector('input[type=range]').value + '€';
document.querySelector('input[type=range]').addEventListener('input', function() {
    document.querySelector('.affichePrix').innerHTML = this.value + '€';
});
</script>

<?php require_once "structure/footer.php"; ?>