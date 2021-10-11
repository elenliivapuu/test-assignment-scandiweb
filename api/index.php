<?php
    // Headers and files
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, DELETE');
    include_once('config/Database.php');
    include_once('models/Item.php');

    // Instantiate DB & connect
    $database_ = new Database();
    $db = $database_->connect();

    // Request method/type
    $method = $_SERVER['REQUEST_METHOD'];
    // Parameters
    $prms = explode('/', trim($_SERVER['PATH_INFO'], '\x20\x2f'));
    $cat = $prms[1];

    if ($cat == "products" && $method === "GET") {
        handleGET($db);
    } else if ($cat == "products" && $method === "POST") {
        if (isset($_POST['new'])) {
            $data = $_POST['new'];
            handleCREATE($db, $data);
        }
    } else if ($cat == "products" && $method === "DELETE") {
        if ($prms[2] != null) {
            $prod_id = $prms[2];
            handleDEL($db, $prod_id);
        }
    }

    function handleGET($db) {
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
    }

    function handleDEL($db, $prod_id) {
        $item_ = new Item($db);
        $item_->setid($prod_id);

        if($item_->delete()) {
            $results = json_encode(array('message' => 'Item Deleted'));
        } else {
            $results = json_encode(array('message' => 'Post Not Deleted'));
        }
    }

    function handleCREATE($db, $data) {
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
    }
?>
