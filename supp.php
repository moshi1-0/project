<?php
$conn = new mysqli("localhost", "root", "", "users");
if ($conn->connect_error) { die("Échec de la connexion : " . $conn->connect_error); }

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $conn->query("DELETE FROM user WHERE ID = $id");
    header("Location: affichage.php");
    exit();
}

$conn->close();
?>
