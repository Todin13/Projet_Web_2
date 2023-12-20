<?php
    include("../connect_db/db.php");

    // if (!isset($_SESSION['username'])) {
    //     header('Location: ../home/');
    //     exit();
    // } 

    $tables = ['auteur', 'livre', 'ecrit'];
    // Function to sanitize user input
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    };

    function generateInputFields($table){

        switch ($table) {
        
            case 'auteur' :
                echo '<h2>Ajouter un Auteur </h2>';
                echo '<form method="post" action="verif.php" class="add_author">';
                echo '<label>Nom:</label>';
                echo '<input type="text" name="nom" required><br>';
                echo '<label>Prenom:</label>';
                echo '<input type="text" name="prenom" required><br>';
                echo '<label>Date de Naissance:</label>';
                echo '<input type="date" name="datenaissance" required><br>';
                echo '<label>Nationalite:</label>';
                echo '<input type="text" name="nationalite" required><br>';
                echo '<input type="submit" value="Add Author">';
                echo '</form>';
                break;

            case 'livre':
            
                echo '<h2>Ajouter un livre</h2>';
                echo '<form method="post" action="verif.php" class="add_book">';
                echo '<label>ISSN:</label>';
                echo '<input type="text" name="issn" required><br>';
                echo '<label>Titre:</label>';
                echo '<input type="text" name="titre" required><br>';
                echo '<label>Resume:</label>';
                echo '<textarea name="resume" required></textarea><br>';
                echo'<label>Nombre de Pages:</label>';
                echo '<input type="number" name="nbpages" required><br>';
                echo '<label>Domaine:</label>';
                echo '<input type="text" name="domaine" required><br>';
                echo '<input type="submit" value="Add Book">';
                echo '</form>';
                break;
            
            case 'ecrit':
        
                echo '<h2>Associez un Livre avec un ou plusieurs Auteurs</h2>';
                echo '<form method="post" action="verif.php" class="add_association">';
                echo '<label>Num Auteur:</label>';
                echo '<input type="number" name="num_auteur" required><br>';
                echo '<label>ISSN Livre:</label>';
                echo '<input type="text" name="issn_livre" required><br>';
                echo '<input type="submit" value="Associate Author with Book">';
                echo '</form>';
                break;
        }
    };
?>

<!DOCTYPE html>
<html lang="fr">
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
    session_start();
    include("../connect_db/db.php"); 

    $defaultTable = 'auteur';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedTable = sanitizeInput($_POST["table"]);
        $_SESSION['selectedTable'] = $selectedTable; 
    } elseif (isset($_SESSION['selectedTable'])) {
        $selectedTable = $_SESSION['selectedTable']; 
    } 
    else {
         $selectedTable = $defaultTable;
    }

    echo generateInputFields($selectedTable);

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
    };

    echo "</table>";    
    exit();   
    ?>

</body>
</html>