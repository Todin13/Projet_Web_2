<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];

    // Vérification si les mots de passe correspondent
    if ($password !== $password1) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

    // Hachage du mot de passe (utilisez toujours des fonctions de hachage sécurisées en production)
   // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $host = 'localhost';
    $db_name = 'bibliothèque';
    $username_db = 'root';
    $password_db = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }

    // Insertion des données dans la base de données
    $query = "INSERT INTO user_db (Username, Password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "Enregistrement réussi. Vous pouvez vous connecter maintenant.";

    } catch (PDOException $e) {
        if ($e = "PDOException: SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '1234' for key 'PRIMARY' in C:\xampp\htdocs\Projet_Web_2\test\insertion.php:37 Stack trace: #0 C:\xampp\htdocs\Projet_Web_2\test\insertion.php(37): PDOStatement->execute() #1 {main}"){
            echo "Nom d'utilisateur deja excistant veuillez reessayé";
        } else {
            echo "Erreur lors de l'enregistrement. Veuillez réessayer.";
        }
    }
} else {
    echo "Méthode de requête incorrecte.";
}
?>
