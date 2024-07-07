<th?php
session_start();

if (!$_SESSION['user']) {
    header('Location:../login');
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
        <h1>Reservations</h1>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Reserved Date</th>
                    <th>Total Price</th>
                    <th>Claimed</th>
                    <th>Paid</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table_body"></tbody>
        </table>

        <div id="myModal" class="modal">
            <div class="modal-content modal-danger">
                <p id="modal_message">Error</p>
            </div>
        </div>
        <script src="../../components/modal.js"></script>
        <script src="script.js"></script>
</body>

</html>