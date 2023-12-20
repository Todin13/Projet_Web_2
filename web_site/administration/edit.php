<?php
    session_start();
    include("../connect_db/db.php");

    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedTable = sanitizeInput($_POST["table"]);

        // Validate and sanitize other form inputs as needed
        // ...

        // Construct the UPDATE query based on the selected table and form data
        $updateQuery = "UPDATE $selectedTable SET ";
        foreach ($_POST as $key => $value) {
            
            if ($key !== 'table') {
                $updateQuery .= "$key = :$key, ";
            }
        } 

        $updateQuery = rtrim($updateQuery, ', ');

        $updateQuery .= " WHERE ";
        foreach ($_POST as $key => $value) {
            if ($key !== 'table') {
                $updateQuery .= "$key = :$key AND ";
            }
        } 

        $updateQuery = rtrim($updateQuery, 'AND ');

        $stmt = $pdo->prepare($updateQuery);
        foreach ($_POST as $key => $value) {
            
            if ($key !== 'table') {
                $stmt->bindValue(":$key", sanitizeInput($value));
            }
        }

        if ($stmt->execute()) {
            echo "Data updated successfully.";
        } else {
            echo "Error updating data.";
        }
    } else {

        header('Location: index.php');
        exit();
    }
?>
