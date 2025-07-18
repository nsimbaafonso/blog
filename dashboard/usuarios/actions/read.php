<?php
include __DIR__ . '/../../../config/db.php';

$usuarios = [];
$limite = 5;
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($pagina - 1) * $limite;

// Total de posts
$sqlTotal = "SELECT COUNT(*) AS total FROM usuario";
$totalUsuarios = $conn->query($sqlTotal)->fetch_assoc()['total'] ?? 0;

// Total de posts ativos
$sqlAtivos = "SELECT COUNT(*) AS ativos FROM usuario WHERE status = 'ativo'";
$totalAtivos = $conn->query($sqlAtivos)->fetch_assoc()['ativos'] ?? 0;

// Total de posts inativos
$sqlInativos = "SELECT COUNT(*) AS inativos FROM usuario WHERE status = 'inativo'";
$totalInativos = $conn->query($sqlInativos)->fetch_assoc()['inativos'] ?? 0;

$totalPaginas = ceil($totalUsuarios / $limite);

// Busca os usuários com paginação
$sql = "
    SELECT 
        usuario.id,
        usuario.nome,
        usuario.sobrenome,
        usuario.email,
        usuario.telefone,
        usuario.status,
        usuario.imagem,
        usuario.criado_em,
        usuario.atualizado_em,
        funcao.nome AS funcao_usuario
    FROM usuario
    INNER JOIN funcao ON usuario.id_funcao = funcao.id
    ORDER BY usuario.id DESC
    LIMIT $limite OFFSET $offset
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

