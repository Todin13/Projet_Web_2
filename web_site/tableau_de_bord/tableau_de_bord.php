<?php
    if (!isset($_SESSION['AdminID'])) {
        header('Location: ../home/');
        exit();
    } 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="tableau_de_bord.css">
</head>
<body>
    
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

    <h1>Dashboard de la Bibliothèque</h1>
    <div id="barplotLivresParDomaine-container" class="chart-container">
        <canvas id="barplotLivresParDomaine"></canvas>
    </div>

    <div id="barplotLivresParAuteur-container" class="chart-container">
        <canvas id="barplotLivresParAuteur"></canvas>
    </div>

    <div id="pieChartAuteursParNationalite-container" class="chart-container">
        <canvas id="pieChartAuteursParNationalite"></canvas>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Récupérer les données depuis le fichier PHP
        fetch('fichiers_php/livres_domaines.php')
            .then(response => response.json())
            .then(data => {
                // Préparer les données pour le barplot
                const domaines = Object.keys(data);
                const nombreLivres = Object.values(data);
    
                // Créer le contexte du canvas
                const ctx = document.getElementById('barplotLivresParDomaine').getContext('2d');
    
                // Créer le barplot
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: domaines,
                        datasets: [{
                            label: 'Nombre de Livres',
                            data: nombreLivres,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond des barres
                            borderColor: 'rgba(75, 192, 192, 1)', // Couleur de la bordure des barres
                            borderWidth: 1 // Largeur de la bordure des barres
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Récupérer les données depuis le fichier PHP
        fetch('fichiers_php/publi_auteurs.php')
            .then(response => response.json())
            .then(data => {
                // Préparer les données pour le barplot
                const auteurs = Object.keys(data);
                const nombreLivres = Object.values(data);
    
                // Créer le contexte du canvas
                const ctx = document.getElementById('barplotLivresParAuteur').getContext('2d');
    
                // Créer le barplot
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: auteurs,
                        datasets: [{
                            label: 'Nombre de Livres',
                            data: nombreLivres,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond des barres
                            borderColor: 'rgba(75, 192, 192, 1)', // Couleur de la bordure des barres
                            borderWidth: 1 // Largeur de la bordure des barres
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Récupérer les données depuis le fichier PHP
        fetch('fichiers_php/auteurs_natio.php')
            .then(response => response.json())
            .then(data => {
                // Préparer les données pour le pie chart
                const nationalites = Object.keys(data);
                const nombreAuteurs = Object.values(data);
    
                // Créer le contexte du canvas
                const ctx = document.getElementById('pieChartAuteursParNationalite').getContext('2d');
    
                // Créer le pie chart
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: nationalites,
                        datasets: [{
                            data: nombreAuteurs,
                            backgroundColor: [
                            "rgba(255, 183, 183, 0.8)",
                            "rgba(183, 255, 183, 0.8)",
                            "rgba(183, 183, 255, 0.8)",
                            "rgba(255, 255, 183, 0.8)",
                            "rgba(183, 255, 255, 0.8)",
                            "rgba(255, 183, 255, 0.8)",
                            "rgba(240, 240, 240, 0.8)",
                            "rgba(100, 100, 100, 0.8)",
                            "rgba(192, 192, 192, 0.8)",
                            "rgba(255, 204, 153, 0.8)"
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données:', error));
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
