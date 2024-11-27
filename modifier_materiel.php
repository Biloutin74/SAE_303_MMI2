<?php
require("connexion.php");

function modifier_materiel(
    $id_materiel,
    $new_image_path,
    $new_image_size,
    $new_nom,
    $new_description,
    $new_etat,
    $new_categorie,
    $cacher,
    $supprimer
) {
    global $pdo;
    $max_file_size = 250000; // Taille maximale du fichier (250 Ko)
    $max_width = 1024; // Largeur maximale de l'image (1024 pixels)
    $max_height = 1024; // Hauteur maximale de l'image (1024 pixels);

    try {
        // Vérifier si le matériel existe
        $sql1 = "SELECT COUNT(*) FROM sae_303_materiel WHERE idmat = :id_materiel";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':id_materiel' => $id_materiel]);
        $count = (int) $stmt1->fetchColumn();

        if ($count == 0) {
            return "Erreur : Le matériel spécifiée n'existe pas.";
        }

        if ($new_categorie != "") {

            // Vérifier si la catégorie existe
            $sql2 = "SELECT idcat FROM sae_303_categorie WHERE nom = :new_categorie";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute([':new_categorie' => $new_categorie]);
            $new_categorie_id = $stmt2->fetchColumn();

            if (!$new_categorie_id) {
                return "Erreur : La catégorie spécifiée n'existe pas.";
            }
        }

        // Suppression du matériel si demandé
        if ($supprimer == 1) {
            $sql3 = "DELETE FROM sae_303_materiel WHERE idmat = :id_materiel";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->execute([':id_materiel' => $id_materiel]);
            return "Succès : Le matériel a été supprimée.";
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

        // Mise à jour du matériel
        $sql4 = "UPDATE sae_303_materiel SET image = COALESCE(:new_image_blob, image), nom = COALESCE(:new_nom, nom), description = COALESCE(:new_description, description), etat = COALESCE(:new_etat, etat), categorie_idcat = COALESCE(:new_categorie_id, categorie_idcat), visible = :visible WHERE idmat = :id_materiel";
        $stmt4 = $pdo->prepare($sql4);

        $stmt4->execute([
            ':new_image_blob' => $new_image_blob,
            ':new_nom' => $new_nom, 
            ':new_description' => $new_description,
            ':new_etat' => $new_etat,
            ':new_categorie_id' => $new_categorie_id,
            ':visible' => $cacher ? 0 : 1,
            ':id_materiel' => $id_materiel,
        ]);

        return "Succès : Le matériel a été mise à jour.";
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    }
}
?>