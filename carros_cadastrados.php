<?php
// Conexão com o banco de dados
include_once('config.php');

// Consulta os carros cadastrados
$sql = "SELECT id_car, Modelo, Ano, cambio, Combustivel, Cor FROM Carros";
$result = mysqli_query($conn, $sql);

// Verifica se houve erros na consulta
if (!$result) {
    die('Erro na consulta: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carros Cadastrados</title>
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
    </style>
</head>
<body>
    <h1>Carros Cadastrados</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Modelo</th><th>Ano</th><th>Câmbio</th><th>Combustível</th><th>Cor</th></tr>";

        // Exibe os dados de cada carro
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_car"] . "</td>";
            echo "<td>" . $row["Modelo"] . "</td>";
            echo "<td>" . $row["Ano"] . "</td>";
            echo "<td>" . $row["cambio"] . "</td>";
            echo "<td>" . $row["Combustivel"] . "</td>";
            echo "<td>" . $row["Cor"] . "</td>";
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