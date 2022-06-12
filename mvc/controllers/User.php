<?php
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Methods: DELETE');
    
    require_once "./mvc/models/UserModel.php";
    require_once "./mvc/views/UserView.php";

class User {
    private $model;
    private $view;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    function execute($arr) {
        if (isset($arr[1])) {
            if ($arr[1]=="read") {
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    $result = $this->model->readID((int)$arr[2]);
                    $this->view->readRespond($result);
                }
                else {
                    $result = $this->model->readList();
                    $this->view->readRespond($result);
                }
            }
            else if ($arr[1]=="create") {
                $data = json_decode(file_get_contents("php://input"));
                
                $email = $data->email != "" ? '"'.$data->email.'"' : "";
                $password = $data->password != "" ? '"'.$data->password.'"' : "";
                $username = $data->username != "" ? '"'.$data->username.'"' : "";
                if ($email  != "" && $password != "" && $username != "") {
                    $last_name = isset($data->lastname) ? '"'.$data->lastname.'"' : "null";
                    $first_name = isset($data->firstname) ? '"'.$data->firstname.'"' : "null";
                    $contact_number= isset($data->contact_number) ? '"'.$data->contact_number.'"' : "null";
                    $address= isset($data->address) ? '"'.$data->address.'"' : "null";
                    $district= isset($data->district) ? '"'.$data->district.'"' : "null";
                    $city= isset($data->city) ? '"'.$data->city.'"' : "null";
                    $role= isset($data->role) ? '"'.$data->role.'"' : "0";
                    $profile_img= isset($data->profile_img) ? '"'.$data->profile_img.'"' : "null";
                    $this->view->AddUserRespond($this->model->create($email, $password, $username, $first_name, 
                       $last_name, $contact_number, $address, $district, $city, $role, $profile_img));
                }

            }
            else if ($arr[1]=="update") {
                $data = json_decode(file_get_contents("php://input"));

                $id = $data->id;
                $email = isset($data->email) ? '"'.$data->email.'"' : "null";
                $password = isset($data->password) ? '"'.$data->password.'"' : "null";
                $username = isset($data->username) ? '"'.$data->username.'"' : "null";
                $last_name = isset($data->last_name) ? '"'.$data->last_name.'"' : "null";
                $first_name = isset($data->first_name) ? '"'.$data->first_name.'"' : "null";
                $contact_number= isset($data->contact_number) ? '"'.$data->contact_number.'"' : "null";
                $address= isset($data->address) ? '"'.$data->address.'"' : "null";
                $district= isset($data->district) ? '"'.$data->district.'"' : "null";
                $city= isset($data->city) ? '"'.$data->city.'"' : "null";
                $role= isset($data->role) ? '"'.$data->role.'"' : "null";
                $profile_img= isset($data->profile_img) ? '"'.$data->profile_img.'"' : "null";
                $result = $this->model->update($id, $email, $password, $username, $first_name, 
                     $last_name, $contact_number, $address, $district, $city, $role, $profile_img);
                $this->view->updateRespond($result);
            }
            else if ($arr[1]=="delete") {
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    $this->view->deleteRespond($this->model->delete($arr[2]));
                }
                else throw new Exception("Wrong Post ID");
            }
            else if ($arr[1]=="login") {
                $data = json_decode(file_get_contents("php://input"));
                $username = $data->username;
                $password = $data->password;
                $result = $this->model->login($username, $password);
                $this->view->readRespond($result);
            }
            else if ($arr[1]=="getUser") {
                $result = $this->model->getUser();
                $this->view->readRespond($result);
            }
            else throw new Exception("Wrong URL");
        }
        else throw new Exception("Wrong URL");
    }

}
?>
