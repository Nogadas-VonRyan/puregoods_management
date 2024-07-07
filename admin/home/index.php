<?php
require '../../config.php';
session_start();

if(!$_SESSION['user']) {
    header('Location:../login');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../main.css">
    <title>Puregoods Management System</title>
</head>

<body>
    <nav>
        <div class="title">Puregoods Management System</div>
        <div>
            <a href="../../product">Products</a>
            <a href="../../customer">Reserve</a>
            <a href="../../admin">Admin</a>
        </div>
    </nav>

    <main>
        <a href="../products">Product Manager</a>
        <a href="../reservation">Reservation Manager</a>
        <button>Logout</button>
    </main>
    <script src="script.js"></script>
</body>

</html>