<?php
require_once 'models/CalendarModel.php'; // Inclui o modelo de calendário

class CalendarController
{
    private $model; // Propriedade para armazenar a instância do modelo

    // Construtor da classe que inicializa o modelo
    public function __construct()
    {
        $this->model = new CalendarModel();
    }

    // Método para lidar com a requisição e preparar os dados para a visualização
    public function handleRequest()
    {
        // Obtém o mês da requisição GET ou usa o mês atual se não estiver definido
        $month = isset($_GET['month']) ? $_GET['month'] : date('n');
        // Obtém o ano da requisição GET ou usa o ano atual se não estiver definido
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        // Obtém a string formatada com o mês e ano
        $monthYear = $this->model->getMonthYear($month, $year);

        // Obtém os dias do calendário para o mês e ano especificados
        $days = $this->model->getCalendarDays($month, $year);

        // Obtém a saudação baseada na hora do dia
        $greetingData = $this->model->getGreeting();
        $greeting = $greetingData['text']; // Saudação ("Bom dia", "Boa tarde", "Boa noite")
        $greetingClass = $greetingData['class']; // Classe CSS correspondente à saudação

        // Inclui a visualização do calendário, passando os dados necessários
        require 'views/calendarView.php';
    }
}