<?php
// index.php
require_once 'config/database.php';
require_once 'app/controllers/AuthController.php';
require_once ' app/models/Usuario.php';

// Iniciamos sesión aquí para que esté disponible en toda la app
session_start();

// Instanciamos el controlador y que él decida qué hacer
$auth = new AuthController();
$auth->inicio();