<?php
include 'db_connect.php'; // Inclure le script de connexion à la base de données

$username = $_POST['username'];
$password = $_POST['password'];

// Requête pour vérifier les informations de connexion
$sql = "SELECT * FROM user_db WHERE Username = '$username' AND Password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Connexion réussie
    header("Location: welcome.php?username=" . $username);
} else {
    // Connexion échouée
    echo "Login failed. <a href='signup.html'>Sign up</a>";
}

$conn->close();
?>
