<?php
    session_start();
    include("../connect_db/db.php");

    $updateSuccess = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        $table = $_POST["table"];
        $updateData = [];

        foreach ($_POST as $key => $value) {
            if ($key !== "table" && $key !== "update") {
                $updateData[$key] = htmlspecialchars(stripslashes(trim($value)));
            }
        }

        if (!empty($updateData)) {
            $updateQuery = "UPDATE $table SET ";
            foreach ($updateData as $key => $value) {
                $updateQuery .= "$key = :$key, ";
            }
            $updateQuery = rtrim($updateQuery, ", ");
            $updateQuery .= " WHERE ";

            foreach ($updateData as $key => $value) {
                $updateQuery .= "$key = :$key AND ";
            }
            $updateQuery = rtrim($updateQuery, " AND ");

            $stmt = $pdo->prepare($updateQuery);

            foreach ($updateData as $key => $value) {
                $stmt->bindParam(":$key", $updateData[$key]);
            }

            if ($stmt->execute()) {
                $updateSuccess = true;
            } else {
                echo "Error updating the row. Please try again.";
            }
        }
    }

    // Output success or failure message
    if ($updateSuccess) {
        echo "Row updated successfully!";
    } else {
        echo "Failed to update the row.";
    }

    // You may choose to redirect to another page after the update or simply exit
    exit();
?>
