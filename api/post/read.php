<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include_once('../config/Database.php');
    include_once('../models/Item.php');


    //Instantiate DB & connect
    $database_ = new Database();
    $db = $database_->connect();

    $item_ = new Item($db);

    // Check for entries
    $result = $item_->read();

    // Get row count
    $num = $result->rowCount();
    $results = '';

    // Loop through the results
    if($num > 0) {
        $items_arr = array();
        $items_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $item_arr = array(
                'id' => $id,
                'SKU' => $SKU,
                'Name' => $Name,
                'Price' => $Price,
                'Special_attribute' => $Special_attribute
            );

            //Push to 'data'
            array_push($items_arr['data'], $item_arr);
        }
        //Turn to json & return
        $results = json_encode($items_arr);
        echo $results;
    } else {
        $results = json_encode(array('message' => 'No items found'));
    }
?>