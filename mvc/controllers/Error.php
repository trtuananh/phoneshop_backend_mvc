<?php

require_once "./mvc/views/ErrorView.php";

class Error {
    private $view;

    function __construct() {
        $this->view = new ErrorView();
    }

    function execute($arr) {
        $this->view->respond();
    }

}

?>