<?php
$targy_neve = filter_input(INPUT_POST, 'targy_neve');
$tanar_neve = filter_input(INPUT_POST, 'tanar_neve');
$hiba = filter_input(INPUT_POST, 'hiba');

if (!$targy_neve || !$tanar_neve || !$hiba) {
    echo "Hiányzó adat";
    exit;
}

$conn = new mysqli("localhost", "root", "", "report");

if ($conn->connect_error) {
    echo "Kapcsolódási hiba";
    exit;
}

$conn->set_charset("utf8mb4");

$stmt = $conn->prepare(
    "INSERT INTO report (targy_neve, tanar_neve, hiba) VALUES (?, ?, ?)"
);

if ($stmt === false) {
    echo "SQL hiba";
    exit;
}

$stmt->bind_param("sss", $targy_neve, $tanar_neve, $hiba);

if ($stmt->execute()) {
    echo "Sikeres felvétel";
} else {
    echo "Mentési hiba";
}

$stmt->close();
$conn->close();
