<?php
include_once('config.php');

// Processar formulário de aluguel/desaluguel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_car = $_POST['id_car'];
    if (isset($_POST['alugar'])) {
        $sql = "UPDATE Carros SET Status=FALSE WHERE id_car=$id_car";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Carro alugado com sucesso!');
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao alugar o carro: " . mysqli_error($conn) . "');
                  </script>";
        }
    } elseif (isset($_POST['desalugar'])) {
        $sql = "UPDATE Carros SET Status=TRUE WHERE id_car=$id_car";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Carro desalugado com sucesso!');
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao desalugar o carro: " . mysqli_error($conn) . "');
                  </script>";
        }
    }
}

// Consulta os carros cadastrados
$sql = "SELECT id_car, Modelo, Ano, cambio, Combustivel, Cor, Status FROM Carros";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Erro na consulta: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carros Disponíveis</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .alugado {
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        function processRequest(id_car, action) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'carros_disponiveis.php';

            var inputIdCar = document.createElement('input');
            inputIdCar.type = 'hidden';
            inputIdCar.name = 'id_car';
            inputIdCar.value = id_car;

            var inputAction = document.createElement('input');
            inputAction.type = 'hidden';
            inputAction.name = action;

            form.appendChild(inputIdCar);
            form.appendChild(inputAction);
            document.body.appendChild(form);

            form.submit();
        }
    </script>
</head>
<body>
    <h1>Carros Disponíveis</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Modelo</th><th>Ano</th><th>Câmbio</th><th>Combustível</th><th>Cor</th><th>Status</th><th>Ação</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_car"] . "</td>";
            echo "<td>" . $row["Modelo"] . "</td>";
            echo "<td>" . $row["Ano"] . "</td>";
            echo "<td>" . $row["cambio"] . "</td>";
            echo "<td>" . $row["Combustivel"] . "</td>";
            echo "<td>" . $row["Cor"] . "</td>";
            echo "<td id='status-" . $row["id_car"] . "' class='" . ($row["Status"] ? '' : 'alugado') . "'>" . ($row["Status"] ? 'Disponível' : 'Alugado') . "</td>";
            if ($row["Status"]) {
                echo "<td id='button-" . $row["id_car"] . "'><button onclick='processRequest(" . $row["id_car"] . ", \"alugar\")'>Alugar</button></td>";
            } else {
                echo "<td id='button-" . $row["id_car"] . "'><button onclick='processRequest(" . $row["id_car"] . ", \"desalugar\")'>Desalugar</button></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum carro cadastrado.</p>";
    }
    mysqli_close($conn);
    ?>
</body>
</html>
