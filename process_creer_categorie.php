<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require("creer_categorie.php");

        $image_categorie_cree_path = $_FILES['image_categorie_cree']['tmp_name'];
        $image_categorie_cree_size = filesize($image_categorie_cree_path); // Taille du fichier
        $nom_categorie_cree = $_POST['nom_categorie_cree'];
        $description_categorie_cree = $_POST['description_categorie_cree'];


        $result = creer_categorie(
            $image_categorie_cree_path,
            $image_categorie_cree_size, 
            $nom_categorie_cree, 
            $description_categorie_cree
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
    <title>creer_categorie</title>
</head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">

            <label>Créer une catégorie</label><br>

            <label for="image">Image :</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000">
            <input type="file" id="image_categorie_cree" name="image_categorie_cree" accept="image/*"><br>

            <label for="nom">Nom:</label><br>
            <input type="text" id="nom_categorie_cree" name="nom_categorie_cree" required><br>

            <label for="description">Description:</label><br>
            <input type="text" id="description_categorie_cree" name="description_categorie_cree"><br>

            <input type="submit" value="Créer"><br>

        </form> 
    </body>
</html>