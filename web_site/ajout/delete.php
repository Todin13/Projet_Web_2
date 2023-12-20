<?php
    session_start();
    include("../connect_db/db.php");
    
    // if (!isset($_SESSION['username'])) {
    //     header('Location: ../home/');
    //     exit();
    // } 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $table = htmlspecialchars($_POST["table"]);
        $deleteQuery = "DELETE FROM $table WHERE ";

        foreach ($_POST as $key => $value) {
            if ($key !== 'table') {
                $deleteQuery .= "$key = :$key AND ";
            }
        }

        $deleteQuery = rtrim($deleteQuery, "AND ");

        $stmt = $pdo->prepare($deleteQuery);
        foreach ($_POST as $key => $value) {
            if ($key !== 'table') {
                $stmt->bindValue(":$key", $value);
            }
        }

        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record.";
        }
    } else {
        echo "Invalid request.";
    }
?>