<?php

class UtilisateursController{
     
    // creation d une variable qui va contenir la connexion a la bdd

    private $bddPDO;

    // On initialise la connexion a la bdd
    public function __construct(PDO $bddPDO)
    {
        $this->bddPDO = $bddPDO;
    }

    public function login($email,$mdp)
    {
        
        session_start();
     
        $connex = $this->bddPDO->query("SELECT * FROM utilisateurs WHERE email = '$email'");
     

        if($connex->rowCount() > 0){
            $utilisateur = $connex->fetch(PDO::FETCH_ASSOC);
            if(password_verify($mdp, $utilisateur['mdp'])){
                $_SESSION['utilisateur']['id_utilisateur'] = $utilisateur['id_utilisateur'];
                $_SESSION['utilisateur']['nom'] = $utilisateur['nom'];
                $_SESSION['utilisateur']['prenom'] = $utilisateur['prenom'];
                $_SESSION['utilisateur']['email'] = $utilisateur['email'];
                $_SESSION['utilisateur']['tel'] = $utilisateur['tel'];
                $_SESSION['utilisateur']['adresse'] = $utilisateur['adresse'];
                $_SESSION['utilisateur']['code_postal'] = $utilisateur['code_postal'];
                $_SESSION['utilisateur']['photo'] = $utilisateur['photo'];
                $_SESSION['utilisateur']['role'] = $utilisateur['role'];
                $_SESSION['utilisateur']['date_inscription'] = $utilisateur['date_inscription'];
                if($utilisateur['role'] == 'admin'){
                    header('Location: backoffice.php');
                }else{
                    header('Location: index.php');
                }
            }
        }
    }

    // creation d une fonction qui va permettre d ajouter un utilisateur

    public function insert(Utilisateur $utilisateur)
    {   // preparation de la requete
        $requete = $this->bddPDO->prepare('INSERT INTO utilisateurs(nom, prenom, tel, email, adresse, code_postal, photo, mdp, role, date_inscription) VALUES(:nom, :prenom, :tel, :email, :adresse, :code_postal, :photo, :mdp, :role, :date_inscription)');
        // assignation des marqueures de la requete aux attributs de l utilisateur donné en parametre

        $requete->bindValue(':nom', $utilisateur->getNom());
        $requete->bindValue(':prenom', $utilisateur->getPrenom());
        $requete->bindValue(':tel', $utilisateur->getTel());
        $requete->bindValue(':email', $utilisateur->getEmail());
        $requete->bindValue(':adresse', $utilisateur->getAdresse());
        $requete->bindValue(':code_postal', $utilisateur->getCode_postal());
        $requete->bindValue(':photo', $utilisateur->getPhoto());
        $requete->bindValue(':mdp', $utilisateur->getMdp());
        $requete->bindValue(':role', $utilisateur->getRole());
        $requete->bindValue(':date_inscription', $utilisateur->getDate_inscription());
        // execution de la requete
        $requete->execute();
    }


    // creation d une fonction qui va permettre de recuperer un utilisateurs

    public function afficherListUtilisateurs()
    {
        // preparation de la requete
        $requete = $this->bddPDO->query('SELECT * FROM utilisateurs ORDER BY  id_utilisateur DESC ' );
        // execution de la requete
        $requete->execute();
        // on recupere les données de la requete
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);
        // on retourne les données
        return $donnees;
    }

    // creation d une foncion qui va permettre de recuperer un utilisatur par son id

    public function afficherUtilisateurParId($id_utilisateur)
    {
        // preparation de la requete
        $requete = $this->bddPDO->prepare('SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
        // assignation des marqueures de la requete aux attributs de l utilisateur donné en parametre
        $requete->bindValue(':id_utilisateur', $id_utilisateur);
        // execution de la requete
        $requete->execute();
        // on recupere les données de la requete
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        // on retourne les données
        return $donnees;
    }

    // creation d une fonction qui va permettre de modifier un utilisateur par son id est

    public function modifierUtilisateurParId(Utilisateur $utilisateur)
    {
       
        // preparation de la requete
        $requete = $this->bddPDO->prepare('UPDATE utilisateurs SET nom = :nom, prenom = :prenom, tel = :tel, email = :email, adresse = :adresse, code_postal = :code_postal, photo = :photo, mdp = :mdp, role = :role WHERE id_utilisateur = :id_utilisateur');
        // assigiassion des marqueures de la requete aux attributs de l utilisateur donné en parametre
        $requete->bindValue(':id_utilisateur', $utilisateur->getId_utilisateur());
        $requete->bindValue(':nom', $utilisateur->getNom());
        $requete->bindValue(':prenom', $utilisateur->getPrenom());
        $requete->bindValue(':tel', $utilisateur->getTel());
        $requete->bindValue(':email', $utilisateur->getEmail());
        $requete->bindValue(':adresse', $utilisateur->getAdresse());
        $requete->bindValue(':code_postal', $utilisateur->getCode_postal());
        $requete->bindValue(':photo', $utilisateur->getPhoto());
        $requete->bindValue(':mdp', $utilisateur->getMdp());
        $requete->bindValue(':role', $utilisateur->getRole());
        // $requete->bindValue(':date_inscription', $utilisateur->getDate_inscription());
        // execution de la requete
        $requete->execute();
    }

    // creation d une fonction qui va permettre de supprimer un utilisateur par son id

    public function supprimerUtilisateurParId($id_utilisateur)
    {
        // preparation de la requete
        $requete = $this->bddPDO->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur');
        // assigiassion des marqueures de la requete aux attributs de l utilisateur donné en parametre
        $requete->bindValue(':id_utilisateur', $id_utilisateur);
        // execution de la requete
        $requete->execute();
    }
}
    







