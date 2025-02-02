<?php
include_once "dbconnect.php";
try {
    $conn->query("SET NAMES utf8");
    $conn->query("SET CHARACTER SET utf8");
    if (!$conn->query("CREATE TABLE IF NOT EXISTS NewsTable (id INT NOT NULL AUTO_INCREMENT, title VARCHAR(255), date DATETIME, message TEXT, user_id INT, category VARCHAR(255), image VARCHAR(255), PRIMARY KEY (id)
    )")) {
        throw new Exception('Помилка створення таблиці NewsTable: [' . $conn->error . ']');
    }
    if (!$conn->query("CREATE TABLE IF NOT EXISTS Users (user_id INT NOT NULL AUTO_INCREMENT, login VARCHAR(255), password VARCHAR(255), PRIMARY KEY (user_id))")) {
        throw new Exception('Помилка створення таблиці Users: [' . $conn->error . ']');
    }

    $password = 'MegaPassword';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!$conn->query("INSERT INTO Users (login, password) VALUES ('admin', '$hashed_password')")) {
        throw new Exception('Помилка заповнення таблиці Users: [' . $conn->error . ']');
    }

    if (!$conn->query("ALTER TABLE NewsTable ADD FOREIGN KEY (user_id) REFERENCES Users (user_id)
        ON DELETE RESTRICT ON UPDATE CASCADE")) {
        throw new Exception('Помилка створення зовнішнього ключа в таблиці NewsTable: [' . $conn->error . ']');
    }

    echo "Таблиці Users і NewsTable успішно створені";
    $conn->close();
} catch (Exception $e) {
    echo $e->getMessage();
}
