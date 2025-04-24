<?php
require_once 'controllers/CalendarController.php'; // Inclui o controlador do calendário

// Cria uma nova instância do CalendarController
$controller = new CalendarController();

// Chama o método handleRequest() do controlador para tratar a requisição e preparar os dados para a visualização
$controller->handleRequest();