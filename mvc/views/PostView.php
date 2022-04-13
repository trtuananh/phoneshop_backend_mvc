<?php

header('Content-Type: application/json');

class PostView {
    public function readRespond($result) {
        echo json_encode($result);
    } 

    public function createRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Add post successful"));
        else 
            echo json_encode(array("Message" => "Add post failed"));
    } 

    public function updateRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Update post successful"));
        else 
            echo json_encode(array("Message" => "Update post failed"));
    }

    public function deleteRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Delete post successful"));
        else 
            echo json_encode(array("Message" => "Delete post failed"));
    }
}

?>