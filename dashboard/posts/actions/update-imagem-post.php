<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idpost = intval(clearInput($_POST['idpost']));
    $imagem = $_FILES['imagem'];

    $temErros = false;
    $formatos = ["jpg", "jpeg", "png", "webp"];
    $extensao = pathinfo($imagem["name"], PATHINFO_EXTENSION);

    // Validação
    if (empty($imagem["name"])) {
        setFlashMessage("O campo imagem está vazio, deve ser preenchido.");
        $temErros = true;
    } else if ($imagem["size"] > 5 * 1024 * 1024) {
        setFlashMessage("Imagem muito grande. Máximo 5MB.");
        $temErros = true;
    } else if (!in_array(strtolower($extensao), $formatos)) {
        setFlashMessage("Formato de imagem inválido. Use jpg, jpeg, png, webp.");
        $temErros = true;
    }

    if (!$temErros) {
        //Buscar imagem atual no banco
        $stmt = $conn->prepare("SELECT imagem FROM post WHERE id = ?");
        $stmt->bind_param("i", $idpost);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        if ($post && !empty($post['imagem'])) {
            $caminhoAntigo = __DIR__ . "/../../../uploads/posts/" . $post['imagem'];
            
            // 2. Apagar imagem antiga, se existir
            if (file_exists($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }
        }

        // Salvar nova imagem
        $novoNome = uniqid() . '.' . $extensao;
        $uploadPath = __DIR__ . "/../../../uploads/posts/" . $novoNome;

        if (move_uploaded_file($imagem["tmp_name"], $uploadPath)) {
            $stmt = $conn->prepare("UPDATE post SET imagem = ?, atualizado_em = current_timestamp() WHERE id = ?");
            $stmt->bind_param("si", $novoNome, $idpost);

            if ($stmt->execute()) {
                setFlashMessage("Imagem do post atualizada com sucesso.", "success", "fas fa-check-circle");
                redirect("http://localhost/blog/dashboard/posts/editar?id=" . $idpost);
            } else {
                setFlashMessage("Erro ao atualizar a imagem no banco de dados.");
                redirect("http://localhost/blog/dashboard/posts/editar?id=" . $idpost);
            }
        } else {
            setFlashMessage("Erro ao mover a nova imagem para o diretório.");
            redirect("http://localhost/blog/dashboard/posts/editar?id=" . $idpost);
        }
    } else {
        redirect("http://localhost/blog/dashboard/posts/editar?id=" . $idpost);
    }
} else {
    redirect("http://localhost/blog/dashboard/posts/");
}
