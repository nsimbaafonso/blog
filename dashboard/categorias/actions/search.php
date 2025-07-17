<?php
include __DIR__ . '/../../../config/db.php';

$termo = trim($_GET['query'] ?? '');

$categorias = [];

if ($termo !== '') {
    $stmt = $conn->prepare("
        SELECT 
            id,
            titulo,
            descricao,
            status,
            criado_em,
            atualizado_em
        FROM categoria
        WHERE titulo LIKE CONCAT('%', ?, '%') OR descricao LIKE CONCAT('%', ?, '%')
        ORDER BY id DESC
        LIMIT 4
    ");
    $stmt->bind_param('ss', $termo, $termo);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($categorias);
