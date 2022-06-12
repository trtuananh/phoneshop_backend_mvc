<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');

require_once "./mvc/models/PostModel.php";
require_once "./mvc/views/PostView.php";

class Post {
    private $model;
    private $view;

    function __construct() {
        $this->model = new PostModel();
        $this->view = new PostView();
    }

    function execute($arr) {
        if (isset($arr[1])) {
            if ($arr[1]=="create") {
                $data = json_decode(file_get_contents("php://input"));
                $user_id = $data->user_id;
                $version = $data->version;
                $blocks = $data->blocks;
                $this->view->createRespond($this->model->create($user_id, $version, $blocks));
            }
            else if ($arr[1]=="read") {
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
            else if ($arr[1]=="update") {
                $data = json_decode(file_get_contents("php://input"));

                $id = $data->post_id;
                $version = $data->version;
                $blocks = $data->blocks;
                $this->view->updateRespond($this->model->update($id, $version, $blocks));
            }
            else if ($arr[1]=="delete") {
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    $this->view->deleteRespond($this->model->delete($arr[2]));
                }
                else throw new Exception("wrong post id");
            }
            else throw new Exception("wrong URL");
        }
        else throw new Exception("wrong URL");
    }

}

?>