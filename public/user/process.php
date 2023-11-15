<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                # Register User
            } elseif (isset($_POST['login'])) {
                # Login User
            }
        }
    }
}
function isUserExists($username)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    return $stmt->rowCount();
}
function register($name, $username, $password)
{
    global $pdo;
    if (isUserExists($username)) {
        return false;
    }
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $password]);
    return $stmt->rowCount();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                if (register($_POST['username'], $_POST['password'])) {
                    header("location: register.php?s=1");
                    exit;
                }else{
                    header("location: register.php?s=0");
                    exit;
                }
            } elseif (isset($_POST['login'])) {
               # 
            }
        }
    }
}
