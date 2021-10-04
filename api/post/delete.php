<?php
    //Headers
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');

    require_once __DIR__.'\..\..\config\Database.php';
    require_once __DIR__.'\..\..\models\Item.php';

    
    //Instantiate DB & connect
    $database_ = new Database();
    $db = $database_->connect();

    //Instantiate object
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
