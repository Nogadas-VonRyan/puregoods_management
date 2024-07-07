<?php
require_once '../config.php';

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
    $price = $_POST['product_price'];
    $params = [$name,$price];
    $conn->execute_query('insert into products(product_name, product_price) 
        values(?,?)', $params);    
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['product_id'];
    $params = [$id];
    $conn->execute_query('delete from products where product_id=?',$params);
}
?>