<?php
include __DIR__ . '/../../../config/db.php';

$termo = trim($_GET['query'] ?? '');

$posts = [];

if ($termo !== '') {
    $stmt = $conn->prepare("
        SELECT 
            post.id,
            post.titulo,
            post.texto,
            post.visualizacoes,
            post.status,
            post.imagem,
            post.criado_em,
            post.atualizado_em,
            categoria.titulo AS categoria,
            CONCAT(usuario.nome, ' ', usuario.sobrenome) AS autor
        FROM post
        INNER JOIN categoria ON post.id_categoria = categoria.id
        INNER JOIN usuario ON post.id_usuario = usuario.id
        WHERE post.titulo LIKE CONCAT('%', ?, '%') OR post.texto LIKE CONCAT('%', ?, '%')
        ORDER BY post.id DESC
        LIMIT 4
    ");
    $stmt->bind_param('ss', $termo, $termo);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($posts);
