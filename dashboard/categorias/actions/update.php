<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idcategoria = intval(clearInput($_POST['idcategoria']));
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
    /*$stmtCategoria = $conn->prepare("SELECT id FROM categoria WHERE titulo = ?");
    $stmtCategoria->bind_param("s", $titulo);
    $stmtCategoria->execute();
    $resultCategoria = $stmtCategoria->get_result();*/

    if ($resultCategoria->num_rows > 0) {
        setFlashMessage("Já existe uma categoria com esse título. Escolha outro título.");
        $temErros = true;
    }

    // Se não houve erros, cadastrar
    if (!$temErros) {
        
        $stmt = $conn->prepare("UPDATE categoria SET titulo = ?, descricao = ?, status = ?, atualizado_em = current_timestamp() WHERE id = ?");
        $stmt->bind_param("sssi", $titulo, $descricao, $status, $idcategoria);

        if ($stmt->execute()) {
            setFlashMessage("Categoria atualizado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
        } else {
            setFlashMessage("Erro ao atualizar categoria.");
            redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
        }
        
    } else {
        redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
    }
} else {
    redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
}
