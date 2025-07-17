<?php
include __DIR__ . '/../../../config/db.php';

$categorias = [];
$limite = 5;
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($pagina - 1) * $limite;

// Total de categorias
$sqlTotal = "SELECT COUNT(*) AS total FROM categoria";
$totalCategorias = $conn->query($sqlTotal)->fetch_assoc()['total'] ?? 0;

// Total de categorias ativos
$sqlAtivos = "SELECT COUNT(*) AS ativos FROM categoria WHERE status = 'ativo'";
$totalAtivos = $conn->query($sqlAtivos)->fetch_assoc()['ativos'] ?? 0;

// Total de categorias inativos
$sqlInativos = "SELECT COUNT(*) AS inativos FROM categoria WHERE status = 'inativo'";
$totalInativos = $conn->query($sqlInativos)->fetch_assoc()['inativos'] ?? 0;

$totalPaginas = ceil($totalCategorias / $limite);

// Busca os categorias com paginação
$sql = "
    SELECT 
        id,
        titulo,
        descricao,
        status,
        criado_em,
        atualizado_em
    FROM categoria
    ORDER BY categoria.id DESC
    LIMIT $limite OFFSET $offset
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

