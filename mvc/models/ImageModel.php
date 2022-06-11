<?php

require_once "./mvc/core/Model.php";

class ImageModel extends Model {
    private $db_table = "image";

    public function read($block_id) {
        $query = "SELECT * FROM $this->db_table WHERE block_id=$block_id;";
        $stmt = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($stmt) > 0) {
            return mysqli_fetch_assoc($stmt);
        }
        else return array("message" => "Block ID doesn't exist");
    }

    public function create($block_id, $url, $caption, $withBorder, $withBackground, $stretched) {
        $withBorder += 0;
        $withBackground += 0;
        $stretched += 0;
        $query = "INSERT INTO $this->db_table (block_id, url, caption, withBorder, withBackground, stretched) 
                VALUES ($block_id, '$url', '$caption', $withBorder, $withBackground, $stretched);";
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