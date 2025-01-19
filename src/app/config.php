<?php

if (!defined('DIR')) {
	define('DIR', realpath(dirname(__FILE__)));
}

if (!defined('DIR_ROOT')) {
	define('DIR_ROOT', str_replace(DIRECTORY_SEPARATOR, '/', dirname(DIR)));
}

require_once DIR . "/../vendor/autoload.php";
require_once DIR . "/util/functions.php";

// Configuração do timezone
date_default_timezone_set('America/Recife');

// Carrega as variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
