<?php

header('Content-Type: application/json');

class UserView {
    public function readRespond($result) {
        echo json_encode($result);
    } 

    public function createRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Add user successful"));
        else 
            echo json_encode(array("Message" => "Add user failed"));
    } 

    public function updateRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Update user successful"));
        else 
            echo json_encode(array("Message" => "Update user failed"));
    }

    public function deleteRespond($success) {
        if ($success) 
            echo json_encode(array("Message" => "Delete user successful"));
        else 
            echo json_encode(array("Message" => "Delete user failed"));
    }
}

?>