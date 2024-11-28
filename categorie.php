<?php
    require("afficher_categorie.php");

    $donnees = afficher_categorie();
      
    // print_r($donnees);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page de réservation</title> 
    <link rel="stylesheet" href="css/reservation.css">
</head>
<body>
    <!-- En-tête de la page -->
    <header>
        <nav>
            <!-- Menu de navigation -->
            <ul>
                <li><a href="page_accueil.html">Accueil</a></li>
                <li><a href="reservation.php">Réserver</a></li>
                <li><a href="Mon_compte.html">Mon compte</a></li>
                <li><a href="mailto:Pierre.froelich@univ-smb.fr" target="_blank">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Section principale de la page -->
    <main>
        <!-- Grille de photos -->
        <section id="photos">
            <h1>Réservation de matériel</h1>
            <div class="photo-grid">
                <!-- Génération dynamique des images -->
                <?php 
                    if (!empty($donnees)) {
                        foreach ($donnees as $categorie) {
                            // Extraire les données pour chaque catégorie
                            $image_base64 = $categorie['image_base64'];
                            $nom = (string) htmlspecialchars($categorie['nom']);
                            $mime_type = "image/jpeg"; // Vous pouvez ajuster dynamiquement si nécessaire
                            $page_url = (string) $categorie['url'] ?? "#"; // Utilisez une clé spécifique pour le lien si disponible
                            $id = (int) $categorie['idcat'];

                            echo "
                            <div class='photo'>
                                <a href='{$page_url}?id={$id}'>
                                    <img src='data:{$mime_type};base64,{$image_base64}' alt='{$nom}' style='width:100px; height:auto;'>
                                    <div class='categorie'>
                                        <h2>{$nom}</h2>
                                    </div>
                                </a>
                            </div>";
                        }
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