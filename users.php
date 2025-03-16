<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Conteneur principal */
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        /* Titre */
        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Groupe d'entrée */
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        /* Labels */
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Champs de saisie */
        input[type="text"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Bouton de soumission */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        /* Effet au survol */
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="users.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-group">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" required>
            </div>

            <div class="input-group">
                <label for="login">Login:</label>
                <input type="text" name="login" required>
            </div>

            <div class="input-group">
                <label for="profil">Profil (Image):</label>
                <input type="file" name="profil" accept="image/*" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "users";
$connexion = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$connexion) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérifier que tous les champs sont remplis
if (!empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_FILES['profil']['name'])) {
    
    // Récupération et nettoyage des données
    $name = htmlspecialchars(trim($_POST['name']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $login = htmlspecialchars(trim($_POST['login']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash du mot de passe

    // Gestion de l’upload du fichier image
    $target_dir = "uploads/";  // Dossier où stocker les images
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Création du dossier s'il n'existe pas
    }

    $file_name = basename($_FILES["profil"]["name"]);
    $file_path = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image valide
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (in_array($file_type, $allowed_types)) {
        if (move_uploaded_file($_FILES["profil"]["tmp_name"], $file_path)) {
            // Insérer les données dans la base
            $stmt = $connexion->prepare("INSERT INTO user (name, firstname, login, profil, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $firstname, $login, $file_path, $password);

            if ($stmt->execute()) {
                echo "Inscription réussie!";
            } else {
                echo "Erreur: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    }
} else {
    echo "Vous devez remplir tous les champs.";
}

$connexion->close();
?>
