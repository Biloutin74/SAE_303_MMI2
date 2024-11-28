<?php
require("connexion.php");

function afficher_materiel (

    ) {
        global $pdo;
    
        try{
    
            $sql = "SELECT idmat, image, nom, description, url, categorie_idcat FROM sae_303_materiel";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $materiels = [];

            while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $materiels[] = [
                    'idmat' => (int) $donnees['idmat'],
                    'image_base64' => base64_encode($donnees['image']),
                    'nom' => (string) $donnees['nom'],
                    'description' => (string) $donnees['description'],
                    'url' => (string) $donnees['url'],
                    'idcat' => (int) $donnees['categorie_idcat']
                ];
            }
    
            // print_r($materiels);
            return $materiels;
    
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
?>