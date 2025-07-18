<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome =  isset($_POST['nome']) ? clearInput($_POST['nome']) : '';
    $sobrenome = isset($_POST['sobrenome']) ? clearInput($_POST['sobrenome']) : '';
    $email = isset($_POST['email']) ? clearInput($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? clearInput($_POST['telefone']) : '';
    $senha = isset($_POST['senha']) ? clearInput($_POST['senha']) : '';
    $confirmaSenha = isset($_POST['confirmaSenha']) ? clearInput($_POST['confirmaSenha']) : '';
    $funcao = isset($_POST['funcao']) ? clearInput($_POST['funcao']) : '';
    $status = isset($_POST['status']) ? clearInput($_POST['status']) : '';
    $imagem = $_FILES['imagem'];

    $temErros = false;
    $formatos = ["jpg", "jpeg", "png", "webp"];
    $extensao = pathinfo($imagem["name"], PATHINFO_EXTENSION);

    // Validação dos campos
    if (empty($nome) && empty($sobrenome) && empty($email) && empty($telefone) && empty($senha) && empty($confirmaSenha) && empty($funcao) && empty($status) && empty($imagem["name"])) {
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
    } else if (empty($senha)) {
        setFlashMessage("O campo senha está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($confirmaSenha)) {
        setFlashMessage("O campo confirma senha está vazio, deve ser preenchido.");
        $temErros = true;
    } else if ($confirmaSenha != $senha) {
        setFlashMessage("As senhas não são iguais, devem ser iguais.");
        $temErros = true;
    } else if (empty($funcao)) {
        setFlashMessage("O campo função está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($status)) {
        setFlashMessage("O campo status está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (empty($imagem["name"])) {
        setFlashMessage("O campo imagem está vazio, deve ser preenchido.");
        $temErros = true;
    } else if ($imagem["size"] > 5 * 1024 * 1024) {
        setFlashMessage("Imagem muito grande. Máximo 5MB.");
        $temErros = true;
    } else if (!in_array($extensao, $formatos)) {
        setFlashMessage("Formato de imagem inválido. Use jpg, jpeg, png, webp.");
        $temErros = true;
    }  

    // Verificação de usuário duplicado
    $stmtEmail = $conn->prepare("SELECT id FROM usuario WHERE email = ?");
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $resultEmail = $stmtEmail->get_result();

    if ($resultEmail->num_rows > 0) {
        setFlashMessage("Já existe um usuário com esse email. Escolha outro email.");
        $temErros = true;
    }

    // Salvar valores no session para reaproveitar no formulário
    $_SESSION['form_data'] = [
        'nome'    => $nome,
        'sobrenome' => $sobrenome,
        'email'    => $email,
        'telefone'     => $telefone,
        'senha'    => $senha,
        'confirmaSenha' => $confirmaSenha,
        'funcao'    => $funcao,
        'status'     => $status
    ];

    // Se não houve erros, cadastrar
    if (!$temErros) {
        $novoNome = uniqid() . '.' . $extensao;
        $uploadPath = __DIR__ . "/../../../uploads/users/" . $novoNome;

        if (move_uploaded_file($imagem["tmp_name"], $uploadPath)) {
            $imagemUpload = $novoNome;
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO usuario (nome, sobrenome, email, telefone, senha, status, id_funcao, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssis", $nome, $sobrenome, $email, $telefone, $senha_hash, $status, $funcao, $imagemUpload);

            if ($stmt->execute()) {
                setFlashMessage("Usuário cadastrado com sucesso.", "success", "fas fa-check-circle");
                $_SESSION['form_data'] = "";
                redirect("http://localhost/blog/dashboard/usuarios/#form");
            } else {
                setFlashMessage("Erro ao cadastrar usuário.");
                redirect("http://localhost/blog/dashboard/usuarios/#form");
            }
        } else {
            setFlashMessage("Erro ao mover a imagem para o diretório de uploads.");
            redirect("http://localhost/blog/dashboard/usuarios/#form");
        }
    } else {
        redirect("http://localhost/blog/dashboard/usuarios/#form");
    }
} else {
    redirect("http://localhost/blog/dashboard/usuarios/#form");
}
