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
      <a href="home.php" class="self-center text-xl font-semibold whitespace-nowrap text-white hover:text-gray-400 md:hover:bg-transparent dark:text-slate-300 dark:hover:text-sky-500">Bibliothèque Numérique Unifiée</a>
      <div class="hidden w-full md:block md:w-auto">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0">
          <li>
            <a href="browse.html" class="py-2 px-3 text-gray-400 hover:text-gray-400 md:hover:bg-transparent md:hover:text-slate-300 md:p-0 dark:text-sky-500 dark:hover:text-sky-500" aria-current="page">Browse</a>
          </li>
          <?php 
            if (!isset($_SESSION['AdminID'])) {
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

  <div class="relative flex flex-col">
    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-400 dark:text-slate-300 hover:bg-sky-200 dark:hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
      </svg>
      <span class="sr-only">Search</span>
    </button>
    <div class="relative hidden md:block">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        <span class="sr-only">Search icon</span>
      </div>
      <form name="search" action="search.php" method="get">
        <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
      </form>
    </div>
  </div>
</body>