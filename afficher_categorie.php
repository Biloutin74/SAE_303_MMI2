<?php
require("connexion.php");

function afficher_image_categorie (

    ) {
        global $pdo;
    
        try{
    
            $sql = "SELECT idcat, image, nom, url FROM sae_303_categorie";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $categories = [];

            while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = [
                    'idcat' => (int) $donnees['idcat'],
                    'image_base64' => base64_encode($donnees['image']),
                    'nom' => (string) $donnees['nom'],
                    'url' => (string) $donnees['url'],
                ];
            }
    
            // print_r($categories);
            return $categories;
    
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
?>