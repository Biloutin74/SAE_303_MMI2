<?php
require("connexion.php");

function afficher_utilisateur (

    ) {
        global $pdo;

        try{

            $sql1 = "SELECT * from sae_303_utilisateur";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute();
            
            $utilisateurs = [];

            while ($donnees1 = $stmt1->fetch(PDO::FETCH_ASSOC)) { // Récupère chaque ligne sous forme de tableau associatif
                $utilisateurs[] = [
                    'iduser' => (int)$donnees1['iduser'],
                    'nom' => $donnees1['nom'], 
                    'prenom' => $donnees1['prenom'],
                    'mdpIUT' => $donnees1['mdpIUT'], 
                    'mail' => $donnees1['mail'],
                    'annee' => (int)$donnees1['annee'],
                    'admin' => (int)$donnees1['admin'],
                    'caution' => (int)$donnees1['caution']
                ];
            }

            // print_r($utilisateurs);
            return "Voici la table des utilisateurs.";
            print_r($utilisateurs);

        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

function afficher_materiel (

    ) {
        global $pdo;
    
        try{
    
            $sql2 = "SELECT * from sae_303_materiel";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute();
            
            $materiels = [];

            while ($donnees2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $materiels[] = [
                    'idmat' => (int)$donnees2['idmat'],
                    'image_base64' => base64_encode($donnees2['image']),
                    'nom' => $donnees2['nom'], 
                    'description' => $donnees2['description'],
                    'etat' => $donnees2['etat'], 
                    'visible' => (int)$donnees2['visible'],
                    'categorie_idcat' => (int)$donnees2['categorie_idcat']
                ];
            }
    
            // print_r($materiels);
            return "Voici la table des materiels.";
            print_r($materiels);
    
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

function afficher_reservation (

    ) {
        global $pdo;
        
        try{
        
            $sql3 = "SELECT * from sae_303_reservation";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->execute();
            
            $reservations = [];

            while ($donnees3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                $reservations[] = [
                    'idreservation' => (int)$donnees3['idreservation'],
                    'date_debut' => $donnees3['date_debut'],
                    'date_fin' => $donnees3['date_fin'],
                    'etat' => $donnees3['etat'],
                    'utilisateur_iduser' => (int)$donnees3['utilisateur_iduser'],
                    'materiel_idmat' => (int)$donnees3['materiel_idmat']
                ];
            }
        
            // print_r($reservations);
            return "Voici la table des réservations.";
            print_r($reservations);
        
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

function afficher_categorie (

    ) {
        global $pdo;
            
        try{
            
            $sql4 = "SELECT * from sae_303_categorie";
            $stmt4 = $pdo->prepare($sql4);
            $stmt4->execute();
            
            $categories = [];

            while ($donnees4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = [
                    'idcat' => (int)$donnees4['idcat'],
                    'image_base64' => base64_encode($donnees4['image']),
                    'nom' => $donnees4['nom'],
                    'description' => $donnees4['description'],
                    'visible' => (int)$donnees4['visible']
                ];
            }
            
            // print_r($categories);
            return "Voici la table des catégories.";
            print_r($categories);
            
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
?>