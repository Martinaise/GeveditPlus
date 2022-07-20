<?php require 'structure/header.php' ?>

<?php


?>

    <section1 class="haut">
        <h1>Gevedit-Plus</h1>
        <p><strong>La solution de vente et d'achat de matériel d'occasion</strong></p>
        <div class="search">
            <form class="d-flex" method="get" action="/GeveditPlus/affichageproduit.php">
                <input class="form-control me-2" type="search" placeholder="Produits" aria-label="Search" name="recherche">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>

            <form class="d-flex" method="get" action="/GeveditPlus/affichageproduit.php">
                    <p class="affichePrix"></p>
                    <input type="range" placeholder="Rechercher par prix max" name="prix" value="<?= isset($_GET['prix']) ? $_GET['prix'] : '' ?>" min="0" max="5000">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>

        </div>
    </section1>

    <section2 class="categorie">
        <div class="flex-item" id="one">
           <a href="/GeveditPlus/affichageproduit.php?recherche=zen" target="_blank"><h4>Zen</h4></a>
        </div>
        <div class="flex-item" id="two">
            <a href="/GeveditPlus/affichageproduit.php?recherche=energy" target="_blank"><h4>Energie</h4></a>
        </div>
        <div class="flex-item" id="three">
            <a href="/GeveditPlus/affichageproduit.php?recherche=danse" target="_blank"><h4>Danse</h4></a>
        </div>
        <div class="flex-item" id="four">
            <a href="/GeveditPlus/affichageproduit.php?recherche=oxygene" target="_blank"><h4>Oxygène</h4></a>
        </div>
    </section2>


    <script>
    // afficher la valeur du prix de la bar range
    document.querySelector('.affichePrix').innerHTML = document.querySelector('input[type=range]').value + '€';
    document.querySelector('input[type=range]').addEventListener('input', function() {
        document.querySelector('.affichePrix').innerHTML = this.value + '€';
    });
    </script>



<?php require 'structure/footer.php' ?>