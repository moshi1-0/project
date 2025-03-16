<?php
session_start();

// Connexion à la base de données avec MySQLi
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "users";

$connexion = new mysqli($db_server, $db_user, $db_pass, $db_name);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des entrées utilisateur
    $login = htmlspecialchars(trim($_POST["login"]));
    $password = $_POST["password"]; // NE PAS HASHER ICI !

    // Préparer la requête SQL
    $stmt = $connexion->prepare("SELECT id, name, profil, password FROM user WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Vérification du mot de passe
    if ($user && password_verify($password, $user["password"])) {
        // Stocker les infos de l'utilisateur dans la session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_profil"] = $user["profil"];

        // Redirection selon le profil
        if ($_SESSION["user_profil"] === "admin") {
            header("Location: admin.php");
        } else {
            header("Location: log.html");
        }
        exit();
    } else {
        echo "<p style='color: red;'>Login ou mot de passe incorrect.</p>";
    }

    // Fermer la requête
    $stmt->close();
}

// Fermer la connexion à la base de données
$connexion->close();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles généraux */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Conteneur du formulaire */
.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
}

/* Titre */
h2 {
    margin-bottom: 20px;
    color: #6a0dad;
}

/* Styles des labels */
label {
    display: block;
    text-align: left;
    font-weight: bold;
    margin: 10px 0 5px;
}

/* Champs de saisie */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Bouton de connexion */
input[type="submit"] {
    background: #6a0dad;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    margin-top: 15px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: #580a9a;
}

/* Lien d'inscription */
p {
    margin-top: 15px;
}

a {
    color: #6a0dad;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="login">login :</label>
                <input type="text" name="login" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Se connecter">
        </form>
      
    </div>
</body>
</html>