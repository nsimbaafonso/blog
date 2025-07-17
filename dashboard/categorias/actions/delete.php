<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idcategoria = intval(clearInput($_POST['idcategoria']));

    $temErros = false;

    // Se não houve erros, cadastrar
    if (!$temErros) {
        
        $stmt = $conn->prepare("DELETE FROM categoria WHERE id = ?");
        $stmt->bind_param("i", $idcategoria);

        if ($stmt->execute()) {
            setFlashMessage("Categoria eliminado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/categorias/#form");
        } else {
            setFlashMessage("Erro ao eliminar categoria.");
            redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
        }
        
    } else {
        redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
    }
} else {
    redirect("http://localhost/blog/dashboard/categorias/editar?id=".$idcategoria);
}
