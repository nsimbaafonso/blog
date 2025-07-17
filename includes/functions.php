<?php

/**
 * Função que retorna o ano atual
 */
function AnoAtual()
{
    return date("Y");
}

/**
 * Função que faz redirecionamento HTTP
 */
function redirect($string)
{
    return header("Location: $string");
}

/**
 * Função que retorna a data e hora formatada
 * @param string $data a data e hora a ser formatada
 * @return string
 */
function DataHora($data): string
{
    return date("d/m/Y H:i:s", strtotime($data));
}

/**
 * Função que retorna a data formatada
 * @param string $data a data ser formatada
 * @return string
 */
function Data($data): string
{
    return date("d/m/Y", strtotime($data));
}

/**
 * Função que cria slugs
 * @param string $string a string que vai ser transformada em slug
 * @return string
 */
function slug($string): string
{
    // Converte para minúsculas
    $slug = strtolower($string);

    // Remove acentos e caracteres especiais
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);

    // Substitui espaços e caracteres não alfanuméricos por hífen
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);

    // Remove hífens duplicados e do início/fim
    $slug = trim($slug, '-');

    return $slug;
}

/**
 * Função que limpa os inputs
 * @param $input o input a ser limpado
 * @return string 
 */
function clearInput($input): string
{
    // Remove espaços em branco extras e garante que o input seja uma string, mesmo que seja null
    $input = trim($input ?? "");

    // Remove tags HTML e PHP (protege contra XSS)
    $input = strip_tags($input);

    // Converte caracteres especiais (protege contra XSS)
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    // Escapa aspas (protege contra SQL Injection — mas use PDO!)
    $input = addslashes($input);

    return $input;
}

/**
 * Função que faz o resumo dos textos
 * @param string $texto o texto a ser resumido
 * @param int $limite o número de palavras a ser mostrado
 * @return string
 */
function resumirTexto($texto, $limite = 30)
{
    // Remove HTML e quebras de linha
    $textoLimpo = strip_tags($texto);
    $textoLimpo = trim(preg_replace('/\s+/', ' ', $textoLimpo));

    // Divide o texto em palavras
    $palavras = explode(' ', $textoLimpo);

    // Se o número de palavras for menor ou igual ao limite, retorna o texto inteiro
    if (count($palavras) <= $limite) {
        return $textoLimpo;
    }

    // Retorna o resumo com "..." no final
    $resumo = implode(' ', array_slice($palavras, 0, $limite)) . '...';

    return $resumo;
}


function setFlashMessage($mensagem, $tipo = 'error', $icone = 'fas fa-exclamation-circle') {
    $_SESSION['msgs'][] = "
        <div class='alert {$tipo}'>
            <i class='{$icone}'></i>
            <span class='message'>{$mensagem}</span>
            <button class='close-btn'><i class='fas fa-times'></i></button>
        </div>
    ";
}

