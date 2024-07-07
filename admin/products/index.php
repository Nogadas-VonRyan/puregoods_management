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
                <input type="text" name="product_name">
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
                <input type="number" name="product_price">
            </div>
            <button type="button" onclick="insert()">Submit</button>
        </form>

        <hr>

        <h1>Manage Products</h1>
        <button>Print Products</button>

        <div>
            <label>Search</label>
            <input type="text">
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
    <script src="script.js"></script>
</body>

</html>