<?php
    require("afficher_materiel.php");

    $donnees = afficher_camera();
      
    // print_r($donnees);

    $url_id_cat = null;
    if (isset($_GET['id'])) {
        $url_id_cat = htmlspecialchars($_GET['id']); // Sécurisation avec htmlspecialchars
        echo "Id catégorie : $url_id_cat<br>";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Grille</title>
    <link rel="stylesheet" href="css/page_cameras.css">
</head>
<body>
    <!-- En-tête de la page -->
    <header>
        <nav>
            <a href="reservation.html" class="fleche">&#8592;</a>
        </nav>
    </header>

    <!-- Section principale de la page -->
    <main>
        <!-- Grille de photos -->
        <section id="photos">
            <h1>Caméras</h1>
            <div class="photo-grid">
                <!-- Boucle pour afficher les matériels correspondant à l'id catégorie -->
                <?php 
                    if ($donnees && $url_id_cat !== null) {
                        foreach ($donnees as $materiel) {
                            // Vérifier si $id_cat correspond à $url_id_cat
                            if ($materiel['idcat'] == $url_id_cat) {
                                // Extraire les données pour chaque matériel
                                $image_base64 = $materiel['image_base64'];
                                $nom = htmlspecialchars($materiel['nom']);
                                $description = htmlspecialchars($materiel['description']);
                                $mime_type = "image/jpeg"; // Vous pouvez ajuster dynamiquement si nécessaire
                                $page_url = $materiel['url'] ?? "#"; // Utilisez une clé spécifique pour le lien si disponible
                                $id = $materiel['idmat'];
                                $id_cat = $materiel['idcat'];

                                echo "
                                <div class='photo'>
                                    <a href='{$page_url}?id={$id}'>
                                        <img src='data:{$mime_type};base64,{$image_base64}' alt='{$nom}' style='width:100px; height:auto;'>
                                        <div class='materiel'>
                                            <h2>{$nom}</h2>
                                            <p>{$description}</p>
                                        </div>
                                    </a>
                                </div>";
                            }
                        }
                    } else {
                        echo "<p>Aucun matériel trouvé pour cette catégorie.</p>";
                    }
                ?>
            </div>
        </section>
    </main>

   <!-- Pied de page -->
   <footer>
    <div class="logos">
        <img src="chemin/vers/limage.jpg" alt="logo iut">
        <img src="chemin/vers/limage.jpg" alt="logo MMI">
    </div>
        <div class="text">
            <p>Mentions légales</p> <!-- Lien vers la page des mentions légales -->
            <p>Politique de confidentialité</p> <!-- Lien vers la politique de confidentialité -->
            <a href="mailto:Pierre.froelich@univ-smb.fr" target="_blank">Pierre.froelich@univ-smb.fr</a> <!-- Lien vers l'email -->
            <p>&copy; MMI Chambéry 2024-2025</p> <!-- Texte MMI Chambéry -->
        </div>
    </footer>
</body>
</html>