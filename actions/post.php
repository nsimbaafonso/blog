<?php
include __DIR__ . '/../config/db.php';

$post = null;

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = $conn->real_escape_string($_GET['slug']);

    $sql = "SELECT post.id, post.titulo, post.texto, post.slug, post.visualizacoes, post.status, post.imagem,
                   post.criado_em, post.atualizado_em, categoria.titulo AS categoria,
                   CONCAT(usuario.nome, ' ', usuario.sobrenome) AS autor
            FROM post
            INNER JOIN categoria ON post.id_categoria = categoria.id
            INNER JOIN usuario ON post.id_usuario = usuario.id
            WHERE post.slug = '$slug' LIMIT 1";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();

        // Atualiza visualizações
        $conn->query("UPDATE post SET visualizacoes = visualizacoes + 1 WHERE slug = '$slug'");
    }
} else {
    redirect("http://localhost/blog");
}

