<?php

class Utilisateur{

    private $erreurs = [];

    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $photo;
    private $tel;
    private $adresse;
    private $code_postal;
    private $mdp;
    private $role;
    private $date_inscription;

    // creation de constantes d invalidité
    const NOM_INVALIDE = 1;
    const PRENOM_INVALIDE = 2;
    const EMAIL_INVALIDE = 3;

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
    // cette fonction sert a hydrater les données de l utilisateur c'est a dire de remplir les attributs de l utilisateur
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
    public function setId_utilisateur($id_utilisateur)
    {
        // verification: si l id n' es pas vide
        if (!empty($id_utilisateur)) {
            $this->id_utilisateur = (int) $id_utilisateur;
        }
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

    public function setPrenom($prenom)
    {
        if (!empty($prenom) && is_string($prenom)) {
            $this->prenom = $prenom;
        } else {
            // self fait reference a la classe
            // si le paramettre n'es pas une chaine de carractere on ajoute une erreur dans notre tableau d'erreur
            $this->erreurs[] = self::PRENOM_INVALIDE;
        }
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception("L'email n'est pas valide");
        };
    } 
    
    // le cryptage du mot de passe se fait dans le setter
    // la fonction password_hash permet de crypter le mot de passe
    public function setMdp($mdp) {
        $this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }

    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }

    public function setCode_postal($code_postal){
        $this->code_postal = $code_postal;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function setDate_inscription($date_inscription){
        $this->date_inscription = $date_inscription;
    }


    // creation des getters
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getMdp() {
        return $this->mdp;
    } 

    public  function getPhoto() {
        return $this->photo;
    } 
    public  function getAdresse() {
        return $this->adresse;
    }

    public  function getCode_postal() {
        return $this->code_postal;
    }

    public  function getRole() {
        return $this->role;
    }

    public  function getDate_inscription() {
        return $this->date_inscription;
    }

    // creation de la methodes erreurs
    public function getErreurs()
    {
        return $this->erreurs;
    }

    // creation de la fonction qui verifie si l utilisateur et valide ou non est pas
    public function isUserValid()
    {
    // verification: si le tableau d'erreur est vide
        return empty($this->erreurs);
    }
}