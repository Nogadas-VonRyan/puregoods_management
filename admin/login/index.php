<?php
session_start();

if($_SESSION['user'] ?? '') {
    header('Location:../home');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../components/modal.css">
    <link rel="stylesheet" href="../../main.css">
    <title>Puregoods Management System</title>
</head>

<body>
    <nav>
        <div class="title">Puregoods Management System</div>
        <div>
            <a href="../../">Home</a>
            <a href="../../product">Products</a>
            <a href="../../customer">Reserve</a>
            <a href="../../admin">Admin</a>
        </div>
    </nav>

    <main>
        <form>
            <h1>Admin Login</h1>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="button" onclick="validation()">Login</button>
        </form>
    </main>

    <div id="myModal" class="modal">
        <div class="modal-content modal-danger">
            <p id="modal_message">Error</p>
        </div>
    </div>

    <script src="../../components/modal.js"></script>
    <script src="script.js"></script>
</body>

</html>