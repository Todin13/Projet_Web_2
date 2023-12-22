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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $table = sanitizeInput($_POST["table"]);
        $whereClause = "WHERE";
        $deleteQuery = "DELETE FROM $table $whereClause ";

        $table = $_POST['table'];
        
        $sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
        $stmt = $pdo->query($sql);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            $primaryKeyName = $row['Column_name'];
        }
        
        if (isset($_POST[$primaryKeyName])) {
            $deleteQuery = "DELETE FROM `$table` WHERE `$primaryKeyName` = :$primaryKeyName";
            
            $stmt = $pdo->prepare($deleteQuery);
        
            $stmt->bindValue(":$primaryKeyName", sanitizeInput($_POST[$primaryKeyName]));
        
            if ($stmt->execute()) {
                echo "Record deleted successfully.";
                header('Location: administration_data.php');
                exit();
            } else {
                echo "Error deleting record.";
                $errorInfo = $stmt->errorInfo();
                var_dump($errorInfo);
            }
        } else {
            echo "Invalid request.";
        }
    } else {
        echo "Invalid request.";
    }
?>
