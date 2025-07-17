<?php
include __DIR__ . '/../../../config/db.php';

$categorias = [];

// Consulta para obter categorias ativas
$sql = "SELECT id, titulo FROM categoria WHERE status = 'ativo' ORDER BY titulo ASC";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}