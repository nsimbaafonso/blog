<?php

error_reporting(0);       // Desativa todos os tipos de erro
ini_set('display_errors', 0); // Impede que eles sejam exibidos na tela

define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/');

// Caminho base absoluto do site na aplicação
define('BASE_SITE_URL', '/blog/');

// Caminho base absoluto do dashboard na aplicação
define('BASE_DASHBOARD_URL', '/blog/dashboard/');


