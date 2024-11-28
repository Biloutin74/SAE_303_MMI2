<?php
require("connexion.php");

function creer_categorie(
    $image_categorie_cree_path,
    $image_categorie_cree_size, 
    $nom_categorie_cree, 
    $description_categorie_cree
) {
    global $pdo;
    $max_file_size = 250000; // Taille maximale du fichier (250 Ko)
    $max_width = 1024; // Largeur maximale de l'image (1024 pixels)
    $max_height = 1024; // Hauteur maximale de l'image (1024 pixels);

    try{
        // Vérifie si une catégorie avec le même nom existe déjà
        $sql1 = "SELECT COUNT(*) FROM sae_303_categorie WHERE nom = :nom_categorie_cree";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':nom_categorie_cree' => $nom_categorie_cree]);
        $count = $stmt1->fetchColumn();

        if ($count > 0) {
            return "Erreur : Une catégorie avec ce nom existe déjà.";
        } else {

            // Traitement de l'image
            if ($image_categorie_cree_path) {
                if ($image_categorie_cree_size > $max_file_size) {
                    return "Erreur : L'image dépasse la taille maximale autorisée.";
                }

                $image_info = getimagesize($image_categorie_cree_path);
                if ($image_info[0] > $max_width || $image_info[1] > $max_height) {
                    return "Erreur : Les dimensions de l'image sont trop grandes.";
                }

                $image_categorie_cree_blob = file_get_contents($image_categorie_cree_path);
            } else {
                $image_categorie_cree_blob = null; // Garde l'image actuelle si aucune nouvelle image n'est fournie
            }

                // Insère une nouvelle catégorie
                $sql2 = "INSERT INTO sae_303_categorie (image, nom, description, url, visible) VALUES (:image_categorie_cree_blob, :nom_categorie_cree, :description_categorie_cree, :url_categorie_cree, :visible_categorie_cree)";
                $stmt2 = $pdo->prepare($sql2);

                $stmt2->execute([
                    ':image_categorie_cree_blob' => $image_categorie_cree_blob,
                    ':nom_categorie_cree' => $nom_categorie_cree,
                    ':description_categorie_cree' => $description_categorie_cree,
                    ':url_categorie_cree' => (string) "materiel.php",
                    ':visible_categorie_cree' => (int) 0,
                ]);

            return "Succès : La catégorie a été créée avec l'ID " . $pdo->lastInsertId();
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}
?>