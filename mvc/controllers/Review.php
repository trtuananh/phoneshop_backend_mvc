<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');

require_once "./mvc/models/ReviewModel.php";
require_once "./mvc/views/ReviewView.php";

class Review {
    private $model;
    private $view;

    function __construct() {
        $this->model = new ReviewModel();
        $this->view = new ReviewView();
    }

    function execute($arr) {
        if (isset($arr[1])) {
            if ($arr[1]=="create") {
                //echo "create";
                $data = json_decode(file_get_contents("php://input"));

                $product_id = $data->product_id;
                $user_id = $data->user_id;
                $star_rating = $data->star_rating;
                $content = $data->content;
                //echo $content;
                $this->view->createRespond($this->model->create($user_id, $product_id, $star_rating, $content));
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
                else throw new Exception("wrong product id");
            }
            else if ($arr[1]=="update") {
                $data = json_decode(file_get_contents("php://input"));

                $id = $data->review_id;
                $star_rating = $data->star_rating;
                $content = $data->content;
                
                $this->view->updateRespond($this->model->update($id, $star_rating, $content));
            }
            else if ($arr[1]=="delete") {
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    $this->view->deleteRespond($this->model->delete($arr[2]));
                }
                else throw new Exception("wrong review id");
            }
            else throw new Exception("wrong URL");
        }
        else throw new Exception("wrong URL");
    }

}

?>