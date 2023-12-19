<?php
include 'db_connect.php'; // Inclure le script de connexion à la base de données

// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$authorization_level = $_POST['authorization_level'];

// Requête pour insérer les données
$sql = "INSERT INTO user_db (Username, Password, Last_name, First_name, email, phone, authorization_level)
VALUES ('$username', '$password', '$last_name', '$first_name', '$email', '$phone', '$authorization_level')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
