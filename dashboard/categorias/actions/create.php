<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $titulo = isset($_POST['titulo']) ? clearInput($_POST['titulo']) : '';
    $status = isset($_POST['status']) ? clearInput($_POST['status']) : '';
    $descricao = isset($_POST['descricao']) ? clearInput($_POST['descricao']) : '';

    $temErros = false;

    // Validação dos campos
    if (empty($titulo) && empty($status) && empty($descricao)) {
        setFlashMessage("Os campos estão vazios, devem ser preenchidos.");
        $temErros = true;
    } else if (empty($titulo)) {
        setFlashMessage("O campo título está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($status)) {
        setFlashMessage("O campo status está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($descricao)) {
        setFlashMessage("O campo descrição está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (strlen($descricao) < 20) {
        setFlashMessage("A descrição deve ter pelo menos 20 caracteres.");
        $temErros = true;
    }

    // Verificação de categoria duplicado
    $stmtCategoria = $conn->prepare("SELECT id FROM categoria WHERE titulo = ?");
    $stmtCategoria->bind_param("s", $titulo);
    $stmtCategoria->execute();
    $resultCategoria = $stmtCategoria->get_result();

    if ($resultCategoria->num_rows > 0) {
        setFlashMessage("Já existe uma categoria com esse título. Escolha outro título.");
        $temErros = true;
    }

    // Salvar valores no session para reaproveitar no formulário
    $_SESSION['form_data'] = [
        'titulo'    => $titulo,
        'status'    => $status,
        'descricao' => $descricao
    ];

    // Se não houve erros, cadastrar
    if (!$temErros) {
        
        $stmt = $conn->prepare("INSERT INTO categoria (titulo, descricao, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $titulo, $descricao, $status);

        if ($stmt->execute()) {
            setFlashMessage("Categoria cadastrado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/categorias/#form");
        } else {
            setFlashMessage("Erro ao cadastrar categoria.");
            redirect("http://localhost/blog/dashboard/categorias/#form");
        }
        
    } else {
        redirect("http://localhost/blog/dashboard/categorias/#form");
    }
} else {
    redirect("http://localhost/blog/dashboard/categorias/#form");
}
