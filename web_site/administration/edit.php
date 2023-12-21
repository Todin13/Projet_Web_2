<?php
    session_start();
    include("../connect_db/db.php");

    // if (!isset($_SESSION['username'])) {
    //     header('Location: ../home/');
    //     exit();
    // }

    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table'])) {
        $table = $_POST['table'];
        
        $sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
        $stmt = $pdo->query($sql);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $primaryKeyName = $row['Column_name'];
        }

        // Check if the primary key exists in the POST data
        if (isset($_POST[$primaryKeyName])) {
            $whereClause = 'WHERE ' . $primaryKeyName . ' = :' . $primaryKeyName;

            $updateData = [];
            foreach ($_POST as $key => $value) {
                if ($key !== 'table' && $key !== $primaryKeyName) {
                    $updateData[$key] = sanitizeInput($value);
                }
            }
        
            $setClause = '';
            foreach ($updateData as $key => $value) {
                $setClause .= "`$key` = :$key, ";
            }
            $setClause = rtrim($setClause, ', ');
        
            // Construct the SQL query
            $query = "UPDATE `$table` SET $setClause $whereClause";
        
            // Prepare and execute the query
            $stmt = $pdo->prepare($query);
            
            foreach ($updateData as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            // Bind the primary key value
            $stmt->bindValue(":$primaryKeyName", sanitizeInput($_POST[$primaryKeyName]));

            // Execute the query and handle errors
            try {
                $success = $stmt->execute();

                if ($success) {
                    echo "Modification réussie!";
                    // Output JavaScript to close the popup and reload the page
                    echo "<script>
                            window.opener.location.reload(); // Reload the parent window
                            window.close(); // Close the popup window
                          </script>";
                } else {
                    echo "Erreur lors de la modification.";
                    // Add additional error handling or logging here
                }
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
            }
        } else {
            echo "Clé primaire non définie dans les données POST.";
        }
    } else {
        echo "Accès non autorisé ou requête invalide.";
    }
?>
