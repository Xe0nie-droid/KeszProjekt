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
            border-bottom:1px solid #000;
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

        select{
            padding:5px;
            border-radius:4px;
        }
    </style>
</head>
<body>

<h1 class="szoveg">Check-up</h1>
<br>

<?php
/* =========================
   ADATBÁZIS KAPCSOLAT
========================= */
$conn = new mysqli("localhost", "root", "", "report");
if ($conn->connect_error) {
    die("Adatbázis kapcsolati hiba");
}

/* =========================
   TÖRLÉS
========================= */
if (isset($_POST['delete_row'], $_POST['id'])) {
    $id = (int)$_POST['id'];
    $stmt = $conn->prepare("DELETE FROM report WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

/* =========================
   STÁTUSZ FRISSÍTÉS
========================= */
if (isset($_POST['update_status'], $_POST['id'], $_POST['status'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE report SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

/* =========================
   LEKÉRDEZÉS
========================= */
$sql = "SELECT id, targy_neve, tanar_neve, hiba, status FROM report";
$result = $conn->query($sql);
?>

<table>
    <tr>
        <th>Tárgy neve</th>
        <th>Tanár neve</th>
        <th>Hiba</th>
        <th>Állapot</th>
        <th></th>
    </tr>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        /* ha nincs státusz, alapértelmezett */
        $status = $row['status'] ?? 'uj';

        echo "
        <tr>
            <td>{$row['targy_neve']}</td>
            <td>{$row['tanar_neve']}</td>
            <td>{$row['hiba']}</td>

            <td>
                <form method='POST'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <select name='status' onchange='this.form.submit()'>
                        <option value='uj' ".($status==='uj'?'selected':'').">Új</option>
                        <option value='folyamatban' ".($status==='folyamatban'?'selected':'').">Folyamatban</option>
                        <option value='megoldva' ".($status==='megoldva'?'selected':'').">Megoldva</option>
                    </select>
                    <input type='hidden' name='update_status' value='1'>
                </form>
            </td>

            <td>
                <form method='POST' onsubmit=\"return confirm('Biztos törlöd?');\">
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit' name='delete_row'>Törlés</button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Nincs adat</td></tr>";
}

$conn->close();
?>

</table>

</body>
</html>


