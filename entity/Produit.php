<?php

class Produit{

    private $erreurs = [];

    private $id_produit;
    private $id_utilisateur;
    private $nom;
    private $description;
    private $categorie;
    private $photo;
    private $photo2;
    private $date_creation;
    private $prix;

    // creation de constantes d invalidité
    const NOM_INVALIDE = 1;
    const DESCRIPTION_INVALIDE = 2;
    const PRIX_INVALIDE = 3;

        // creation du constructeur de
    public function __construct(array $donnees)
    {
        // ont passe la fonction hydrater au constructeur si  la variable donnees n es pas vide
        // utile pour eviter d ecrire chaque setteur dans le constructeur
        if (!empty($donnees)) {
            $this->hydrater($donnees);
        }
    }

    // creation d une fonction hydrater quon verra a la fin 
    // cette fonction sert a hydrater les données de l produit c'est a dire de remplir les attributs de l produit
    public function hydrater($donnees)
    {
        // ont parcour les données
        foreach ($donnees as $attribut => $valeur) {
            // ont cree une variable qui va contenir la concatenation du mot 'set' + le nom de l attribut avec la premiere letrre en majuscule grace a ucfirst()
            $methodeSetters = 'set' . ucfirst($attribut);
            $this->$methodeSetters($valeur);
        }
    }

// SETTERS AND GETTERS

 // creation des setters
    public function setId_produit($id_produit)
    {
        // verification: si l id n' es pas vide
        if (!empty($id_produit)) {
            $this->id_produit = (int) $id_produit;
        }
    }

    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = (int) $id_utilisateur;
    }

    public function setNom($nom)
        {
            if (!empty($nom) && is_string($nom)) {
                $this->nom = $nom;
            } else {
                // self fait reference a la classe
                // si le paramettre n'es pas une chaine de carractere on ajoute une erreur dans notre tableau d'erreur
                $this->erreurs[] = self::NOM_INVALIDE;
            }
        }

    public function setDescription($description)
    {
        if (!empty($description) && is_string($description)) {
            $this->description = $description;
        } else {
            // self fait reference a la classe
            // si le paramettre n'es pas une chaine de carractere on ajoute une erreur dans notre tableau d'erreur
            $this->erreurs[] = self::description_INVALIDE;
        }
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }

    public function setPhoto2($photo2){
        $this->photo2 = $photo2;
    }

    public function setDate_creation($date_creation){
        $this->date_creation = $date_creation;
    }

    public function setPrix($prix){
        $this->prix = $prix;
    }


    // creation des getters
    public function getId_produit()
    {
        return $this->id_produit;
    }

    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPhoto()
    {
        return $this->photo;
    }
    
    public  function getPhoto2() {
        return $this->photo2;
    }

    public  function getCategorie() {
        return $this->categorie;
    } 

    public  function getDate_creation() {
        return $this->date_creation;
    }

    public  function getPrix() {
        return $this->prix;
    }

    // creation de la methodes erreurs
    public function getErreurs()
    {
        return $this->erreurs;
    }

    // creation de la fonction qui verifie si l produit et valide ou non est pas
    public function isProduitValid()
    {
        // verification: si le tableau d'erreur est vide
        return empty($this->erreurs);
    }
}