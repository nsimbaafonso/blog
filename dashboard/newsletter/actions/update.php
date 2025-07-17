<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idnewsletter = intval(clearInput($_POST['idnewsletter']));
    $email = isset($_POST['email']) ? clearInput($_POST['email']) : '';
    $status = isset($_POST['status']) ? clearInput($_POST['status']) : '';

    $temErros = false;

    // Validação dos campos
    if (empty($email) && empty($email)) {
        setFlashMessage("Os campos estão vazios, devem ser preenchidos.");
        $temErros = true;
    } else if (empty($email)) {
        setFlashMessage("O campo email está vazio, deve ser preenchido.");
        $temErros = true;
    } else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
        setFlashMessage("O email é inválido, digite um email válido.");
        $temErros = true;
    } else if (empty($status)) {
        setFlashMessage("O campo status está vazio, deve ser preenchido.");
        $temErros = true;
    }

    // Verificação de newsletter duplicado
    /*$stmtNewsletter = $conn->prepare("SELECT id FROM newsletter WHERE email = ?");
    $stmtNewsletter->bind_param("s", $email);
    $stmtNewsletter->execute();
    $resultNewsletter = $stmtNewsletter->get_result();

    if ($resultNewsletter->num_rows > 0) {
        setFlashMessage("Já existe um newsletter com esse email. Escolha outro email.");
        $temErros = true;
    }*/

    // Salvar valores no session para reaproveitar no formulário
    $_SESSION['form_data'] = [
        'email'    => $email,
        'status'    => $status,
    ];

    // Se não houve erros, cadastrar
    if (!$temErros) {
        
        $stmt = $conn->prepare("UPDATE newsletter SET email = ?, status = ?, atualizado_em = current_timestamp() WHERE id = ?");
        $stmt->bind_param("ssi", $email, $status, $idnewsletter);

        if ($stmt->execute()) {
            setFlashMessage("Newsletter atualizado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/newsletter/editar?id=".$idnewsletter);
        } else {
            setFlashMessage("Erro ao atualizar newsletter.");
            redirect("http://localhost/blog/dashboard/newsletter/editar?id=".$idnewsletter);
        }
        
    } else {
        redirect("http://localhost/blog/dashboard/newsletter/editar?id=".$idnewsletter);
    }
} else {
    redirect("http://localhost/blog/dashboard/newsletter/editar?id=".$idnewsletter);
}
