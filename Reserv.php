<?php
session_start();

// Connexion à la base de données
require 'connexion.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    header("Location: authentif.php"); // Rediriger vers la page de connexion
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupérer les données du formulaire
        $utilisateur_iduser = $_SESSION['iduser'];
        $materiel_idmat = intval($_POST['materiel_idmat']);
        $date_debut = $_POST['selected_date_start'];
        $date_fin = $_POST['selected_date_end'];

        // Validation des dates
        if (new DateTime($date_debut) > new DateTime($date_fin)) {
            throw new Exception("La date de début doit être antérieure à la date de fin.");
        }

        // Vérification de disponibilité
        $stmtCheck = $pdo->prepare("
            SELECT * FROM sae_303_reservation 
            WHERE materiel_idmat = :materiel_idmat 
            AND (date_debut BETWEEN :date_debut AND :date_fin 
                 OR date_fin BETWEEN :date_debut AND :date_fin
                 OR (:date_debut BETWEEN date_debut AND date_fin))
        ");
        $stmtCheck->execute([
            ':materiel_idmat' => $materiel_idmat,
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
        ]);

        if ($stmtCheck->rowCount() > 0) {
            throw new Exception("Le matériel n'est pas disponible pour ces dates.");
        }

        // Insérer la réservation
        $stmtInsert = $pdo->prepare("
            INSERT INTO sae_303_reservation (date_debut, date_fin, etat, utilisateur_iduser, materiel_idmat)
            VALUES (:date_debut, :date_fin, 'en cours', :utilisateur_iduser, :materiel_idmat)
        ");
        $stmtInsert->execute([
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
            ':utilisateur_iduser' => $utilisateur_iduser,
            ':materiel_idmat' => $materiel_idmat,
        ]);

        // Afficher une pop-up de succès
    echo "<script>
    alert('Réservation confirmée pour la période du " . $date_debut . " au " . $date_fin . ".');
    window.location.href = 'page_accueil.html'; // Rediriger vers une autre page après la pop-up
</script>";
exit();
} catch (Exception $e) {
// Afficher une pop-up d'erreur
echo "<script>
    alert('Erreur : " . addslashes($e->getMessage()) . "');
    window.location.href = 'page_accueil.html'; // Rediriger vers une autre page après la pop-up
</script>";
exit();
}
}
?>