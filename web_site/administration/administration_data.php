<?php
    session_start();
    include("../connect_db/db.php");

    if (!isset($_SESSION['AdminID'])) {
        header('Location: ../home/');
        exit();
    } 

    $tables = ['auteur', 'livre', 'ecrit'];
    
    if (!isset($_SESSION['selectedTable'])){
        $defaultTable = 'auteur';
        $_SESSION['selectedTable'] = $defaultTable;
    }

    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    function generateInputFields($table){

        switch ($table) {
        
            case 'auteur' :
                echo '<h2 class="form-heading">Ajouter un Auteur </h2>';
                echo '<form method="post" action="verif.php" class="add_form add_author">';
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
            
                echo '<h2 class="form-heading">Ajouter un livre</h2>';
                echo '<form method="post" action="verif.php" class="add_form add_book">';
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
        
                echo '<h2 class="form-heading">Associez un Livre avec un ou plusieurs Auteurs</h2>';
                echo '<form method="post" action="verif.php" class="add_form add_association">';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="administration_data.css">
    <title>Administrations des données</title>
</head>
<body>

<script>
        function openModifyPopup(data) {
            
            var popup = window.open("", "Modifier un element de " + data['table'] , "width=400,height=400");
            popup.document.write('<link rel="stylesheet" href="popup.css">')
            popup.document.write("<h2>Modifier un element de " + data['table'] + "</h2>");
            popup.document.write("<form method='post' action='edit.php'>");
            popup.document.write("<input type='hidden' name='table' value='" + data['table'] + "'><br>");
            <?php 
                $tableName = $_SESSION['selectedTable'] ; 
                $sql = "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'";
                $stmt = $pdo->query($sql);

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $primaryKeyName = $row['Column_name'];
                    echo "var primaryKey = '$primaryKeyName';";
                }
            ?>
            for (var key in data) {
                if (key === primaryKey) {
                    popup.document.write("<label>" + key + ":</label>");
                    popup.document.write("<input type='text' name='" + key + "' value='" + data[key] + "' readonly><br>");
                }
                else if (key !== 'table') {
                    popup.document.write("<label>" + key + ":</label>");
                    popup.document.write("<input type='text' name='" + key + "' value='" + data[key] + "'><br>");
                }
                
            }
            popup.document.write("<input type='submit' value='Modifier'></form>");
        };

  
        function confirmDelete(data) {

            // var xhttp = new XMLHttpRequest();
            // xhttp.open("POST", "check_link_key.php", true);
            // xhttp.setRequestHeader("Content-Type", "application/json");
            
            // xhttp.onreadystatechange = function() {
            //     if (xhr.readyState == 4 && xhr.status == 200) {
            //         return confirm (xhr.responseText);
            //     }
            // };
        
            // var jsonData = JSON.stringify(data);
            // xhttp.send(jsonData);

            // var otherTable;

            // if (inEcrit) {
            //     if (data['table'] === 'auteur') {
            //         otherTable = (nbliaison === 1) ? 'livre' : 'livres';
            //     } else if (data['table'] === 'livre') {
            //         otherTable = (nbliaison === 1) ? 'auteur' : 'auteurs';
            //     } else {
            //         throw new Error("Problème avec l'accès aux tables");
            //     }
            //     liason = (data['table'] === 'auteur') ? 'cet' : 'ce';
            //     return confirm("Etes vous sur de vouloir supprimer " + liason + " " + data['table'] + " alors qu'il est lié à " + nbliaison + " " + otherTable);
            // } else {
            //     liason = (data['table'] === 'auteur') ? 'cet' : 'ce';
            //     return confirm("Etes vous sur de vouloir supprimer " + liason + " " + data['table']);
            // }

            return confirm("Etes vous sur de vouloir supprimer ?")
        };

    </script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../home/home.php">Home</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../home/browse.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../administration/administration_data.php">Administration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../tableau_de_bord/tableau_de_bord.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Profil/profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout/logout.php">Lougout</a>
                </li>
            
        </div>
    </nav>

    <div class="container">
        <div class="left-column">
            <h2>Selection de la table</h2>
            <form method="post" action="">
                <label for="table">Choisissez une table:</label>
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
                $selectedTable = '';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $selectedTable = sanitizeInput($_POST["table"]);
                    $_SESSION['selectedTable'] = $selectedTable; 
                } elseif (isset($_SESSION['selectedTable'])) {
                    $selectedTable = $_SESSION['selectedTable']; 
                } else {
                    die('Problem in da session' + $_SESSION['selectedTable'] + '');
                }
                
                echo generateInputFields($selectedTable);
            ?>
        </div>

        <div class="right-column">
            <h2>Table: <?php echo $selectedTable; ?></h2>

            <?php 
                $result = $pdo->query("SELECT * FROM $selectedTable");
                echo "<table border='1'>";
                
                echo "<tr>";
                if ($result->rowCount() > 0) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    foreach ($row as $key => $value) {
                        echo "<th>$key</th>";
                    }
                    echo "<th>Supprimer</th>";  
                    echo "<th>Modifier</th>";  
                    echo "</tr>";

                    $result->execute();
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        foreach ($row as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "<td><form method='post' action='delete.php' onsubmit='return confirmDelete(" . json_encode(['table' => $selectedTable] + $row) . ")'>";  
                        echo "<input type='hidden' name='table' value='$selectedTable'>";
                        foreach ($row as $key => $value) {
                            echo "<input type='hidden' name='$key' value='$value'>";
                        }
                        echo "<input type='submit' value='Supprimer'></form></td>"; 

                        echo "<td><input type='hidden' name='table' value='$selectedTable'>";
                        foreach ($row as $key => $value) {
                             echo "<input type='hidden' name='$key' value='$value'>";
                        }
                        echo "<input type='submit' onclick='openModifyPopup(" . json_encode(['table' => $selectedTable] + $row) . ")' value='Modifier'></td>";
                        echo "</tr>";
                    }

                } else {
                    echo "<th colspan='2'>No data found in the selected table.</th>";
                }

                echo "</table>";   
                exit();   
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>