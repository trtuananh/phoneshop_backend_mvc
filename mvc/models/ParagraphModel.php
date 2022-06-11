<?php

require_once "./mvc/core/Model.php";

class ParagraphModel extends Model {
    private $db_table = "paragraph";

    public function read($block_id) {
        $query = "SELECT * FROM $this->db_table WHERE block_id=$block_id;";
        $stmt = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($stmt) > 0) {
            return mysqli_fetch_assoc($stmt);
        }
        else return array("message" => "Block ID doesn't exist");
    }

    public function create($block_id, $text) {
        $query = "INSERT INTO $this->db_table (block_id, text) 
                VALUES ($block_id, '$text')";
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