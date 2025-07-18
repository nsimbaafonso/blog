<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idusuario = intval(clearInput($_POST['idusuario']));
    $senha = isset($_POST['senha']) ? clearInput($_POST['senha']) : '';
    $confirmaSenha = isset($_POST['confirmaSenha']) ? clearInput($_POST['confirmaSenha']) : '';

    $temErros = false;

    // Validação dos campos
    if (empty($senha) && empty($confirmaSenha)) {
        setFlashMessage("Os campos estão vazios, devem ser preenchidos.");
        $temErros = true;
    } else if (empty($senha)) {
        setFlashMessage("O campo senha está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($confirmaSenha)) {
        setFlashMessage("O campo confirma senha está vazio, deve ser preenchido.");
        $temErros = true;
    } else if ($confirmaSenha != $senha) {
        setFlashMessage("As senhas não são iguais, devem ser iguais.");
        $temErros = true;
    }  

    // Se não houve erros, cadastrar
    if (!$temErros) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE usuario SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $senha_hash, $idusuario);

        if ($stmt->execute()) {
            setFlashMessage("Senha do usuário alterado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/usuarios/editar?id=" . $idusuario);
        } else {
            setFlashMessage("Erro ao alterar senha do usuário.");
            redirect("http://localhost/blog/dashboard/usuarios/editar?id=" . $idusuario);
        }
    } else {
        redirect("http://localhost/blog/dashboard/usuarios/editar?id=" . $idusuario);
    }
} else {
    redirect("http://localhost/blog/dashboard/usuarios/editar?id=" . $idusuario);
}
