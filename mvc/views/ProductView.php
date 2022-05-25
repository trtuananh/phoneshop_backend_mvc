<?php

header('Content-Type: application/json');

class ProductView {
    public function readRespond($result) {
        echo json_encode($result);
    } 

    public function createRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Add product successful"));
        else 
            echo json_encode(array("Message" => "Add product failed"));
    } 

    public function updateRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Update product successful"));
        else 
            echo json_encode(array("Message" => "Update product failed"));
    }

    public function deleteRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Delete product successful"));
        else 
            echo json_encode(array("Message" => "Delete product failed"));
    }
}

?>