<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusuario = intval(clearInput($_POST['idusuario']));

    //Buscar nome da imagem do post
    $stmt = $conn->prepare("SELECT imagem FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Deletar a imagem do diretório se existir
        if (!empty($usuario['imagem'])) {
            $caminhoImagem = __DIR__ . '/../../../uploads/users/' . $usuario['imagem'];
            if (file_exists($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }

        //Deletar o post do banco de dados
        $stmtDelete = $conn->prepare("DELETE FROM usuario WHERE id = ?");
        $stmtDelete->bind_param("i", $idusuario);

        if ($stmtDelete->execute()) {
            setFlashMessage("Usuário eliminado com sucesso.", "success", "fas fa-check-circle");
            redirect("/blog/dashboard/usuarios/#form");
        } else {
            setFlashMessage("Erro ao eliminar o post.");
            redirect("/blog/dashboard/usuarios/eliminar?id=".$idusuario);
        }

    } else {
        setFlashMessage("Usuário não encontrado.");
        redirect("/blog/dashboard/usuarios/eliminar?id=".$idusuario);
    }

} else {
    redirect("/blog/dashboard/usuarios/eliminar?id=".$idusuario);
}
