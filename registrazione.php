<!DOCTYPE html>
<html>
<head>
    <title>Registrazione</title>
    <script src="validazione.js"></script>
</head>
<body>
    <h2>Registrazione</h2>
    <form id="registrationForm" action="registrazione.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <input type="submit" value="Registrati">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "database.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        echo "Registrazione completata con successo!";
    } else {
        echo "Errore durante la registrazione: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>