<?php
require_once '../../config.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $response = $conn->query('select * from products');
    $data = [];
    while($row = $response->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['product_name'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $params = [$name,$category,$price];
    $conn->execute_query('insert into products(product_name, product_category,
         product_price) values(?,?,?)', $params);    
}
else if($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents('php://input'), $_PATCH);
    $id = $_PATCH['product_id'];
    $name = $_PATCH['product_name'];
    $category = $_PATCH['product_category'];
    $price = $_PATCH['product_price'];

    $params = [$name,$category,$price,$id];
    $conn->execute_query('update products set product_name=?, product_category=?,
        product_price=? where product_id=?',$params);
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['product_id'];
    $params = [$id];
    try{
        $conn->execute_query('delete from products where product_id=?',$params);
    } catch(Exception $e) {
        echo '{"error" : "active"}';
        return;
    }

    echo '{"success" : "success"}';
}
?>