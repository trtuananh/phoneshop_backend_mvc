<?php

header('Content-Type: application/json');

class ErrorView {
    public function respond() {
        echo json_encode(array("Error" => "Something has failed, please try again"));
    } 
}

?>