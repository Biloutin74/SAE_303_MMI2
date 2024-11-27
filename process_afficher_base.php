<?php
    require("afficher_base.php");

    $donnees1 = afficher_utilisateur();
    $donnees2 = afficher_materiel();
    $donnees3 = afficher_reservation();
    $donnees4 = afficher_categorie();
                
    print_r($donnees1);
    print_r($donnees2);
    print_r($donnees3);
    print_r($donnees4);

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
                        $nb_enreg1 = (int)count($donnees1);

                        echo $nb_enreg1;
                        echo $donnees1;

                        for ($i=0;$i<$nb_enreg1;$i++) {

                            $user_id = (int)$donnees1[0];
                            $user_nom = (string)$donnees1[1];
                            $user_prenom = (string)$donnees1[2];
                            $user_mdpIUT = (string)$donnees1[3];
                            $user_mail = (string)$donnees1[4];
                            $user_annee = (int)$donnees1[5];
                            $user_admin = (int)$donnees1[6];
                            $user_caution = (int)$donnees1[7];

                            echo "<TR>";
                            echo "<TD bgcolor='WHITE'><FONT size='4'>".$user_id."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_nom."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_prenom."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_mdpIUT."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_mail."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_annee."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_admin."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$user_caution."</FONT></TD>";
                            echo "</TR>";

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
                        $nb_enreg2 = (int)count($donnees2);

                        echo $nb_enreg2;
                        echo $donnees2;

                        for ($i=0;$i<$nb_enreg2;$i++) {

                            $materiel_id = (int)$donnees2[0];
                            $materiel_image = $donnees2[1];
                            $materiel_nom = (string)$donnees2[2];
                            $materiel_description = (string)$donnees2[3];
                            $materiel_etat = (string)$donnees2[4];
                            $materiel_visible = (int)$donnees2[5];
                            $materiel_categorie_idcat = (int)$donnees2[6];

                            // Encoder l'image en base64
                            $materiel_image_base64 = base64_encode($materiel_image);

                            // Déduire le type MIME (par exemple, jpeg, png, etc.)
                            $materiel_mime_type = "image/jpeg";

                            echo "<TR>";
                            echo "<TD bgcolor='WHITE'><FONT size='4'>".$materiel_id."</FONT></TD>
                                <TD bgcolor='WHITE'><img src='data:" . $materiel_mime_type . ";base64," . $materiel_image_base64 . "' alt='" . htmlspecialchars($materiel_nom) . "'></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$materiel_nom."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$materiel_description."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$materiel_etat."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$materiel_visible."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$materiel_categorie_idcat."</FONT></TD>";
                            echo "</TR>";

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
                        $nb_enreg3 = (int)count($donnees3);

                        echo $nb_enreg3;
                        echo $donnees3;

                        for ($i=0;$i<$nb_enreg3;$i++) {

                            $reservation_id = (int)$donnees3[0];
                            $reservation_date_debut = $donnees3[1];
                            $reservation_date_fin = $donnees3[2];
                            $reservation_etat = (string)$donnees3[3];
                            $reservation_utilisateur_iduser = (int)$donnees3[4];
                            $reservation_materiel_idmat = (int)$donnees3[5];

                            echo "<TR>";
                            echo "<TD bgcolor='WHITE'><FONT size='4'>".$reservation_id."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$reservation_date_debut."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$reservation_date_fin."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$reservation_etat."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$reservation_utilisateur_iduser."</FONT>
                                </TD><TD bgcolor='WHITE'><FONT size='4'>".$reservation_materiel_idmat."</FONT></TD>";
                            echo "</TR>";

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
                        $nb_enreg4 = (int)count($donnees4);

                        echo $nb_enreg4;
                        echo $donnees4;

                        for ($i=0;$i<$nb_enreg4;$i++) {

                            $categorie_id = $donnees4[0];
                            $categorie_image = $donnees4[1];
                            $categorie_nom = $donnees4[2];
                            $categorie_description = $donnees4[3];
                            $categorie_visible = (int)$donnees4[4];

                            // Encoder l'image en base64
                            $categorie_image_base64 = base64_encode($categorie_image);

                            // Déduire le type MIME (par exemple, jpeg, png, etc.)
                            $categorie_mime_type = "image/jpeg";

                            echo "<TR>";
                            echo "<TD bgcolor='WHITE'><FONT size='4'>".$categorie_id."</FONT></TD>
                                <TD bgcolor='WHITE'><img src='data:".$categorie_mime_type.";base64,".$categorie_image_base64."' alt='".htmlspecialchars($categorie_nom)."'style='max-width: 100px;'></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$categorie_nom."</FONT></TD>
                                <TD bgcolor='WHITE'><FONT size='4'>".$categorie_description."</FONT>
                                </TD><TD bgcolor='WHITE'><FONT size='4'>".$categorie_visible."</FONT></TD>";
                            echo "</TR>";

                        }
                    ?>
                </table>
            </div>
        </article>
    </body>
</html>