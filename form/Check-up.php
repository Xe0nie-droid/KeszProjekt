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

table{
  width:50%;
  border-collapse:collapse;
  margin-left:25% ;
}

.szoveg{
    text-align:center;
}

.sor{
    color: white;
}
body{
    background:#252525;
    color:#fff;
    margin:0;
    padding:4px;

}
th,td{
  padding:10px;
  border-bottom:1px solid #000000ff;
  text-align:left;
  background: rgba(192, 192, 192, 1);
  color: black;
  
}

th{
  background: #1b5e20;
}

    </style>
</head>
<body>
    <h1 class="szoveg">Check-up</h1>
    <br>
    <table>
        <tr>
            <th class="sor">Targy neve</th>
            <th class="sor">Tanar neve</th>
            <th class="sor">Hiba</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "report");
        $sql = "SELECT * FROM report";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result-> fetch_assoc()) {
                echo  "<tr><td>" . $row["targy_neve"] . "</td><td>" . $row["tanar_neve"] . "</td><td>" . $row["hiba"] ;
            }
        } 
        else {
            echo "No results";
        }
        $conn->close();
        ?>
    </table>
</body>

</html>
