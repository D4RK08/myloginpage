<?php

// Connessione al database
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'login';

$conn = mysqli_connect($host, $user, $password, $dbname);

// Verifica della connessione
if (!$conn) {
    die('Errore di connessione: ' . mysqli_connect_error());
}

// Gestione del form di login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupero i dati del form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Verifica dei dati di login nel database
    $query = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login riuscito, imposto la sessione e reindirizzo alla pagina protetta
        session_start();
        $_SESSION['logged_in'] = true;
        header('Location: Area_Protetta');
        exit;
    } else {
        // Login fallito, visualizzo un messaggio di errore
        $error_message = 'Username o password non validi';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pagina di login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-form">
    <form action="login.php" method="post">
        <h2>Pagina di login</h2>
        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Accedi</button>
    </form>
</div>

</body>
</html>
