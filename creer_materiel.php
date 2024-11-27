<?php
require("connexion.php");

function creer_materiel(
    $image_materiel_cree_path,
    $image_materiel_cree_size,
    $nom_materiel_cree, 
    $description_materiel_cree, 
    $categorie_materiel_cree
) {
    global $pdo;
    $max_file_size = 250000; // Taille maximale du fichier (250 Ko)
    $max_width = 1024; // Largeur maximale de l'image (1024 pixels)
    $max_height = 1024; // Hauteur maximale de l'image (1024 pixels);

    try {
        // Vérifie si la catégorie existe et récupère son ID
        $sql1 = "SELECT idcat FROM sae_303_categorie WHERE nom = :categorie_materiel_cree";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':categorie_materiel_cree' => $categorie_materiel_cree]);
        $categorie_id = $stmt1->fetchColumn();

        if (!$categorie_id) {
            return "Erreur : Cette catégorie n'existe pas.";
        }

        // Traitement de l'image
        if ($image_materiel_cree_path) {
            if ($image_materiel_cree_size > $max_file_size) {
                return "Erreur : L'image dépasse la taille maximale autorisée.";
            }

            $image_info = getimagesize($image_materiel_cree_path);
            if ($image_info[0] > $max_width || $image_info[1] > $max_height) {
                return "Erreur : Les dimensions de l'image sont trop grandes.";
            }

            $image_materiel_cree_blob = file_get_contents($image_materiel_cree_path);
        } else {
            $image_materiel_cree_blob = null; // Garde l'image actuelle si aucune nouvelle image n'est fournie
        }

        // Insère un nouveau matériel
        $sql2 = "INSERT INTO sae_303_materiel (image, nom, description, categorie_idcat) VALUES (:image_materiel_cree_blob, :nom_materiel_cree, :description_materiel_cree, :categorie_id)";
        $stmt2 = $pdo->prepare($sql2);

        $stmt2->execute([
            ':image_materiel_cree_blob' => $image_materiel_cree_blob,
            ':nom_materiel_cree' => $nom_materiel_cree,
            ':description_materiel_cree' => $description_materiel_cree,
            ':categorie_id' => $categorie_id,
        ]);

        return "Succès : Le matériel a été créé avec l'ID " . $pdo->lastInsertId();
        return "Il est caché et en maintenance par défaut";

    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}
?>