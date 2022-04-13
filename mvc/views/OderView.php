<?php

header('Content-Type: application/json');

class OrderView {
    public function readRespond($result) {
        echo json_encode($result);
    } 

    public function createRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Add order successful"));
        else 
            echo json_encode(array("Message" => "Add order failed"));
    } 
}

?>