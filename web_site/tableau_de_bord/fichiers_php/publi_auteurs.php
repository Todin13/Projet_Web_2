<?php
session_start();
include("../../connect_db/db.php");

// Indiquer que le contenu est du type JSON
header('Content-Type: application/json');

// Fonction pour récupérer le nombre de livres par auteur
function getNombreLivresParAuteur() {
    global $pdo;

    try {
        $requete = "SELECT Auteur.Nom, Auteur.Prenom, COUNT(Ecrit.ISSN) AS NombreLivres
                    FROM Auteur
                    LEFT JOIN Ecrit ON Auteur.Num = Ecrit.Num
                    GROUP BY Auteur.Num";

        $resultat = $pdo->query($requete);

        $livresParAuteur = array();

        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $nomComplet = $row['Nom'] . ' ' . $row['Prenom'];
            $livresParAuteur[$nomComplet] = $row['NombreLivres'];
        }

        return $livresParAuteur;
    } catch (PDOException $e) {
        die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    }
}

// Appeler la fonction et renvoyer les données au format JSON
$data = getNombreLivresParAuteur();
echo json_encode($data);
exit;

// Fermer la connexion à la base de données
$connexion->close();
?>
