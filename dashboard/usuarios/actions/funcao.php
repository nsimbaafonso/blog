<?php
include __DIR__ . '/../../../config/db.php';

$funcoes = [];

// Consulta para obter funções
$sql = "SELECT id, nome FROM funcao ORDER BY nome ASC";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $funcoes[] = $row;
    }
}