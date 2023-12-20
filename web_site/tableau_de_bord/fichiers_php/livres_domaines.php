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

// Fonction pour récupérer le nombre de livres par domaine
function getNombreLivresParDomaine($domaine) {
    global $connexion;

    $domaine = $connexion->real_escape_string($domaine);

    $requete = "SELECT COUNT(*) AS nombreLivres FROM Livre WHERE Domaine = '$domaine'";
    $resultat = $connexion->query($requete);

    if ($resultat) {
        $row = $resultat->fetch_assoc();
        return $row['nombreLivres'];
    } else {
        return 0; // Erreur dans la requête
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>
