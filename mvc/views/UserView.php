<?php

header('Content-Type: application/json');

class UserView {
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

    public function AddUserRespond($success) {
        if ($success == -2) {
            echo json_encode(array("message" => "Invalid email"));
        } 
        else if ($success == -1) {
            echo json_encode(array("message" => "Invalid username"));
        }
        else if ($success == 0) {
            echo json_encode(array("message" => "Password must be in 5-50 characters"));
        }
        else if ($success == 1) {
            echo json_encode(array("message" => "Duplicate email"));
        }
        if ($success == 2) {
            echo json_encode(array("message" => "Duplicate username"));
        }
        if ($success == 3) {
            echo json_encode(array("message" => "success"));
        }
        if ($success == 4) {
            echo json_encode(array("message" => "error"));
        }
    }
}

?>