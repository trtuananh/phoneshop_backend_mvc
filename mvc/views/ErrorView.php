<?php

header('Content-Type: application/json');

class ErrorView {
    private $message;

    function __construct($err)
    {
        $this->message = $err;
    }

    public function respond() {
        echo json_encode(array("message" => $this->message));
    } 
}

?>