<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idnewsletter = intval(clearInput($_POST['idnewsletter']));

    $temErros = false;

    // Se não houve erros, cadastrar
    if (!$temErros) {
        
        $stmt = $conn->prepare("DELETE FROM newsletter WHERE id = ?");
        $stmt->bind_param("i", $idnewsletter);

        if ($stmt->execute()) {
            setFlashMessage("Newsletter eliminado com sucesso.", "success", "fas fa-check-circle");
            redirect("http://localhost/blog/dashboard/newsletter/#form");
        } else {
            setFlashMessage("Erro ao eliminar newsletter.");
            redirect("http://localhost/blog/dashboard/newsletter/eliminar?id=".$idnewsletter);
        }
        
    } else {
        redirect("http://localhost/blog/dashboard/newsletter/eliminar?id=".$idnewsletter);
    }
} else {
    redirect("http://localhost/blog/dashboard/newsletter/eliminar?id=".$idnewsletter);
}
