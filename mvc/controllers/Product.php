<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');

require_once "./mvc/models/ProductModel.php";
require_once "./mvc/views/ProductView.php";

class Product {
    private $model;
    private $view;

    function __construct() {
        $this->model = new ProductModel();
        $this->view = new ProductView();
    }

    function execute($arr) {
        if (isset($arr[1])) {
            if ($arr[1]=="read") {
                //echo "read\n";
                //echo $arr[2];
                //echo is_integer($arr[2]);
                //echo ((int)$arr[2])>0;
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    //echo "right para";
                    $result = $this->model->readID((int)$arr[2]);
                    $this->view->readRespond($result);
                }
                else {
                    $result = $this->model->readList();
                    $this->view->readRespond($result);
                }
            }
            else throw new Exception("Wrong URL");
        }
        else throw new Exception("Wrong URL");
    }

}

?>