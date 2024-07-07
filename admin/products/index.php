<?php
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
    <link rel="stylesheet" href="../../components/modal.css">
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
        <h1>Add Product</h1>
        <form>
            <div>
                <label for="product_name">Product Name: </label>
                <input type="text" id="product_name" name="product_name">
            </div>
            <div>
                <label for="product_price">Product Price: </label>
                <select id="product_category" name="product_category">
                    <option value="chicken">Chicken</option>
                    <option value="beef">Beef</option>
                    <option value="pork">Pork</option>
                </select>
            </div>
            <div>
                <label for="product_price">Product Price: </label>
                <input type="number" id="product_price" name="product_price">
            </div>
            <button type="button" id="insert_button" onclick="insert()">Submit</button>
        </form>

        <hr class="pushdown">

        <h1>Manage Products</h1>
        <button class="pushdown" onclick="window.print()">Print Products</button>

        <div class="search-container pushdown">
            <select id="filter_category">
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
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="table_body"></tbody>
        </table>
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