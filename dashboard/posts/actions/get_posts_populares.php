<?php
include __DIR__ . '/../../../config/db.php';

$periodo = $_GET['periodo'] ?? '7';

switch ($periodo) {
    case '30':
        $interval = 'INTERVAL 30 DAY';
        break;
    case 'ano':
        $interval = 'INTERVAL 1 YEAR';
        break;
    default:
        $interval = 'INTERVAL 7 DAY';
}

$sql = "
    SELECT titulo, visualizacoes
    FROM post
    WHERE status = 'ativo'
      AND criado_em >= NOW() - $interval
    ORDER BY visualizacoes DESC
    LIMIT 6
";

$result = $conn->query($sql);
$posts = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($posts);
