<?php
require '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h1>Product</h1>
        <div class="search-container pushdown">
            <select id="product_category" name="product_category">
                <option value="all">All Categories</option>
                <option value="chicken">Chicken</option>
                <option value="beef">Beef</option>
                <option value="pork">Pork</option>
            </select>
            <button onclick="filterCategory()">Filter</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody id="table_body"></tbody>
        </table>
    </main>
    <script src="script.js"></script>
</body>

</html>