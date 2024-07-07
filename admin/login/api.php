<?php
session_start();

const ADMIN_USER = 'admin';
const ADMIN_PASSWORD = 'admin';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($password != ADMIN_PASSWORD) {
        echo json_encode(['error' => 'password is incorrect']);
        exit;
    }

    $_SESSION['user'] = $username;
    echo json_encode(['status' => 'login successfully']);
}
?>