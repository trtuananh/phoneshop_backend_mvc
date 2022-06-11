<?php

require_once "./mvc/core/Model.php";

class HeaderModel extends Model {
    private $db_table = "header";

    public function read($block_id) {
        $query = "SELECT * FROM $this->db_table WHERE block_id=$block_id;";
        $stmt = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($stmt) > 0) {
            return mysqli_fetch_assoc($stmt);
        }
        else return array("message" => "Block ID doesn't exist");
    }

    public function create($block_id, $text, $level) {
        $query = "INSERT INTO $this->db_table (block_id, text, level) 
                VALUES ($block_id, '$text', $level)";
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