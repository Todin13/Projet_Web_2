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

// Fonction pour récupérer le nombre de livres par auteur
function getNombreLivresParAuteur() {
    global $connexion;

    $requete = "SELECT Auteur.Nom, Auteur.Prenom, COUNT(Ecrit.ISSN) AS NombreLivres
                FROM Auteur
                LEFT JOIN Ecrit ON Auteur.Num = Ecrit.Num
                GROUP BY Auteur.Num";
    
    $resultat = $connexion->query($requete);

    if ($resultat) {
        $livresParAuteur = array();

        while ($row = $resultat->fetch_assoc()) {
            $nomComplet = $row['Nom'] . ' ' . $row['Prenom'];
            $livresParAuteur[$nomComplet] = $row['NombreLivres'];
        }

        return $livresParAuteur;
    } else {
        return null; // Erreur dans la requête
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>
