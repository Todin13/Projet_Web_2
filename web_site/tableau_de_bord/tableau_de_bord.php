<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="tableau_de_bord.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
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
</body>
</html>
