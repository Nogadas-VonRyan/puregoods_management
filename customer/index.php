<?php
require '../config.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/modal.css">
    <link rel="stylesheet" href="../main.css">
    <title>Puregoods Management System</title>
</head>

<body>
    <nav>
        <div class="title">Puregoods Management System</div>
        <div>
            <a href="../">Home</a>
            <a href="../product">Products</a>
            <a href="../customer">Reserve</a>
            <a href="../admin">Admin</a>
        </div>
    </nav>

    <main>
        <h1>Reserve Products</h1>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal Price</th>
                </tr>
            </thead>
            <tbody id="table_body"></tbody>
        </table>

        <h2>Reservation Form</h2>
        <form method="post">
            <div class="half-container">
                <div>
                    <label for="name">First Name</label>
                    <input type="text" id="first_name" required>
                </div>
                <div>
                    <label for="name">Middle Name</label>
                    <input type="text" id="middle_name" required>
                </div>
                <div>
                    <label for="name">Last Name</label>
                    <input type="text" id="last_name" required>
                </div>
            </div>
            <div class="half-container">
                <div>
                    <label for="name">City</label>
                    <input type="text" id="city" required>
                </div>
                <div>
                    <label for="name">Street</label>
                    <input type="text" id="street" required>
                </div>
                <div>
                    <label for="name">Block</label>
                    <input type="text" id="block" required>
                </div>
            </div>
            <div>
                <label for="reserve_date">Reservation Date</label>
                <input type="date" id="reserve_date" required>
            </div>
            <div>
                <label for="total_price">Total Price</label>
                <input type="text" id="total_price" value=₱0 required disabled>
            </div>
            <button type="button" onclick="insert()">Submit</button>
        </form>
    </main>
    
    <div id="myModal" class="modal">
        <div class="modal-content modal-danger">
            <p id="modal_message">Error</p>
        </div>
    </div>
    <script src="../components/modal.js"></script>
    <script src="script.js"></script>
</body>

</html>