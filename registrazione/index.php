<?php

if(isset($_POST['submit'])) {
  // Recupera i dati del form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connessione al database
  $conn = mysqli_connect('127.0.0.1', 'root', '', 'login');

  // Inserimento dei dati nella tabella
  $query = "INSERT INTO utenti (username, password) VALUES ('$username', '$password')";
  mysqli_query($conn, $query);

  // Redirect alla pagina di login
  header('Location: login.php');
}

?>
<link rel="stylesheet" href="style.css">
<!-- Modulo di registrazione -->
<form method="post" action="">
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <input type="submit" name="submit" value="Registrati">
</form>
