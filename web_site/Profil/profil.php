<?php
session_start();
include('../connect_db/db.php');

// Check if the user is logged in
if (!isset($_SESSION['AdminID'])) {
    header('Location: ../authentification/authentification.php'); // Redirect to login page if not logged in
    exit();
}

// Retrieve user information from the database
$adminId = $_SESSION['AdminID'];
$query = "SELECT * FROM Admin WHERE AdminId = :adminId";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':adminId', $adminId, PDO::PARAM_INT);
$stmt->execute();

if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nom = $user['Nom'];
    $email = $user['Email'];
    $tel = $user['Tel'];
} else {
    // Handle the case where user data is not found (this should not happen if authentication is successful)
    die("Error retrieving user information");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile_test.css">
    <title>Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $nom; ?>!</h1>
    <p>Email: <?php echo $email; ?></p>
    <p>Phone: <?php echo $tel; ?></p>

    <!-- Add any additional information you want to display -->

    <a href="logout.php">Logout</a> <!-- Add a logout link -->
</body>
</html>
