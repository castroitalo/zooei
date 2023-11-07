<?php 

// Import composer autoload
require_once __DIR__ . "/../vendor/autoload.php";

// Initialize phpdotenv
$dotenv = Dotenv\Dotenv::createImmutable(CONF_ROOT_DIR);

$dotenv->load();
