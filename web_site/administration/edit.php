<?php
    session_start();
    include("../connect_db/db.php");

    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $table = $_POST['table'];
        
        $tableName = $_SESSION['selectedTable'];
        $sql = "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'";
        $stmt = $pdo->query($sql);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $primaryKeyName = $row['Column_name'];
        }
    
        $whereClause = '';

        $updateData = [];
        foreach ($_POST as $key => $value) {
            if ($key === $primaryKeyName) {
                $whereClause = 'WHERE ' . $primaryKeyName . '=' . sanitizeInput($value);
            } elseif ($key !== 'table') {
                $updateData[$key] = sanitizeInput($value);
            }
        }
    
        $setClause = '';
        foreach ($updateData as $key => $value) {
            $setClause .= "`$key` = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');
    
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
            echo "<script>
                    window.opener.location.reload(); // Reload the parent window
                    window.close(); // Close the popup window
                  </script>";

        } else {
            echo "Erreur lors de la modification.";
        }
    } else {
        echo "Accès non autorisé.";
    }
    
?>
