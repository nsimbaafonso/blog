<?php
session_start();

include __DIR__ . '/../../../config/db.php';
include __DIR__ . '/../../../includes/functions.php';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $idusuario = intval(clearInput($_POST['idusuario']));
    $titulo = isset($_POST['titulo']) ? clearInput($_POST['titulo']) : '';
    $categoria = isset($_POST['categoria']) ? clearInput($_POST['categoria']) : '';
    $status = isset($_POST['status']) ? clearInput($_POST['status']) : '';
    $imagem = $_FILES['imagem'];
    $texto = isset($_POST['texto']) ? clearInput($_POST['texto']) : '';

    $temErros = false;
    $formatos = ["jpg", "jpeg", "png", "webp"];
    $extensao = pathinfo($imagem["name"], PATHINFO_EXTENSION);

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
    } else if (empty($imagem["name"])) {
        setFlashMessage("O campo imagem está vazio, deve ser preenchido.");
        $temErros = true;
    } else if ($imagem["size"] > 5 * 1024 * 1024) {
        setFlashMessage("Imagem muito grande. Máximo 5MB.");
        $temErros = true;
    } else if (!in_array($extensao, $formatos)) {
        setFlashMessage("Formato de imagem inválido. Use jpg, jpeg, png, webp.");
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
    $stmtSlug = $conn->prepare("SELECT id FROM post WHERE slug = ?");
    $stmtSlug->bind_param("s", $slug);
    $stmtSlug->execute();
    $resultSlug = $stmtSlug->get_result();

    if ($resultSlug->num_rows > 0) {
        setFlashMessage("Já existe um post com esse título. Escolha outro título.");
        $temErros = true;
    }

    // Salvar valores no session para reaproveitar no formulário
    $_SESSION['form_data'] = [
        'titulo'    => $titulo,
        'categoria' => $categoria,
        'status'    => $status,
        'texto'     => $texto
    ];

    // Se não houve erros, cadastrar
    if (!$temErros) {
        $novoNome = uniqid() . '.' . $extensao;
        $uploadPath = __DIR__ . "/../../../uploads/posts/" . $novoNome;

        if (move_uploaded_file($imagem["tmp_name"], $uploadPath)) {
            $imagemUpload = $novoNome;
            $stmt = $conn->prepare("INSERT INTO post (titulo, texto, slug, status, id_categoria, id_usuario, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiis", $titulo, $texto, $slug, $status, $categoria, $idusuario, $imagemUpload);

            if ($stmt->execute()) {
                setFlashMessage("Post cadastrado com sucesso.", "success", "fas fa-check-circle");
                $_SESSION['form_data'] = "";
                redirect("http://localhost/blog/dashboard/posts/#form");
            } else {
                setFlashMessage("Erro ao cadastrar post.");
                redirect("http://localhost/blog/dashboard/posts/#form");
            }
        } else {
            setFlashMessage("Erro ao mover a imagem para o diretório de uploads.");
            redirect("http://localhost/blog/dashboard/posts/#form");
        }
    } else {
        redirect("http://localhost/blog/dashboard/posts/#form");
    }
} else {
    redirect("http://localhost/blog/dashboard/posts/#form");
}
