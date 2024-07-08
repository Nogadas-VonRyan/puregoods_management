<?php
require '../../config.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $response = $conn->query('
        select customers.customer_id,first_name,middle_name,last_name,
        city, street, block, sum(total_price) from customers 
        join reservations 
        on customers.customer_id = reservations.customer_id
        where is_paid = 0
        group by customer_id');
    $data = [];
    while($row = $response->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['customer_id'];
    $params = [$id];
    try {
        $conn->execute_query('delete from customers where customer_id=?',
        $params);
    } catch (Exception $e) {
        echo '{"error" : "active"}';
        exit;
    }

    echo '{"success" : "success"}';
}
?>