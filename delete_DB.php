<?php
include_once "dbconnect.php";
try {
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD);
    if ($conn->connect_error) {
        throw new Exception('Помилка з\'єднання з MySQL сервером: [' . $conn->connect_error . ']');
    }
    if (!$conn->query('DROP DATABASE ' . DBNAME)) {
        throw new Exception('Помилка видалення бази даних ' . DBNAME . ': [' . $conn->error . ']');
    }
    echo "База даних успішно видалена";
    $conn->close();
} catch (Exception $e) {
    echo $e->getMessage();
}
