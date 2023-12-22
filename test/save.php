<html>
	<head>
		<title>Enregistrer</title>
	</head>
	<body>
		<form action="insertion.php" method="post">
			<label>
			<i>Login</i>
			</label>
			<input type="text" name="username" required>
			</br>
			<label>
			<i>Mot de passe</i>
			</label>
			<input type="password" name="password" required>
			</br>
			<label>
			<i>Entrer à nouveau votre mot de passe</i>
			</label>
			<input type="password" name="password1" required>
			</br>
			<input type="submit" value="Enregistrer">
			</form>
			<a href="login.php">Login</a>
	</body>
</html>