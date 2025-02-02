<?php
include "dbconnect.php";
if (!isset($_SESSION)) {
    session_start();
}

function getPost($id)
{
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT NewsTable.id, NewsTable.title, NewsTable.date, NewsTable.message, users.login, NewsTable.category, NewsTable.image FROM NewsTable JOIN users ON NewsTable.user_id=users.user_id WHERE NewsTable.id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (!$row) {
            return null;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $row;
}

function getPostId()
{
    global $conn;
    $arr_id = array();
    try {
        if (!$result = $conn->query("SELECT * FROM NewsTable ORDER BY date ASC")) {
            throw new Exception('Помилка створення таблиці: [' . $conn->error . ']');
        }

        while ($row = $result->fetch_assoc()) {
            $arr_id[] = $row["id"];
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_id;
}

function out($limit, $offset)
{
    global $conn;
    $arr_out = array();
    try {
        if (!$result = $conn->query("SELECT NewsTable.id, NewsTable.title, NewsTable.date, NewsTable.message, users.login, NewsTable.category, NewsTable.image FROM NewsTable JOIN users ON NewsTable.user_id=users.user_id ORDER BY date DESC LIMIT $limit OFFSET $offset")) {
            throw new Exception('Помилка створення таблиці:: [' . $conn->error . ']');
        }

        while ($row = $result->fetch_assoc()) {
            $arr_out[] = $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_out;
}
function out_for_nav($limit)
{
    global $conn;
    $arr_out = array();
    try {
        if (!$result = $conn->query("SELECT NewsTable.id, NewsTable.title FROM NewsTable JOIN users ON NewsTable.user_id=users.user_id ORDER BY date DESC LIMIT $limit")) {
            throw new Exception('Помилка створення таблиці: [' . $conn->error . ']');
        }

        while ($row = $result->fetch_assoc()) {
            $arr_out[] = $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_out;
}
function getTotalPages()
{
    global $conn;
    try {
        if (!$result = $conn->query("SELECT COUNT(*) FROM NewsTable")) {
            throw new Exception('Помилка створення таблиці: [' . $conn->error . ']');
        }

        $row = $result->fetch_assoc();
        return $row['COUNT(*)'];
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function out_category($category, $limit, $offset)
{
    global $conn;
    try {
        if (!$result = $conn->query("SELECT COUNT(*) FROM NewsTable")) {
            throw new Exception('Помилка створення таблиці: [' . $conn->error . ']');
        }
        $query = "SELECT NewsTable.id, NewsTable.title, NewsTable.date, NewsTable.message, users.login, NewsTable.category, NewsTable.image FROM NewsTable JOIN users ON NewsTable.user_id=users.user_id WHERE category = '$category' ORDER BY date DESC LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);
        $out = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $out[] = $row;
        }
        return $out;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function count_category($category)
{
    global $conn;
    try {
        if (!$result = $conn->query("SELECT COUNT(*) FROM NewsTable")) {
            throw new Exception('Помилка створення таблиці: [' . $conn->error . ']');
        }
        $query = "SELECT COUNT(*) FROM NewsTable WHERE category = '$category'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_fetch_row($result);
        return $count[0];
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function check_autorize($login, $password)
{
    global $conn;
    $sql = "SELECT password FROM Users WHERE login = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    if ($stmt->execute()) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_login'] = $login;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function check_log($login)
{
    global $conn;
    try {
        $sql = "SELECT login FROM Users WHERE login = '" . $login . "'";
        $result = $conn->query($sql);
        $n = $result->num_rows;
        if ($n != 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        $e->getMessage();
    }
}

function registration($login, $password)
{
    global $conn;
    $sql = "SELECT login FROM Users WHERE login = '$login';";
    if ($result = $conn->query($sql)) {
        $n = $result->num_rows;
        if ($n != 0) {
            return false;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Users (login, password) VALUES ('$login', '$hashed_password');";
            if ($conn->query($sql)) {
                if (check_autorize($login, $password)) {
                    header("Location: admin_panel.php");
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    switch ($action) {
        case 'add':
            add();
            break;
        case 'logout':
            logout();
            break;
        default:
            header("Location: index.php");
    }
}
function add()
{
    global $conn;
    $title = $_REQUEST['title'];
    $message = $_REQUEST['message'];
    $category = $_REQUEST['category'];
    $activeUserId = getIdActiveUser();

    if (isset($_FILES['article-image']) && $_FILES['article-image']['error'] == 0) {
        $image_name = $_FILES['article-image']['name'];
        $image_path = './images/' . $image_name;
        if (!file_exists('images')) {
            mkdir('images', 0777, true);
        }
        if (move_uploaded_file($_FILES['article-image']['tmp_name'], $image_path)) {
        } else {
            echo "Помилка при завантаженні файлу";
            exit;
        }
    } else {
        $image_path = '';
    }

    try {
        $stmt = $conn->prepare("INSERT INTO NewsTable(title, date, message, user_id, category, image) VALUES (?, NOW(), ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $title, $message, $activeUserId, $category, $image_path);
        if (!$stmt->execute()) {
            throw new Exception('Помилка заповнення таблиці NewsTable: [' . $conn->error . ']');
        }

        $_SESSION['add'] = true;
        header("Location: admin_panel.php");
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    global $conn;
}

function logout()
{
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    unset($_SESSION['add']);
    session_unset();
    header("Location: index.php");
}

function getIdActiveUser()
{
    $login = $_SESSION['user_login'];
    global $conn;
    $user_id;
    try {
        if (!$result = $conn->query("SELECT * FROM Users WHERE login='$login'")) {
            throw new Exception('Помилка створення таблиці [' . $conn->error . ']');
        }

        $row = $result->fetch_assoc();

        $user_id = $row["user_id"];

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $user_id;

}
function search($query, $limit)
{
    global $conn;
    $arr_out = array();
    try {
        $sql = "SELECT NewsTable.id, NewsTable.title, NewsTable.date, NewsTable.message, users.login, NewsTable.category, NewsTable.image FROM NewsTable JOIN users ON NewsTable.user_id = users.user_id WHERE NewsTable.title LIKE '%$query%' OR NewsTable.message LIKE '%$query%' OR users.login LIKE '%$query%' OR DATE(NewsTable.date) = '$query' ORDER BY NewsTable.date DESC LIMIT $limit";

        if (!$result = $conn->query($sql)) {
            throw new Exception('Помилка виконання запиту: [' . $conn->error . ']');
        }

        while ($row = $result->fetch_assoc()) {
            $arr_out[] = $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $arr_out;
}
