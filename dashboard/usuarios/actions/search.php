<?php
include __DIR__ . '/../../../config/db.php';

$termo = trim($_GET['query'] ?? '');

$usuarios = [];

if ($termo !== '') {
    $stmt = $conn->prepare("
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
        WHERE usuario.nome LIKE CONCAT('%', ?, '%') OR usuario.sobrenome LIKE CONCAT('%', ?, '%')
        ORDER BY usuario.id DESC
        LIMIT 4
    ");
    $stmt->bind_param('ss', $termo, $termo);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($usuarios);
