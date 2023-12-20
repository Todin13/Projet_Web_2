<?php 
    session_start();
    include("../connect_db/db.php");
    
    // if (!isset($_SESSION['username'])) {
    //     header('Location: ../home/');
    //     exit();
    // } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["datenaissance"]) && isset($_POST["nationalite"])) {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $datenaissance = $_POST["datenaissance"];
            $nationalite = $_POST["nationalite"];

            $sql = "INSERT INTO Auteur (Nom, Prenom, DateNaissance, Nationalite) VALUES ('$nom', '$prenom', '$datenaissance', '$nationalite')";
            if ($pdo->query($sql) === TRUE) {
                echo "Author added successfully.";
            } else {
                $errorInfo = $pdo->errorInfo();
                echo "Error adding author: " ;
                var_dump($errorInfo);
            }
        }

        if (isset($_POST["issn"]) && isset($_POST["titre"]) && isset($_POST["resume"]) && isset($_POST["nbpages"]) && isset($_POST["domaine"])) {
            $issn = $_POST["issn"];
            $titre = $_POST["titre"];
            $resume = $_POST["resume"];
            $nbpages = $_POST["nbpages"];
            $domaine = $_POST["domaine"];
    
            $sql = "INSERT INTO Livre (ISSN, Titre, Resume, Nbpages, Domaine) VALUES ('$issn', '$titre', '$resume', '$nbpages', '$domaine')";
            if ($pdo->query($sql) === TRUE) {
                echo "Book added successfully.";
            } else {
                $errorInfo = $pdo->errorInfo();
                echo "Error adding book: " ;
                var_dump($errorInfo);
            }
        }
        
        if (isset($_POST["num_auteur"]) && isset($_POST["issn_livre"])) {
            $num_auteur = $_POST["num_auteur"];
            $issn_livre = $_POST["issn_livre"];

            $sql = "INSERT INTO Ecrit (Num, ISSN) VALUES ('$num_auteur', '$issn_livre')";
            if ($pdo->query($sql) === TRUE) {
                echo "Author associated with book successfully.";
            } else {
                $errorInfo = $pdo->errorInfo();
                echo "Error associating author with book: ";
                var_dump($errorInfo);
            }
        }
    }
?>
