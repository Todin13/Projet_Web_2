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

            $sql = "INSERT INTO authors (nom, prenom, datenaissance, nationalite) VALUES ('$nom', '$prenom', '$datenaissance', '$nationalite')";
            if ($conn->query($sql) === TRUE) {
                echo "Author added successfully.";
            } else {
                echo "Error adding author: " . $conn->error;
            }
        }

        if (isset($_POST["issn"]) && isset($_POST["titre"]) && isset($_POST["resume"]) && isset($_POST["nbpages"]) && isset($_POST["domaine"])) {
            $issn = $_POST["issn"];
            $titre = $_POST["titre"];
            $resume = $_POST["resume"];
            $nbpages = $_POST["nbpages"];
            $domaine = $_POST["domaine"];
    
            $sql = "INSERT INTO books (issn, titre, resume, nbpages, domaine) VALUES ('$issn', '$titre', '$resume', '$nbpages', '$domaine')";
            if ($conn->query($sql) === TRUE) {
                echo "Book added successfully.";
            } else {
                echo "Error adding book: " . $conn->error;
            }
        }
        
        if (isset($_POST["num_auteur"]) && isset($_POST["issn_livre"])) {
            $num_auteur = $_POST["num_auteur"];
            $issn_livre = $_POST["issn_livre"];

            $sql = "INSERT INTO author_book_association (num_auteur, issn_livre) VALUES ('$num_auteur', '$issn_livre')";
            if ($conn->query($sql) === TRUE) {
                echo "Author associated with book successfully.";
            } else {
                echo "Error associating author with book: " . $conn->error;
            }
        }
    }
?>