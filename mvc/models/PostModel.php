<?php

require_once "./mvc/core/Model.php";

class PostModel extends Model{
    private $db_table = "posts";

    public function readList() {
        $query = "SELECT * FROM $this->db_table;";
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $result[] = $row;
        }
        return  $result;
    }

    public function readID($id) {
        $query = "SELECT * FROM $this->db_table WHERE id=$id;";
        $stmt = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($stmt) > 0) return mysqli_fetch_assoc($stmt);
        else throw new Exception("Post ID does not exist");
    }

    public function create($user_id, $header, $img) {
        $query = "INSERT INTO $this->db_table (user_id, header, img) 
                VALUES ($user_id, $header, $img)";
        $stmt = mysqli_query($this->conn, $query);
        
        if($stmt) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($id, $header, $img) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)>0) return false;

        $flag = 1;

        if ($header) {
            $query = "UPDATE table_name SET header = $header WHERE id=$id";
            $stmt = mysqli_query($this->conn, $query);
        
            if(!$stmt) $flag = 0; 
        }

        if ($img) {
            $query = "UPDATE table_name SET img = $img WHERE id=$id";
            $stmt = mysqli_query($this->conn, $query);
        
            if(!$stmt) $flag = 0; 
        }

        return $flag;
    }

    public function delete($id) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)>0) return false;
        
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