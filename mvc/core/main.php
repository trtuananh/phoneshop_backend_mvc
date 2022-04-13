<?php
/*class App {

    protected $controller="Home";

    function __construct(){
        $arr = $this->urlProcess();

        if (isset($arr[0]) && file_exists("./mvc/controllers/".$arr[0].".php")) {
            $this->controller = $arr[0];
        }
        require_once "./mvc/controllers/". $this->controller .".php";
        $this->controller = new $this->controller($arr);
        //print_r($arr);
    }

    function main() {

    }

    function urlProcess(){
        if( isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        else return array();
    }

}*/

function urlProcess(){
    if( isset($_GET["url"]) ){
        return explode("/", filter_var(trim($_GET["url"], "/")));
    }
    else return array();
}


function main() {
    $arr = urlProcess();
    $controller_name = "error";

    if (isset($arr[0]) && file_exists("./mvc/controllers/".$arr[0].".php")) {
        $controller_name = $arr[0];
    }

    require_once "./mvc/controllers/". $controller_name .".php";
    $controller = new $controller_name();

    try {
        $controller->execute($arr);
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>