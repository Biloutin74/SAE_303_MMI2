<?php
require("connexion.php");

function modifier_categorie(
    $nom_categorie,
    $new_image_path,
    $new_image_size,
    $new_nom,
    $new_description,
    $cacher,
    $supprimer
) {
    global $pdo;
    $max_file_size = 250000; // Taille maximale du fichier (250 Ko)
    $max_width = 1024; // Largeur maximale de l'image (1024 pixels)
    $max_height = 1024; // Hauteur maximale de l'image (1024 pixels);

    try {
        // Vérifier si la catégorie existe
        $sql1 = "SELECT idcat FROM sae_303_categorie WHERE nom = :nom_categorie";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':nom_categorie' => $nom_categorie]);
        $categorie_id = $stmt1->fetchColumn();

        if (!$categorie_id) {
            return "Erreur : La catégorie spécifiée n'existe pas.";
        }

        // Suppression de la catégorie si demandé
        if ($supprimer == 1) {
            $sql2 = "DELETE FROM sae_303_categorie WHERE idcat = :categorie_id";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute([':categorie_id' => $categorie_id]);
            return "Succès : La catégorie a été supprimée.";
        }

        // Traitement de l'image
        if ($new_image_path) {
            if ($new_image_size > $max_file_size) {
                return "Erreur : L'image dépasse la taille maximale autorisée.";
            }

            $image_info = getimagesize($new_image_path);
            if ($image_info[0] > $max_width || $image_info[1] > $max_height) {
                return "Erreur : Les dimensions de l'image sont trop grandes.";
            }

            $new_image_blob = file_get_contents($new_image_path);
        } else {
            $new_image_blob = null; // Garde l'image actuelle si aucune nouvelle image n'est fournie
        }

        // Mise à jour de la catégorie
        $sql3 = "UPDATE sae_303_categorie SET image = COALESCE(:new_image_blob, image), nom = COALESCE(:new_nom, nom), description = COALESCE(:new_description, description), visible = :visible WHERE idcat = :categorie_id";
        $stmt3 = $pdo->prepare($sql3);

        $stmt3->execute([
            ':new_image_blob' => $new_image_blob,
            ':new_nom' => $new_nom, 
            ':new_description' => $new_description,
            ':visible' => $cacher ? 0 : 1,
            ':categorie_id' => $categorie_id,
        ]);

        return "Succès : La catégorie a été mise à jour.";
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}
?>