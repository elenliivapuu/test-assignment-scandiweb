<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

    include_once('../config/Database.php');
    include_once('../models/Item.php');

    
    //Instantiate DB & connect
    $database_ = new Database();
    $db = $database_->connect();

    // Received list of ids for deletion
    $data['ids'] = isset($_POST['ids']) ? $_POST['ids'] : null;

    foreach($data['ids'] as $id_) {
        $item_ = new Item($db);
        $item_->setid($id_);

        if($item_->delete()) {
            $results = json_encode(array('message' => 'Item Deleted'));
        } else {
            $results = json_encode(array('message' => 'Post Not Deleted'));
        }
    }
?>
