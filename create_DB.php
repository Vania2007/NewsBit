<?php
include_once "config.php";
try {
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD);
    if ($conn->connect_error) {
        throw new Exception('Помилка з\'єднання з MySQL сервером: [' . $conn->connect_error . ']');
    }
    if (!$conn->query("CREATE DATABASE IF NOT EXISTS " . DBNAME . " CHARACTER SET utf8 COLLATE utf8_general_ci")) {
        throw new Exception('Помилка створення бази даних: [' . $conn->error . ']');
    }

    echo "База даних успішно створена";
    $conn->close();
} catch (Exception $e) {
    echo $e->getMessage();
}
