<?php
class CalendarModel
{
    private $locale = 'pt_BR'; // Definindo o local como português brasileiro
    private $timezone = 'America/Sao_Paulo'; // Definindo o fuso horário como São Paulo

    // Método para obter o mês e ano formatados
    public function getMonthYear($month, $year)
    {
        // Criando um formatador de data para o mês no local e fuso horário definidos
        $fmt = new IntlDateFormatter($this->locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE, $this->timezone, IntlDateFormatter::GREGORIAN, 'MMMM');
        // Criando um objeto DateTime para o primeiro dia do mês/ano especificado
        $date = new DateTime("$year-$month-01");
        // Formatando o mês para o nome completo do mês em português
        $formattedMonth = $fmt->format($date);
        // Retornando o nome do mês com a primeira letra maiúscula seguido pelo ano
        return ucfirst($formattedMonth) . ' ' . $year;
    }

    // Método para obter os dias do calendário
    public function getCalendarDays($month, $year)
    {
        $days = []; // Array para armazenar os dias
        // Obtendo o dia atual se o mês e ano forem o atual, caso contrário -1
        $currentDay = ($month == date('n') && $year == date('Y')) ? date('j') : -1;
        // Calculando o número total de dias no mês
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // Obtendo o dia da semana do primeiro dia do mês (0 para domingo, 6 para sábado)
        $firstDayOfMonth = date('w', strtotime("$year-$month-01"));

        // Adicionando células vazias até o primeiro dia do mês
        for ($i = 0; $i < $firstDayOfMonth; $i++) {
            $days[] = "<td></td>";
        }

        // Adicionando os dias do mês ao array
        for ($day = 1; $day <= $totalDays; $day++) {
            $class = ''; // Classe CSS para o dia
            if ($day == $currentDay) {
                $class .= 'hoje '; // Adiciona a classe 'hoje' se for o dia atual
            }
            if (($firstDayOfMonth + $day - 1) % 7 == 0) {
                $class .= 'domingo'; // Adiciona a classe 'domingo' se for domingo
            } elseif (($firstDayOfMonth + $day - 1) % 7 == 6) {
                $class .= 'sabado'; // Adiciona a classe 'sabado' se for sábado
            }
            // Adiciona o dia com as classes CSS aplicadas
            $days[] = "<td class='$class'>$day</td>";
        }

        return $days; // Retorna o array de dias
    }

    // Método para obter a saudação com base na hora do dia
    public function getGreeting()
    {
        date_default_timezone_set($this->timezone); // Definindo o fuso horário
        $hour = date('H'); // Obtendo a hora atual
        $minute = date('i'); // Obtendo o minuto atual
        $second = date('s'); // Obtendo o segundo atual
        $greeting = ''; // Variável para a saudação
        $greetingClass = ''; // Variável para a classe CSS da saudação

        // Determinando a saudação com base na hora do dia
        if ($hour < 12) {
            $greeting = "Bom dia!";
            $greetingClass = 'bom-dia';
        } elseif ($hour < 18) {
            $greeting = "Boa tarde!";
            $greetingClass = 'boa-tarde';
        } else {
            $greeting = "Boa noite!";
            $greetingClass = 'boa-noite';
        }

        // Retornando a saudação e a classe CSS em um array associativo
        return [
            'text' => $greeting,
            'class' => $greetingClass
        ];
    }
}