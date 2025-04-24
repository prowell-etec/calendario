<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendário</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
  .border-danger {
    border: 1px solid red !important;
  }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center hora p-4 <?php echo $greetingClass; ?>" id="currentTime"></h1>
    <section id="form">
      <form class="form-inline justify-content-center mb-3">
        <label for="month" class="mr-2">Mês:</label>
        <select class="form-control mr-2 <?php echo $monthError; ?>" id="month" name="month">
          <?php
          for ($i = 1; $i <= 12; $i++) {
            $selected = ($i == $month) ? 'selected' : '';
            $dateObj = new DateTime("2024-$i-01");
            $fmt = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'America/Sao_Paulo', IntlDateFormatter::GREGORIAN, 'MMMM');
            $monthName = ucfirst($fmt->format($dateObj));
            echo "<option value='$i' $selected>$monthName</option>";
          }
          ?>
        </select>
        <label for="year" class="mr-2">Ano:</label>
        <input type="number" class="form-control mr-2 <?php echo $yearError; ?>" id="year" name="year"
          value="<?php echo $year; ?>">
        <button type="submit" class="btn btn-outline-dark">Selecionar</button>
      </form>
    </section>

    <?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger text-center">
      <?php echo $errorMessage; ?>
    </div>
    <?php endif; ?>

    <section id="calendar">
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="thead-dark">
            <tr>
              <th colspan="7"><?php echo $monthYear; ?></th>
            </tr>
            <tr>
              <th>Dom</th>
              <th>Seg</th>
              <th>Ter</th>
              <th>Qua</th>
              <th>Qui</th>
              <th>Sex</th>
              <th>Sáb</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $week = [];
            foreach ($days as $day) {
              $week[] = $day;
              if (count($week) == 7) {
                echo '<tr>' . implode('', $week) . '</tr>';
                $week = [];
              }
            }
            if (!empty($week)) {
              echo '<tr>' . implode('', $week) . '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </section>
    <script>
    function updateTime() {
      const now = new Date();
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      document.getElementById('currentTime').textContent =
        `<?php echo $greeting; ?> Hora certa: ${hours}:${minutes}:${seconds}`;
    }

    // Atualiza o horário imediatamente
    updateTime();

    // Atualiza o horário a cada segundo
    setInterval(updateTime, 1000);
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>