<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <style>
        /* Style du tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            background-color: white;
            color: black;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table th {
            background-color: #6a0dad;
            color: white;
            padding: 12px;
            text-transform: uppercase;
        }

        table td, table th {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
            transition: 0.3s;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        .edit {
            background-color: #28a745;
        }

        .delete {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h2>Liste des utilisateurs</h2>

<?php
// Connexion à la base de données
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "users";

$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Requête SQL
$sql = "SELECT * FROM user WHERE profil <>'admin'";
$result = $conn->query($sql);

// Affichage des résultats
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Login</th><th>Profil</th><th>Actions</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . htmlspecialchars($row["ID"]) . "</td>
        <td>" . htmlspecialchars($row["name"]) . "</td>
        <td>" . htmlspecialchars($row["firstname"]) . "</td>
        <td>" . htmlspecialchars($row["login"]) . "</td>
        <td><img src='" . htmlspecialchars($row["profil"]) . "' alt='Profil' width='100'></td>
        <td>
            <a href='modif.php?id=" . $row["ID"] . "' class='btn edit'>Modifier</a>
            <a href='supp.php?id=" . $row["ID"] . "' class='btn delete' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\")'>Supprimer</a>
        </td>
      </tr>";

    }
    echo "</table>";
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermer la connexion
$conn->close();
?>

</body>
</html>
