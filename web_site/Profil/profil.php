<?php
session_start();
include('../connect_db/db.php');

if (!isset($_SESSION['AdminID'])) {
    header('Location: ../authentification/authentification.php');
    exit();
}

$adminId = $_SESSION['AdminID'];

// Check if the form is submitted for updating user information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newNom = $_POST['newNom'];
    $newEmail = $_POST['newEmail'];
    $newTel = $_POST['newTel'];

    // Update user information in the database
    $updateQuery = "UPDATE Admin SET Nom = :newNom, Email = :newEmail, Tel = :newTel WHERE AdminId = :adminId";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':newNom', $newNom, PDO::PARAM_STR);
    $updateStmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
    $updateStmt->bindParam(':newTel', $newTel, PDO::PARAM_STR);
    $updateStmt->bindParam(':adminId', $adminId, PDO::PARAM_INT);
    $updateStmt->execute();
}

// Retrieve updated user information from the database
$query = "SELECT * FROM Admin WHERE AdminId = :adminId";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':adminId', $adminId, PDO::PARAM_INT);
$stmt->execute();

if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nom = $user['Nom'];
    $email = $user['Email'];
    $tel = $user['Tel'];
} else {
    die("Error retrieving user information");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <title>Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo $nom; ?>!</h1>
    <form method="POST" action="">
        <label for="newNom">Name:</label>
        <input type="text" id="newNom" name="newNom" value="<?php echo $nom; ?>" required><br>

        <label for="newEmail">Email:</label>
        <input type="email" id="newEmail" name="newEmail" value="<?php echo $email; ?>" required><br>

        <label for="newTel">Phone:</label>
        <input type="tel" id="newTel" name="newTel" value="<?php echo $tel; ?>" required><br>

        <button type="submit">Update Information</button>
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
