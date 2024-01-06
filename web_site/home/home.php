<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <title>BNU</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white dark:bg-slate-200">
  <nav class="bg-gradient-to-r from-sky-300 to-blue-300 dark:bg-gradient-to-r from-sky-800 to-blue-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://www.ia-institut.fr/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://www.ia-institut.fr/wp-content/themes/epita-ia-theme/images/logo-epita-ia-blanc.svg" class="h-14" alt="EPITA IA INSTITUT" />
      </a>
      <a href="home.php" class="self-center text-xl font-semibold whitespace-nowrap text-gray-400 hover:text-gray-400 md:hover:bg-transparent dark:text-sky-500 dark:hover:text-sky-500" aria-current="page">Bibliothèque Numérique Unifiée</a>
      <div class="hidden w-full md:block md:w-auto">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0">
          <li>
            <a href="browse.php" class="py-2 px-3 text-white hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-slate-300 dark:hover:text-sky-500">Browse</a>
          </li>
          <?php 
            if (isset($_SESSION['AdminID'])) {
              echo '<li> <a href="../administration/administration_data.php" class="py-2 px-3 text-white hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-slate-300 dark:hover:text-sky-500">Administration</a> </li>'; 
              echo '<li> <a href="../tableau_de_bord/tableau_de_bord.php" class="py-2 px-3 text-white hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-slate-300 dark:hover:text-sky-500">Dashboard</a> </li>'; 
              echo '<li> <a href="../Profil/profil.php" class="py-2 px-3 text-white hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-slate-300 dark:hover:text-sky-500">Profil</a> </li>'; 
              echo '<li> <a href="../logout/logout.php" class="py-2 px-3 text-white hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-slate-300 dark:hover:text-sky-500">Logout</a> </li>'; 
            } else {
              echo '<li> <a href="../authentification/authentification.php" class="py-2 px-3 text-white hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-slate-300 dark:hover:text-sky-500">Login</a> </li>';
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container mx-auto rounded-lg">
    <p>Bienvenue à la Bibliothèque Numérique Unifiée!</p> <br />
    <p>
    Ce projet a été crée pour rendre l'accès à notre bibliothèque plus facile. <br />
    Vous pouvez rechercher, emprunter, et retourner les livres que vous souhaitez. <br />
    <!-- Créez un compte pour tenir compte des livres que vous avez lus et ceux que vous souhaitez lire. -->
    </p>
  </div>

  <div class="absolute bottom-0 left-0">
    <p>Test</p>
  </div>
</body>

</html>