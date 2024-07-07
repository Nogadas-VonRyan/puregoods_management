<?php
require_once '../../config.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $response = $conn->execute_query('select * from reservations
        join customers on reservations.customer_id = customers.customer_id');
    $data = [];
    while($row = $response->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    parse_str(file_get_contents('php://input'), $_PATCH);

    $column = $_PATCH['column'];

    $value = $_PATCH[$column];
    $id = $_PATCH['reservation_id'];
    $params = [$value,$id];

    var_dump($params);

    $conn->execute_query("
        update reservations set $column=? 
        where reservation_id=?",$params);
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['reservation_id'];
    $params = [$id];
    $conn->execute_query('delete from reservations where reservation_id=?',$params);
}
?>