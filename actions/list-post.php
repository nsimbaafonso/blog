<?php
include __DIR__ . '/../config/db.php';

$posts = [];

// Busca os posts
$sql = "
    SELECT 
        post.id,
        post.titulo,
        post.texto,
        post.slug,
        post.visualizacoes,
        post.status,
        post.imagem,
        post.criado_em,
        categoria.titulo AS categoria,
        CONCAT(usuario.nome, ' ', usuario.sobrenome) AS autor
    FROM post
    INNER JOIN categoria ON post.id_categoria = categoria.id
    INNER JOIN usuario ON post.id_usuario = usuario.id
    WHERE post.status = 'ativo'
    ORDER BY post.id DESC 
    LIMIT 6
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
