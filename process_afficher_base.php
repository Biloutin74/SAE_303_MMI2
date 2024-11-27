<?php
    require("afficher_base.php");

    $donnees1 = afficher_utilisateur();
    $donnees2 = afficher_materiel();
    $donnees3 = afficher_reservation();
    $donnees4 = afficher_categorie();
      
    /*
    print_r($donnees1);
    print_r($donnees2);
    print_r($donnees3);
    print_r($donnees4);
    */

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel = "stylesheet" href = "css/style_form.css">-->
        <title>afficher_base</title>
    </head>
    <body>
        <article>
            <div>
                <table>
                    <tr>
                        <td><h3>iduser</h3></td>
                        <td><h3>nom</h3></td>
                        <td><h3>prenom</h3></td>
                        <td><h3>mdpIUT</h3></td>
                        <td><h3>mail</h3></td>
                        <td><h3>annee</h3></td>
                        <td><h3>admin</h3></td>
                        <td><h3>caution</h3></td>
                    </tr>
                    <?php

                        foreach ($donnees1 as $utilisateur) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($utilisateur['iduser']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['prenom']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['mdpIUT']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['mail']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['annee']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['admin']) . "</td>";
                            echo "<td>" . htmlspecialchars($utilisateur['caution']) . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </article>

        <article>
            <div>
                <table>
                    <tr>
                        <td><h3>idmat</h3></td>
                        <td><h3>image</h3></td>
                        <td><h3>nom</h3></td>
                        <td><h3>description</h3></td>
                        <td><h3>état</h3></td>
                        <td><h3>visible</h3></td>
                        <td><h3>categorie_idcat</h3></td>
                    </tr>
                    <?php

                        foreach ($donnees2 as $materiel) {
                            // Accéder aux données associatives
                            $materiel_id = (int)$materiel['idmat'];
                            $materiel_image_base64 = $materiel['image_base64'];
                            $materiel_nom = htmlspecialchars((string)$materiel['nom']);
                            $materiel_description = htmlspecialchars((string)$materiel['description']);
                            $materiel_etat = htmlspecialchars((string)$materiel['etat']);
                            $materiel_visible = (int)$materiel['visible'];
                            $materiel_categorie_idcat = (int)$materiel['categorie_idcat'];
                    
                            // Déduire le type MIME (vous pourriez le déduire dynamiquement si disponible)
                            $materiel_mime_type = "image/jpeg";
                    
                            // Générer les cellules HTML
                            echo "<tr>";
                            echo "<td>" . $materiel_id . "</td>";
                            echo "<td><img src='data:" . $materiel_mime_type . ";base64," . $materiel_image_base64 . "' alt='" . $materiel_nom . "' style='width:100px; height:auto;'></td>";
                            echo "<td>" . $materiel_nom . "</td>";
                            echo "<td>" . $materiel_description . "</td>";
                            echo "<td>" . $materiel_etat . "</td>";
                            echo "<td>" . $materiel_visible . "</td>";
                            echo "<td>" . $materiel_categorie_idcat . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </article>

        <article>
            <div>
                <table>
                    <tr>
                        <td><h3>idreservation</h3></td>
                        <td><h3>date_debut</h3></td>
                        <td><h3>date_fin</h3></td>
                        <td><h3>état</h3></td>
                        <td><h3>utilisateur_iduser</h3></td>
                        <td><h3>materiel_idmat</h3></td>
                    </tr>
                    <?php
                        
                        foreach ($donnees3 as $reservation) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($reservation['idreservation']) . "</td>";
                            echo "<td>" . htmlspecialchars($reservation['date_debut']) . "</td>";
                            echo "<td>" . htmlspecialchars($reservation['date_fin']) . "</td>";
                            echo "<td>" . htmlspecialchars($reservation['etat']) . "</td>";
                            echo "<td>" . htmlspecialchars($reservation['utilisateur_iduser']) . "</td>";
                            echo "<td>" . htmlspecialchars($reservation['materiel_idmat']) . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </article>

        <article>
            <div>
                <table>
                    <tr>
                        <td><h3>idcat</h3></td>
                        <td><h3>image</h3></td>
                        <td><h3>nom</h3></td>
                        <td><h3>description</h3></td>
                        <td><h3>visible</h3></td>
                    </tr>
                    <?php
                        
                        foreach ($donnees4 as $categorie) {
                            // Accéder aux données associatives
                            $categorie_id = (int)$categorie['idcat'];
                            $categorie_image_base64 = $categorie['image_base64'];
                            $categorie_nom = htmlspecialchars((string)$categorie['nom']);
                            $categorie_description = htmlspecialchars((string)$categorie['description']);
                            $categorie_visible = (int)$categorie['visible'];
                    
                            // Déduire le type MIME (vous pourriez le déduire dynamiquement si disponible)
                            $categorie_mime_type = "image/jpeg";
                    
                            // Générer les cellules HTML
                            echo "<tr>";
                            echo "<td>" . $categorie_id . "</td>";
                            echo "<td><img src='data:" . $categorie_mime_type . ";base64," . $categorie_image_base64 . "' alt='" . $categorie_nom . "' style='width:100px; height:auto;'></td>";
                            echo "<td>" . $categorie_nom . "</td>";
                            echo "<td>" . $categorie_description . "</td>";
                            echo "<td>" . $categorie_visible . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
        </article>
    </body>
</html>