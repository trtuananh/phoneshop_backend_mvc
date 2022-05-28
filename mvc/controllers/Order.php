<?php

header('Access-Control-Allow-Methods: POST');

require_once "./mvc/models/OrderModel.php";
require_once "./mvc/views/OderView.php";

class Order {
    private $model;
    private $view;

    function __construct() {
        $this->model = new OrderModel();
        $this->view = new OrderView();
    }

    function execute($arr) {
        if (isset($arr[1])) {
            if ($arr[1]=="create") {
                echo "create";
                $data = json_decode(file_get_contents("php://input"));

                $user_id = $data->user_id;
                $product_list = $data->product_list;
                $this->view->createRespond($this->model->create($user_id, $product_list));
            }
            else if ($arr[1]=="read") {
                //echo "read\n";
                //echo $arr[2];
                //echo is_integer($arr[2]);
                //echo ((int)$arr[2])>0;
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    //echo "right para";
                    $result = $this->model->read((int)$arr[2]);
                    $this->view->readRespond($result);
                }
                else throw new Exception("wrong user id");
            }
            else throw new Exception("wrong URL");
        }
        else throw new Exception("wrong URL");
    }

}

?>