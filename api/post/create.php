<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include_once('../config/Database.php');
    include_once('../models/Item.php');

    //Instantiate DB & connect
    $database_ = new Database();
    $db = $database_->connect();

    $data = isset($_POST['new']) ? $_POST['new'] : null;
    // $type = isset($_POST['type']) ? $_POST['type'] : null;

    $item_ = new Item($db);
    
    // if($type == 'DVD'){
    //     $item_ = new DVD($db);
    // } else if($type == 'Book'){
    //     $item_ = new Book($db);
    // }   else if($type == 'Furniture'){
    //     $item_ = new Book($db);
    // }

    $item_->setSKU($data['SKU']);
    $item_->setName($data['Name']);
    $item_->setPrice($data['Price']);
    $item_->setSpecialAttribute($data['Special_attribute']);

    if($item_->create()) {
        $results = json_encode(array('message' => 'Post Created'));
    } else {
        $results = json_encode(array('message' => 'Post Not Created'));
    }

?>