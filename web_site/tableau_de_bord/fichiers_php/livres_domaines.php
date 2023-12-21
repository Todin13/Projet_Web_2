<?php
session_start();
include("../../connect_db/db.php");

// Indiquer que le contenu est du type JSON
header('Content-Type: application/json');

// Fonction pour récupérer le nombre de livres par domaine
function getNombreLivresParDomaines() {
    global $pdo;

    try {
        $requete = "SELECT Domaine, COUNT(*) AS nombreLivres FROM Livre GROUP BY Domaine";
        $resultat = $pdo->query($requete);

        $livresParDomaines = array();

        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $domaine = $row['Domaine'];
            $livresParDomaines[$domaine] = $row['nombreLivres'];
        }

        return $livresParDomaines;
    } catch (PDOException $e) {
        die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
}

// Appeler la fonction et renvoyer les données au format JSON
$data = getNombreLivresParDomaines();
echo json_encode($data);
exit;

// Fermer la connexion à la base de données
$connexion->close();
?>
