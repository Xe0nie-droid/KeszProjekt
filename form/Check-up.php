<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-up</title>

    <style>
        :root{
            font-family:system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;
        }

        body{
            background:#252525;
            color:#fff;
            margin:0;
            padding:4px;
        }

        table{
            width:50%;
            border-collapse:collapse;
            margin-left:25%;
        }

        .szoveg{
            text-align:center;
        }

        th,td{
            padding:10px;
            border-bottom:1px solid #000000ff;
            text-align:left;
            background: rgba(192, 192, 192, 1);
            color:black;
        }

        th{
            background:#2b3b33;
            color:white;
        }

        button{
            padding:6px 10px;
            cursor:pointer;
        }
    </style>
</head>
<body>

<h1 class="szoveg">Check-up</h1>
<br>

<?php
$conn = mysqli_connect("localhost", "root", "", "report");
if (!$conn) {
    die("Adatbázis kapcsolati hiba");
}


if (isset($_POST['delete_row'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM report WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
?>

<table>
    <tr>
        <th class="sor">Tárgy neve</th>
        <th class="sor">Tanár neve</th>
        <th class="sor">Hiba</th>
        <th class="sor"> - - - </th>
    </tr>

<?php
$sql = "SELECT * FROM report";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "<tr>
            <td>{$row['targy_neve']}</td>
            <td>{$row['tanar_neve']}</td>
            <td>{$row['hiba']}</td>
            <td>
                <form method='POST' onsubmit=\"return confirm('Biztos törlöd?');\">
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit' name='delete_row'>Törlés</button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo '<tr><td colspan="4">Nincs adat</td></tr>';
}

$conn->close();
?>

</table>

</body>
</html>
