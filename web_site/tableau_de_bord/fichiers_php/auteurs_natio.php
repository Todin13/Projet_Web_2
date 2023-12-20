<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "votre_utilisateur";
$mot_de_passe = "votre_mot_de_passe";
$base_de_donnees = "bibliotheque_ia";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Fonction pour récupérer le nombre d'auteurs par nationalité
function getNombreAuteursParNationalite() {
    global $connexion;

    $requete = "SELECT Nationalite, COUNT(Num) AS NombreAuteurs
                FROM Auteur
                GROUP BY Nationalite";
    
    $resultat = $connexion->query($requete);

    if ($resultat) {
        $auteursParNationalite = array();

        while ($row = $resultat->fetch_assoc()) {
            $nationalite = $row['Nationalite'];
            $auteursParNationalite[$nationalite] = $row['NombreAuteurs'];
        }

        return $auteursParNationalite;
    } else {
        return null; // Erreur dans la requête
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>
