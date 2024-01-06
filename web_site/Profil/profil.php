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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="profil.css">
    <title>Profile</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../home/home.php">Home</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../home/browse.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../administration/administration_data.php">Administration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../tableau_de_bord/tableau_de_bord.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Profil/profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout/logout.php">Lougout</a>
                </li>
            
        </div>
    </nav>

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
