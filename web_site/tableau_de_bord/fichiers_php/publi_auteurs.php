<?php
// Connexion à la base de données (utilisez vos propres paramètres de connexion)
$pdo = new PDO('mysql:host=localhost;dbname=bibliotheque_ia', 'utilisateur', 'mot_de_passe');

$sql = "SELECT Auteur.Nom, Auteur.Prenom, COUNT(*) as NombreDeLivres FROM Auteur
        JOIN Ecrit ON Auteur.Num = Ecrit.Num
        GROUP BY Auteur.Num";
$stmt = $pdo->query($sql);

$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($resultats);
?>
