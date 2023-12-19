<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
</head>
<body>

    <h2>Add Author</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label>Nom:</label>
        <input type="text" name="nom" required>
        <label>Prenom:</label>
        <input type="text" name="prenom" required>
        <label>Date de Naissance:</label>
        <input type="date" name="datenaissance" required>
        <label>Nationalite:</label>
        <input type="text" name="nationalite" required>
        <input type="submit" value="Add Author">
    </form>

    <h2>Add Book</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label>ISSN:</label>
        <input type="text" name="issn" required>
        <label>Titre:</label>
        <input type="text" name="titre" required>
        <label>Resume:</label>
        <textarea name="resume" required></textarea>
        <label>Nombre de Pages:</label>
        <input type="number" name="nbpages" required>
        <label>Domaine:</label>
        <input type="text" name="domaine" required>
        <input type="submit" value="Add Book">
    </form>

    <h2>Associate Author with Book</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="associate">
        <label>Num Auteur:</label>
        <input type="number" name="num_auteur" required>
        <label>ISSN Livre:</label>
        <input type="text" name="issn_livre" required>
        <input type="submit" value="Associate Author with Book">
    </form>

</body>
</html>
