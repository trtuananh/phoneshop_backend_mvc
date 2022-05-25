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
                //echo "create";
                $data = json_decode(file_get_contents("php://input"));

                $user_id = $data->user_id;
                $header = $data->header;
                $img = $data->img;
                $this->view->createRespond($this->model->create($user_id, $header, $img));
            }
            else if ($arr[1]=="read") {
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
            else if ($arr[1]=="update") {
                $data = json_decode(file_get_contents("php://input"));

                $id = $data->id;
                $header = $data->header;
                $img = $data->img;
                $this->view->updateRespond($this->model->update($id, $header, $img));
            }
            else if ($arr[1]=="delete") {
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    $this->view->deleteRespond($this->model->delete($arr[2]));
                }
                else throw new Exception("Wrong Post ID");
            }
            else throw new Exception("Wrong URL");
        }
        else throw new Exception("Wrong URL");
    }

}

?>