<?php
include __DIR__ . '/../../../config/db.php'; // sua conexão via new mysqli

$sql = "
    SELECT c.titulo AS categoria, COUNT(p.id) AS total_posts
    FROM categoria c
    LEFT JOIN post p ON p.id_categoria = c.id AND p.status = 'ativo'
    WHERE c.status = 'ativo'
    GROUP BY c.id
    ORDER BY total_posts DESC
    LIMIT 5
";

$result = $conn->query($sql);
$categorias = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($categorias);
