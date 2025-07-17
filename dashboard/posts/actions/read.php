<?php
include __DIR__ . '/../../../config/db.php';

$posts = [];
$limite = 5;
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($pagina - 1) * $limite;

// Total de posts
$sqlTotal = "SELECT COUNT(*) AS total FROM post";
$totalPosts = $conn->query($sqlTotal)->fetch_assoc()['total'] ?? 0;

// Total de posts ativos
$sqlAtivos = "SELECT COUNT(*) AS ativos FROM post WHERE status = 'ativo'";
$totalAtivos = $conn->query($sqlAtivos)->fetch_assoc()['ativos'] ?? 0;

// Total de posts inativos
$sqlInativos = "SELECT COUNT(*) AS inativos FROM post WHERE status = 'inativo'";
$totalInativos = $conn->query($sqlInativos)->fetch_assoc()['inativos'] ?? 0;

$totalPaginas = ceil($totalPosts / $limite);

// Busca os posts com paginação
$sql = "
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
    ORDER BY post.id DESC
    LIMIT $limite OFFSET $offset
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

