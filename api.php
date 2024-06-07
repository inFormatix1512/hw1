<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM contenuti";
    $result = $conn->query($sql);

    $contenuti = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contenuti[] = $row;
        }
    }

    header("Content-Type: application/json");
    echo json_encode($contenuti);
}

$conn->close();
?>