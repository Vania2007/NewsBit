<?php
include_once "dbconnect.php";
try {
    $conn->query("SET NAMES utf8");
    $conn->query("SET CHARACTER SET utf8");
    $conn->query("DROP TABLE IF EXISTS Users;");if ($conn->connect_error) {
        throw new Exception('Помилка видалення таблиці Users: [' . $conn->connect_error . ']');
    }
    $conn->query("DROP TABLE IF EXISTS NewsTable;");if ($conn->connect_error) {
        throw new Exception('Помилка видалення таблиці NewsTable: [' . $conn->connect_error . ']');
    }
    echo "Таблиці Users і NewsTable успішшно видалені";
    mysqli_close($conn);
} catch (Exception $e) {
    $e->getMessage();
}
