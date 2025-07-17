<?php
include __DIR__ . '/../../../config/db.php';

$termo = trim($_GET['query'] ?? '');

$newsletters = [];

if ($termo !== '') {
    $stmt = $conn->prepare("
        SELECT 
            id,
            email,
            status,
            criado_em,
            atualizado_em
        FROM newsletter
        WHERE email LIKE CONCAT('%', ?, '%')
        ORDER BY id DESC
        LIMIT 4
    ");
    $stmt->bind_param('s', $termo);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $newsletters[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($newsletters);
