<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require("creer_materiel.php");

        $image_materiel_cree_path = $_FILES['image_materiel_cree']['tmp_name'];
        $image_materiel_cree_size = filesize($image_materiel_cree_path); // Taille du fichier
        $nom_materiel_cree = $_POST['nom_materiel_cree'];
        $description_materiel_cree = $_POST['description_materiel_cree'];
        $categorie_materiel_cree = $_POST['categorie_materiel_cree'];


        $result = creer_materiel(
            $image_materiel_cree_path,
            $image_materiel_cree_size, 
            $nom_materiel_cree, 
            $description_materiel_cree,
            $categorie_materiel_cree
        );
        
        echo $result;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel = "stylesheet" href = "css/style_form.css">-->
    <title>creer_materiel</title>
</head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">

            <label>Créer un matériel</label><br>

            <label for="image">Image :</label><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000">
            <input type="file" id="image_materiel_cree" name="image_materiel_cree" accept="image/*"><br>

            <label for="nom">Nom:</label><br>
            <input type="text" id="nom_materiel_cree" name="nom_materiel_cree" required><br>

            <label for="description">Description:</label><br>
            <input type="text" id="description_materiel_cree" name="description_materiel_cree"><br>

            <label for="categorie">Catégorie:</label><br>
            <input type="text" id="categorie_materiel_cree" name="categorie_materiel_cree" required><br>

            <p>Le matériel créé sera en maintenance et non-visible par défaut</p>

            <input type="submit" value="Créer"><br>

        </form> 
    </body>
</html>