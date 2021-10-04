<?php
    //Headers
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');

    require_once __DIR__.'/../../config/Database.php';
    require_once __DIR__.'/../../models/Item.php';
    require_once __DIR__.'/../../models/DVD.php';
    require_once __DIR__.'/../../models/Book.php';
    require_once __DIR__.'/../../models/Furniture.php';

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