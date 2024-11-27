<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require("modifier_categorie.php");

        $nom_categorie = $_POST['nom_categorie'];
        $new_image_path = $_FILES['new_image']['tmp_name'];
        $new_image_size = filesize($new_image_path); // Taille du fichier
        $new_nom = $_POST['new_nom'];
        $new_description = $_POST['new_description'];
        $cacher = $_POST['value_cacher'];
        $supprimer = $_POST['value_supprimer'];

        $result = modifier_categorie(
            $nom_categorie,
            $new_image_path,
            $new_image_size,
            $new_nom,
            $new_description,
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
    <title>modifier_categorie</title>
</head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">

            <label>Modifier une catégorie</label><br>

            <label for="nom">Nom :</label><br>
            <input type="text" id="nom_categorie" name="nom_categorie" required><br>

            <label for="image">Nouvelle Image :</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000">
            <input type="file" id="new_image" name="new_image" accept="image/*"><br>

            <label for="nom_modif">Nouveau Nom :</label><br>
            <input type="text" id="new_nom" name="new_nom"><br>

            <label for="description_modif">Nouvelle Description :</label><br>
            <input type="text" id="new_description" name="new_description"><br>

            <label for="cacher">Cacher</label>
            <input type="checkbox" id="value_cacher" name="value_cacher" value="1"><br>

            <label for="supprimer">Supprimer</label>
            <input type="checkbox" id="value_supprimer" name="value_supprimer" value="1"><br>

            <input type="submit" value="Modifier"><br>

        </form> 
    </body>
</html>