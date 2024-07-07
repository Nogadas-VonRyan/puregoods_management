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
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $city = $data['city'];
    $street = $data['street'];
    $block = $data['block'];
    $date = $data['date'];
    $total = $data['data']['total'];
    
    //validate if customer exists first
    $customer = getCustomer($first_name,$middle_name,$last_name);
    $customer_id = $customer['customer_id'] ?? NULL;

    if($customer == NULL) {
        $params = [$first_name,$middle_name,$last_name,$city,$street,$block];
        $conn->execute_query('insert into customers(
            first_name,middle_name,last_name,city,street,block) 
            values(?,?,?,?,?,?)', $params);
        
        $response = $conn->query('select max(customer_id) from customers');
        $customer_id = $response->fetch_assoc()['customer_id'];
    }

    $params = [$customer_id,$total,false,false,$date];
    $conn->execute_query('insert into reservations(
        customer_id, total_price, is_claimed, is_paid, date_payment)
        values(?,?,?,?,?)', $params);
    
    foreach($data['data']['products'] as $product_name => $product) {
        if($product['count'] <= 0) continue;

        $params = [$product['id'], $product['count']];
        $conn->execute_query('insert into reserved_products(
            reservation_id,product_id,product_count)
            select max(reservation_id),?,?
            from reservations', $params);
    }
    // var_dump($data);
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['product_id'];
    $params = [$id];
    $conn->execute_query('delete from reservations where id=?',$params);
}


function getCustomer($first_name, $middle_name, $last_name) {
    global $conn;
    try {
        $data = $conn->execute_query('select * from customers 
        where first_name = ? AND last_name = ?', [$first_name, $last_name]);
    } catch(Exception $e) {
        return NULL;
    }

    return $data->fetch_assoc();
}
?>