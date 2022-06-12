<?php

require_once "./mvc/core/Model.php";
require_once "./mvc/models/HeaderModel.php";
require_once "./mvc/models/ParagraphModel.php";
require_once "./mvc/models/ImageModel.php";

class BlockModel extends Model {
    private $db_table = "blocks";


    public function __construct() {
        parent::__construct();

        $this->headerModel = new HeaderModel();
        $this->paraModel = new ParagraphModel();
        $this->imgModel = new ImageModel();
    }

    public function read($post_id) {
        $query = "SELECT * FROM $this->db_table WHERE post_id=$post_id;";
        $stmt = mysqli_query($this->conn, $query);

        /*if (mysqli_num_rows($stmt) > 0) {
            $result = mysqli_fetch_assoc($stmt);
            $result['blocks'] = json_decode($result['blocks']);
            return $result;
        }
        else return array("message" => "Post ID doesn't exist");*/

        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            if ($row["type"]=="header") {
                $row["data"] = $this->headerModel->read($row["id"]);
            }
            else if ($row["type"]=="paragraph") {
                $row["data"] = $this->paraModel->read($row["id"]);
            }
            else {
                $row["data"] = $this->imgModel->read($row["id"]);
            }
            $row["id"] = $row["id_code"];
            unset($row["id_code"]);
            $result[] = $row;
        }
        return  $result;
    }

    public function create($post_id, $id_code, $type, $data) {
        $query = "INSERT INTO $this->db_table (post_id, id_code, type) 
                VALUES ($post_id, '$id_code', '$type');";
        $stmt = mysqli_query($this->conn, $query);
        
        if($stmt) {
            if ($type=="header") {
                return $this->headerModel->create(mysqli_insert_id($this->conn), $data->text, $data->level);
            }
            else if ($type=="paragraph") {
                return $this->paraModel->create(mysqli_insert_id($this->conn), $data->text);
            }
            else {
                return $this->imgModel->create(mysqli_insert_id($this->conn), 
                                                $data->url, 
                                                $data->caption,
                                                $data->withBorder,
                                                $data->withBackground,
                                                $data->stretched);
            }
        }
        else {
            return false;
        }
    }

    public function delete($post_id) {
        $condquery = "SELECT * FROM $this->db_table WHERE post_id=$post_id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)<=0) 
            throw new Exception("wrong post id");
        
        $query = "DELETE FROM $this->db_table WHERE post_id=$post_id";
        $stmt = mysqli_query($this->conn, $query);
        
        if($stmt) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>