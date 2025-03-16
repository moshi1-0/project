<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: log.php");
    exit();
}

// Vérifier si l'utilisateur est admin
if ($_SESSION["user_profil"] !== "admin") {
    echo "<p style='color: red;'>Accès refusé. Seuls les administrateurs ont accès à cette page.</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Admin</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            margin-top: 50px;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION["user_name"]); ?> !</h1>
        <h2>Tableau de bord de l'Administrateur</h2>
        <a href="affichage.php">Gérer les Utilisateurs</a>
        <a href="users.php">creation Utilisateurs</a>
        <a href="log.php" style="background-color: red;">Se Déconnecter</a>
    </div>
</body>
</html>
