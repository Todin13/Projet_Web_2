<?php
    session_start();
    include("../connect_db/db.php");

    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $table = $_POST['table'];
        
        // Récupérer les colonnes et les valeurs modifiées
        $updateData = [];
        foreach ($_POST as $key => $value) {
            if ($key !== 'table') {
                $updateData[$key] = sanitizeInput($value);
            }
        }

        // Construire la clause SET de la requête UPDATE
        $setClause = '';
        foreach ($updateData as $key => $value) {
            $setClause .= "`$key` = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');

        // Vérifier s'il y a une condition WHERE (par exemple, si tu as besoin d'identifier la ligne spécifique)
        $whereClause = ''; // Remplace cela avec ta propre logique de condition WHERE si nécessaire

        // Construire la requête SQL
        $query = "UPDATE `$table` SET $setClause $whereClause";

        // Préparer et exécuter la requête
        $stmt = $pdo->prepare($query);
        foreach ($updateData as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $success = $stmt->execute();

        if ($success) {
            echo "Modification réussie!";
        } else {
            echo "Erreur lors de la modification.";
        }
    } else {
        echo "Accès non autorisé.";
    }
?>
