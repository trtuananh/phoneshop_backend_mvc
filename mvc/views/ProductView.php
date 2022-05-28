<?php

header('Content-Type: application/json');

class ProductView {
    public function readRespond($result) {
        echo json_encode($result);
    } 

    public function createRespond($success) {
        if ($success) 
            echo json_encode(array("message" => "success"));
        else 
            echo json_encode(array("message" => "error"));
    } 

    public function updateRespond($success) {
        if ($success) 
            echo json_encode(array("message" => "success"));
        else 
            echo json_encode(array("message" => "error"));
    }

    public function deleteRespond($success) {
        if ($success) 
            echo json_encode(array("message" => "success"));
        else 
            echo json_encode(array("message" => "error"));
    }
}

?>