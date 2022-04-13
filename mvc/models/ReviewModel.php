<?php

require_once "./mvc/core/Model.php";

class ReviewModel extends Model {
    private $db_table = "reviews";

    public function read($product_id) {
        $query = "SELECT * FROM $this->db_table WHERE product_id=$product_id ORDER BY time DESC";
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $result[] = $row;
        }
        return  $result;
    }

    public function create($product_id, $user_id, $star_rating, $content) {
        $condquery = "SELECT * FROM $this->db_table WHERE product_id=$product_id, user_id=$user_id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)>0) return false;

        $query = "INSERT INTO $this->db_table (product_id, user_id, star_rating, content) 
                VALUES ($product_id, $user_id, $star_rating, '$content')";
        $stmt = mysqli_query($this->conn, $query);
        
        if($stmt) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update($id, $star_rating, $data) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)==0) return false;

        $flag = 1;
        
        if ($star_rating) {
            $query = "UPDATE table_name
            SET star_rating = $star_rating
            WHERE id=$id";
            $stmt = mysqli_query($this->conn, $query);
        
            if(!$stmt) $flag = 0; 
        }

        if ($data) {
            $query = "UPDATE table_name
            SET data = $data
            WHERE id=$id";
            $stmt = mysqli_query($this->conn, $query);
        
            if(!$stmt) $flag = 0; 
        }

        return $flag;
    }

    public function delete($id) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)==0) return false;
        
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