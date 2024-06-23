<?php
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'puregoods_db';

$conn = new mysqli($server,$username,$password,$db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puregoods Management</title>
</head>
<body>
    <h1>Inventory</h1>
    <table>
        <th></th>
    </table>
    <form>
        <input type="text">
        <input type="number">
        <button type="submit">Submit</button>
    </form>
</body>
</html>