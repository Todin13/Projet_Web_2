<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$db   = 'bibliotheque_ia';
$user = 'utilisateur';
$pass = 'mot_de_passe';
$charset = 'utf8mb4';

// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Requête SQL pour compter le nombre de livres par domaine
$sql = "SELECT Domaine, COUNT(*) as NombreDeLivres FROM Livre GROUP BY Domaine";
$stmt = $pdo->query($sql);

$livresParDomaine = $stmt->fetchAll();

// Renvoyer les résultats en format JSON
header('Content-Type: application/json');
echo json_encode($livresParDomaine);
?>
