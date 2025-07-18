<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idusuario = intval(clearInput($_POST['idusuario']));
    $nome =  isset($_POST['nome']) ? clearInput($_POST['nome']) : '';
    $sobrenome = isset($_POST['sobrenome']) ? clearInput($_POST['sobrenome']) : '';
    $email = isset($_POST['email']) ? clearInput($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? clearInput($_POST['telefone']) : '';
    $funcao = isset($_POST['funcao']) ? clearInput($_POST['funcao']) : '';
    $status = isset($_POST['status']) ? clearInput($_POST['status']) : '';

    $temErros = false;

    // Validação dos campos
    if (empty($nome) && empty($sobrenome) && empty($email) && empty($telefone) && empty($funcao) && empty($status)) {
        setFlashMessage("Os campos estão vazios, devem ser preenchidos.");
        $temErros = true;
    } else if (empty($nome)) {
        setFlashMessage("O campo nome está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($sobrenome)) {
        setFlashMessage("O campo sobrenome está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($email)) {
        setFlashMessage("O campo email está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
        setFlashMessage("O email é inválido, digite um email válido.");
        $temErros = true;
    } else if (empty($telefone)) {
        setFlashMessage("O campo telefone está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($funcao)) {
        setFlashMessage("O campo função está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($status)) {
        setFlashMessage("O campo status está vazio, deve ser preenchido.");
        $temErros = true;
    }  

    // Verificação de usuário duplicado
    /*$stmtEmail = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $resultEmail = $stmtEmail->get_result();

    if ($resultEmail->num_rows > 0) {
        setFlashMessage("Já existe um usuário com esse email. Escolha outro email.");
        $temErros = true;
    }*/

    // Se não houve erros, cadastrar
    if (!$temErros) {

        $stmt = $conn->prepare("UPDATE usuario SET nome = ?, sobrenome = ?, email = ?, telefone = ?, status = ?, id_funcao = ?, atualizado_em = current_timestamp() WHERE id = ?");
        $stmt->bind_param("sssssii", $nome, $sobrenome, $email, $telefone, $status, $funcao, $idusuario);

        if ($stmt->execute()) {
            setFlashMessage("Usuário atualizado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/usuarios/editar?id=".$idusuario);
        } else {
            setFlashMessage("Erro ao atualizar usuário.");
            redirect("http://localhost/blog/dashboard/usuarios/editar?id=".$idusuario);
        }
    } else {
        redirect("http://localhost/blog/dashboard/usuarios/editar?id=".$idusuario);
    }
} else {
    redirect("http://localhost/blog/dashboard/usuarios/editar?id=".$idusuario);
}
