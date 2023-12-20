<?php
include("../connect_db/db.php");

$tables = array();
$result = $pdo->query("SHOW TABLES");
while ($row = $result->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
};

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to generate input fields based on table columns
function generateInputFields($columns) {
    $inputFields = '';
    foreach ($columns as $column) {
        $inputFields .= "<label for='$column'>$column:</label>";
        $inputFields .= "<input type='text' name='$column' id='$column' required><br>";
    }
    return $inputFields;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Viewer</title>
</head>
<body>
    <h2>Select a Table</h2>
    <form method="post" action="">
        <label for="table">Choose a table:</label>
        <select name="table" id="table">
            <?php
            foreach ($tables as $table) {
                echo "<option value=\"$table\">$table</option>";
            }
            ?>
        </select>
        <input type="submit" value="Show Table">
    </form>

    <?php
    include("../connect_db/db.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedTable = sanitizeInput($_POST["table"]);
        echo "<h2>Table: $selectedTable</h2>";

        $result = $pdo->query("SELECT * FROM $selectedTable");
        echo "<table border='1'>";
        // Output table header
        echo "<tr>";
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            foreach ($row as $key => $value) {
                echo "<th>$key</th>";
            }
            echo "</tr>";

            // Output data
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }

        } else {
            echo "<th colspan='2'>No data found in the selected table.</t;h>";
        }
        
        $columnNames = $pdo->query("SHOW COLUMNS FROM $selectedTable");

        $columns = array();

        foreach ($columnNames as $column) {
            if (strpos($column['Extra'], 'auto_increment') === false) {
                $columns[] = $column['Field'];
            }
        }

        echo "</table>";
        // Add form for inserting data
        echo "<h2>Add Data to $selectedTable</h2>";
        echo "<form method='post' action=''>";
        echo generateInputFields($columns);
        echo "<input type='submit' name='AddData' value='Add Data'>";
        echo "</form>";

        // Handle form submission for adding data
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddData'])) {

            $columns = implode(", ", array_keys($_POST));
            $values = "'" . implode("', '", array_map('sanitizeInput', $_POST)) . "'";

            $sql = "INSERT INTO $selectedTable ($columns) VALUES ($values)";
            $pdo->exec($sql);

            echo "Data added successfully.";
        }
    }
    ?>
</body>
</html>