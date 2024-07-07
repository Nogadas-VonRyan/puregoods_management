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
            <a href="../../">Home</a>
            <a href="../../product">Products</a>
            <a href="../../customer">Reserve</a>
            <a href="../../admin">Admin</a>
        </div>
    </nav>

    <main>
        <div class="anchor-list">
            <h1 class="full">Welcome Admin!</h1>
            <a href="../products">Product Manager</a>
            <a href="../reservations">Reservation Manager</a>
            <a href="../logout.php">Logout</a>
        </div>
        
    </main>
    <script src="script.js"></script>
</body>

</html>