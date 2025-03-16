<?php
$conn = new mysqli("localhost", "root", "", "users");
if ($conn->connect_error) { die("Échec de la connexion : " . $conn->connect_error); }

$id = intval($_GET["id"]);
$result = $conn->query("SELECT * FROM user WHERE ID = $id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $firstname = $conn->real_escape_string($_POST["firstname"]);
    $login = $conn->real_escape_string($_POST["login"]);
    $profil = $conn->real_escape_string($_POST["profil"]);

    $conn->query("UPDATE user SET name='$name', firstname='$firstname', login='$login', profil='$profil' WHERE ID=$id");
    header("Location: affichage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
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
input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Bouton Modifier */
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

/* Lien retour */
.back-link {
    display: block;
    margin-top: 15px;
    color: #6a0dad;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.back-link:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <h2>Modifier l'utilisateur</h2>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user["name"]) ?>" required><br>
        <label>Prénom :</label>
        <input type="text" name="firstname" value="<?= htmlspecialchars($user["firstname"]) ?>" required><br>
        <label>Login :</label>
        <input type="text" name="login" value="<?= htmlspecialchars($user["login"]) ?>" required><br>
        <label>Profil :</label>
        <input type="text" name="profil" value="<?= htmlspecialchars($user["profil"]) ?>" required><br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>

<?php $conn->close(); ?>
