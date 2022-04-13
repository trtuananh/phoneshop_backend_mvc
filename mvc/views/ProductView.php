<?php

header('Content-Type: application/json');

class ProductView {
    public function readRespond($result) {
        echo json_encode($result);
    } 

    public function createRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Add review successful"));
        else 
            echo json_encode(array("Message" => "Add review failed"));
    } 

    public function updateRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Update review successful"));
        else 
            echo json_encode(array("Message" => "Update review failed"));
    }

    public function deleteRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Delete review successful"));
        else 
            echo json_encode(array("Message" => "Delete review failed"));
    }
}

?>