<?php
// Connexion à la base de données (utilisez vos propres paramètres de connexion)
$pdo = new PDO('mysql:host=localhost;dbname=bibliotheque_ia', 'utilisateur', 'mot_de_passe');

$sql = "SELECT DATE_FORMAT(DateAjout, '%Y-%m') as Mois, COUNT(*) as NombreDeLivres FROM Livre
        GROUP BY Mois
        ORDER BY Mois";
$stmt = $pdo->query($sql);

$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($resultats);
?>
