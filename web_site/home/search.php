<?php
$host = "localhost";
$username = "root";
$password = ""; 
$db_name = "bibliotheque_ia";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

$conditions= ["Titre = :id", "ISSN = :id", "Resume = :id", "Domaine = :id"];

$query = "SELECT * FROM Livre WHERE " . implode(" OR ", $conditions);
$stmt = $pdo->prepare($query);
$stmt->execute([":id" => $_GET["search"]]);

$result = $stmt->fetch();
if ($result) {
    // Add the result to the list variable
    $results[] = $result;
    // Display the result
    echo "ID: " . $result['id'] . " - Name: " . $result['name'] . '<br>';
} else {
    // No results were found, so display a message indicating that
    echo "No results found in the database";
}
?>