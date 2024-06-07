<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="validazione.js"></script>
</head>
<body>
    <h2>Login</h2>
    <form id="loginForm" action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "database.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Credenziali non valide!";
    }

    $stmt->close();
    $conn->close();
}
?>