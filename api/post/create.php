<?php
    // Headers and files
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    include_once('../config/Database.php');
    include_once('../models/Item.php');

    //Instantiate DB & connect
    $database_ = new Database();
    $db = $database_->connect();

    $data = isset($_POST['new']) ? $_POST['new'] : null;

    $item_ = new Item($db);

    // Set item fields from received data
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