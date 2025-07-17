<?php
include __DIR__ . '/../../../config/db.php';

$newsletters = [];
$limite = 5;
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($pagina - 1) * $limite;

// Total de newletters
$sqlTotal = "SELECT COUNT(*) AS total FROM newsletter";
$totalNewletters = $conn->query($sqlTotal)->fetch_assoc()['total'] ?? 0;

// Total de newsletters ativos
$sqlAtivos = "SELECT COUNT(*) AS ativos FROM newsletter WHERE status = 'ativo'";
$totalAtivos = $conn->query($sqlAtivos)->fetch_assoc()['ativos'] ?? 0;

// Total de newsletters inativos
$sqlInativos = "SELECT COUNT(*) AS inativos FROM newsletter WHERE status = 'inativo'";
$totalInativos = $conn->query($sqlInativos)->fetch_assoc()['inativos'] ?? 0;

$totalPaginas = ceil($totalNewletters / $limite);

// Busca os newsletters com paginação
$sql = "
    SELECT 
        id,
        email,
        status,
        criado_em,
        atualizado_em
    FROM newsletter
    ORDER BY id DESC
    LIMIT $limite OFFSET $offset
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsletters[] = $row;
    }
}

