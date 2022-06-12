<?php

require_once "./mvc/core/Model.php";
require_once "./mvc/models/BlockModel.php";

class PostModel extends Model {
    private $db_table = "posts";

    public function __construct() {
        parent::__construct();

        $this->blockModel = new BlockModel();
    }

    public function readList() {
        $query = "SELECT * FROM $this->db_table ORDER BY time DESC;";
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $row['blocks'] = $this->blockModel->read($row['id']);
            $result[] = $row;
        }
        return  $result;
    }

    public function readID($id) {
        $query = "SELECT * FROM $this->db_table WHERE id=$id;";
        $stmt = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($stmt) > 0) {
            $result = mysqli_fetch_assoc($stmt);
            $result['blocks'] = $this->blockModel->read($result['id']);
            return $result;
        }
        else return array("message" => "Post ID doesn't exist");
    }

    public function create($user_id, $version, $blocks) {
        $query = "INSERT INTO $this->db_table (user_id, version) 
                VALUES ($user_id, '$version');";
        $stmt = mysqli_query($this->conn, $query);
        
        if($stmt) {
            $post_id = mysqli_insert_id($this->conn);
            for ($i = 0; $i < count($blocks); $i++) {
                if (!$this->blockModel->create($post_id, $blocks[$i]->id, $blocks[$i]->type, $blocks[$i]->data))
                    return false;
            }
            return true;
        }
        else {
            return false;
        }
    }

    public function update($id, $version, $blocks) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)<=0) 
            throw new Exception("wrong post id");

        $query = "UPDATE $this->db_table SET version='$version' WHERE id=$id";
        $stmt = mysqli_query($this->conn, $query);

        if ($stmt) {
            $this->blockModel->delete($id);
            for ($i = 0; $i < count($blocks); $i++) {
                if (!$this->blockModel->create($id, $blocks[$i]->id, $blocks[$i]->type, $blocks[$i]->data))
                    return false;
            }
            return true;
        }
        else return false;
    }

    public function delete($id) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)<=0) 
            throw new Exception("wrong post id");
        
        $query = "DELETE FROM $this->db_table WHERE id=$id";
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
