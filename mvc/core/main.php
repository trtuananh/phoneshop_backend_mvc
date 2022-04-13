<?php

function urlProcess(){
    if( isset($_GET["url"]) ){
        return explode("/", filter_var(trim($_GET["url"], "/")));
    }
    else return array();
}


function main() {
    $arr = urlProcess();

    if (isset($arr[0]) && file_exists("./mvc/controllers/".$arr[0].".php")) {
        $controller_name = $arr[0];

        require_once "./mvc/controllers/". $controller_name .".php";
        $controller = new $controller_name();

        try {
            $controller->execute($arr);
        }
        catch (Exception $e) {
            require_once "./mvc/views/ErrorView.php";
            $err = new ErrorView($e->getMessage());
            $err->respond();
        }
    }
    else {
        require_once "./mvc/views/ErrorView.php";
        $err = new ErrorView("file not exist");
        $err->respond();
    }
}

?>