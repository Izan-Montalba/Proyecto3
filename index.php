<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'app/controllers/AuthController.php';
require_once './app/models/Usuario.php';

// Iniciamos sesión aquí para que esté disponible en toda la app
session_start();

// Instanciamos el controlador y que él decida qué hacer
$auth = new AuthController();
$auth->inicio();