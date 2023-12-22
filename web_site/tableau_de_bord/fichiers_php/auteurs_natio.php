<?php
session_start();
include("../../connect_db/db.php");

// Indiquer que le contenu est du type JSON
header('Content-Type: application/json');

// Fonction pour récupérer le nombre d'auteurs par nationalité
function getNombreAuteursParNationalite() {
    global $pdo;

    try {
        $requete = "SELECT Nationalite, COUNT(Num) AS NombreAuteurs
                    FROM Auteur
                    GROUP BY Nationalite";
        
        $resultat = $pdo->query($requete);

        $auteursParNationalite = array();

        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $nationalite = $row['Nationalite'];
            $auteursParNationalite[$nationalite] = $row['NombreAuteurs'];
        }

        return $auteursParNationalite;
    } catch (PDOException $e) {
        die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
}

// Appeler la fonction et renvoyer les données au format JSON
$data = getNombreAuteursParNationalite();
echo json_encode($data);
exit;

// Fermer la connexion à la base de données
$connexion->close();
?>
