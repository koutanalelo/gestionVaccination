<?php
include 'connexion.php';

$id_parent = $_GET['id_parent'] ?? null;

if ($id_parent) {
    $stmt = $conn->prepare("SELECT * FROM bebe WHERE id_parent = ?");
    $stmt->execute([$id_parent]);

    $bebes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($bebes);
} else {
    echo json_encode([]);
}
?>
