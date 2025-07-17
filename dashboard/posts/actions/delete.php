<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpost = intval(clearInput($_POST['idpost']));

    //Buscar nome da imagem do post
    $stmt = $conn->prepare("SELECT imagem FROM post WHERE id = ?");
    $stmt->bind_param("i", $idpost);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();

        // Deletar a imagem do diretório se existir
        if (!empty($post['imagem'])) {
            $caminhoImagem = __DIR__ . '/../../../uploads/posts/' . $post['imagem'];
            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }

        //Deletar o post do banco de dados
        $stmtDelete = $conn->prepare("DELETE FROM post WHERE id = ?");
        $stmtDelete->bind_param("i", $idpost);

        if ($stmtDelete->execute()) {
            setFlashMessage("Post eliminado com sucesso.", "success", "fas fa-check-circle");
            redirect("/blog/dashboard/posts/#form");
        } else {
            setFlashMessage("Erro ao eliminar o post.");
            redirect("/blog/dashboard/posts/eliminar?id=".$idpost);
        }

    } else {
        setFlashMessage("Post não encontrado.");
        redirect("/blog/dashboard/posts/eliminar?id=".$idpost);
    }

} else {
    redirect("/blog/dashboard/posts/eliminar?id=".$idpost);
}
