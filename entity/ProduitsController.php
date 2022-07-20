<?php

class ProduitsController{
     
    // creation d une variable qui va contenir la connexion a la bdd

    private $bddPDO;

    // ont initialise la connexion a la bdd
    public function __construct(PDO $bddPDO)
    {
        $this->bddPDO = $bddPDO;
    }

    // creation d une fonction qui va permettre d ajouter un produit
    public function inserer(Produit $produit)
    {
       // inval convertit le string en int
        $inval = intval($_SESSION['utilisateur']['id_utilisateur']);
          // preparation de la requete
        $requete = $this->bddPDO->prepare('INSERT INTO produits(id_utilisateur, nom, description, categorie, photo, photo2, date_creation, prix) VALUES(:id_utilisateur, :nom, :description, :categorie, :photo, :photo2, :date_creation, :prix)');
        // assignation des marqueures de la requete aux attributs de l produit donné en parametre
    
    
        $requete->bindValue(':id_utilisateur', $inval);
        $requete->bindValue(':nom', $produit->getNom());
        $requete->bindValue(':description', $produit->getDescription());
        $requete->bindValue(':categorie', $produit->getCategorie());
        $requete->bindValue(':photo', $produit->getPhoto());
        $requete->bindValue(':photo2', $produit->getPhoto2());
        $requete->bindValue(':date_creation', $produit->getDate_creation());
        $requete->bindValue(':prix', $produit->getPrix());
        // execution de la requete
       
        $requete->execute();

        
    }

    // creation d une fonction qui va permettre de recuperer un produits
    public function afficherListProduits()
    {
        // preparation de la requete
        $requete = $this->bddPDO->query('SELECT * FROM produits ORDER BY  id_produit DESC ' );
        // execution de la requete
        $requete->execute();
        // on recupere les données de la requete
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
        // on retourne les données
        return $donnees;
    }

    public function rechercherProduits($recherche){
        // preparation de la requete
        $requete = $this->bddPDO->prepare('SELECT * FROM produits WHERE nom LIKE :recherche OR categorie LIKE :recherche');
        $requete->bindValue(':recherche', '%'.$recherche.'%');
        $requete->execute();
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $donnees;
    }

    public function rechercherProduitsParPrix($prix){
        $requete = $this->bddPDO->prepare('SELECT * FROM produits WHERE prix <= :prix');
        $requete->bindValue(':prix', $prix);
        $requete->execute();
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $donnees;
    }

    // creation d une fonction qui va permettre de recuperer un produit par son id

    public function afficherProduitParId($id_produit)
    {
        // preparation de la requete
        $requete = $this->bddPDO->prepare('SELECT * FROM produits WHERE id_produit = :id_produit');
        // assignation des marqueures de la requete aux attributs de l produit donné en parametre
        $requete->bindValue(':id_produit', $id_produit);
        // execution de la requete
        $requete->execute();
        // on recupere les données de la requete
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        // on retourne les données
        return $donnees;
    }


    // creation d une fonction qui va permettre de modifier un produit par son id est

    public function modifierProduitParId(Produit $produit)
    {
        // preparation de la requete
        $requete = $this->bddPDO->prepare('UPDATE produits SET nom = :nom, description = :description, categorie = :categorie, photo = :photo, photo2 = :photo2, date_creation = :date_creation, prix = :prix WHERE id_produit = :id_produit');
        // assigiassion des marqueures de la requete aux attributs de l produit donné en parametre
        $requete->bindValue(':id_produit', $produit->getId_produit());
        $requete->bindValue(':nom', $produit->getNom());
        $requete->bindValue(':description', $produit->getDescription());
        $requete->bindValue(':categorie', $produit->getCategorie());
        $requete->bindValue(':photo', $produit->getPhoto());
        $requete->bindValue(':photo2', $produit->getPhoto2());
        $requete->bindValue(':date_creation', $produit->getDate_creation());
        $requete->bindValue(':prix', $produit->getPrix());
        // execution de la requete
        $requete->execute();
    }

    // creation d une fonction qui va permettre de supprimer un produit par son id

    public function supprimerProduitParId($id_produit)
    {
        // preparation de la requete
        $requete = $this->bddPDO->prepare('DELETE FROM produits WHERE id_produit = :id_produit');
        // assigiassion des marqueures de la requete aux attributs de l produit donné en parametre
        $requete->bindValue(':id_produit', $id_produit);
        // execution de la requete
        $requete->execute();
    }
}
    