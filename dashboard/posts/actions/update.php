<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idpost = intval(clearInput($_POST['idpost']));
    $titulo = isset($_POST['titulo']) ? clearInput($_POST['titulo']) : '';
    $categoria = isset($_POST['categoria']) ? clearInput($_POST['categoria']) : '';
    $status = isset($_POST['status']) ? clearInput($_POST['status']) : '';
    $texto = isset($_POST['texto']) ? clearInput($_POST['texto']) : '';

    $temErros = false;

    // Validação dos campos
    if (empty($titulo) && empty($categoria) && empty($status) && empty($imagem["name"]) && empty($texto)) {
        setFlashMessage("Os campos estão vazios, devem ser preenchidos.");
        $temErros = true;
    } else if (empty($titulo)) {
        setFlashMessage("O campo título está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($categoria)) {
        setFlashMessage("O campo categoria está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (!preg_match("/^\d+$/", $categoria)) {
        setFlashMessage("Categoria inválida.");
        $temErros = true;
    } else if (empty($status)) {
        setFlashMessage("O campo status está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($texto)) {
        setFlashMessage("O campo texto está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (strlen($texto) < 50) {
        setFlashMessage("O texto deve ter pelo menos 50 caracteres.");
        $temErros = true;
    }

    // Verificação de slug duplicado
    $slug = slug($titulo);

    // Se não houve erros, cadastrar
    if (!$temErros) {
        $stmt = $conn->prepare("UPDATE post SET titulo = ?, texto = ?, slug = ?, status = ?, id_categoria = ?, atualizado_em = current_timestamp() WHERE id = ?");
        $stmt->bind_param("ssssii", $titulo, $texto, $slug, $status, $categoria, $idpost);

        if ($stmt->execute()) {
            setFlashMessage("Post atualizado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/posts/editar?id=".$idpost);
        } else {
            setFlashMessage("Erro ao atualizar post.");
            redirect("http://localhost/blog/dashboard/posts/editar?id=".$idpost);
        }
        
    } else {
        redirect("http://localhost/blog/dashboard/posts/editar?id=".$idpost);
    }
} else {
    redirect("http://localhost/blog/dashboard/posts/editar?id=".$idpost);
}
