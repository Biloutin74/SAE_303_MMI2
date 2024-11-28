<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require("modifier_materiel.php");

        $id_materiel = $_POST['id_materiel'];
        $new_image_path = $_FILES['new_image']['tmp_name'];
        $new_image_size = filesize($new_image_path); // Taille du fichier
        $new_nom = $_POST['new_nom'];
        $new_description = $_POST['new_description'];
        $new_url = $_POST['new_url'];
        $new_etat = $_POST['new_etat'];
        $new_categorie = $_POST['new_categorie'];
        $cacher = $_POST['value_cacher'];
        $supprimer = $_POST['value_supprimer'];

        $result = modifier_materiel(
            $id_materiel,
            $new_image_path,
            $new_image_size,
            $new_nom,
            $new_description,
            $new_url,
            $new_etat,
            $new_categorie,
            $cacher,
            $supprimer
        );
        
        echo $result;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel = "stylesheet" href = "css/style_form.css">-->
    <title>modifier_materiel</title>
</head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">

            <label>Modifier un matériel</label><br>

            <label for="id">Id :</label><br>
            <input type="text" id="id_materiel" name="id_materiel" required><br>

            <label for="image">Nouvelle Image :</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000">
            <input type="file" id="new_image" name="new_image" accept="image/*"><br>

            <label for="nom_modif">Nouveau Nom :</label><br>
            <input type="text" id="new_nom" name="new_nom"><br>

            <label for="description_modif">Nouvelle Description :</label><br>
            <input type="text" id="new_description" name="new_description"><br>

            <label for="url_modif">Nouvelle URL :</label><br>
            <input type="text" id="new_url" name="new_url"><br>

            <label for="etat_modif">Nouvel État :</label><br>
            <select name="new_etat" id="new_etat">
                <option value="disponible">Disponible</option>
                <option value="réservé">Réservé</option>
                <option value="en maintenance">En Maintenance</option>
            </select><br>

            <label for="categorie_modif">Nouvelle Catégorie :</label><br>
            <input type="text" id="new_categorie" name="new_categorie"><br>

            <label for="cacher">Cacher</label>
            <input type="checkbox" id="value_cacher" name="value_cacher" value="1"><br>

            <label for="supprimer">Supprimer</label>
            <input type="checkbox" id="value_supprimer" name="value_supprimer" value="1"><br>

            <input type="submit" value="Modifier"><br>

        </form> 
    </body>
</html>