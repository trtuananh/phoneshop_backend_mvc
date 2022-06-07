<?php

require_once "./mvc/core/Model.php";

class PostModel extends Model {
    private $db_table = "posts";

    public function readList() {
        $query = "SELECT * FROM $this->db_table ORDER BY time DESC;";
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $row['blocks'] = json_decode($row['blocks']);
            $result[] = $row;
        }
        return  $result;
    }

    public function readID($id) {
        $query = "SELECT * FROM $this->db_table WHERE id=$id;";
        $stmt = mysqli_query($this->conn, $query);

        if (mysqli_num_rows($stmt) > 0) {
            $result = mysqli_fetch_assoc($stmt);
            $result['blocks'] = json_decode($result['blocks']);
            return $result;
        }
        else return array("message" => "Post ID doesn't exist");
    }

    public function create($user_id, $version, $blocks) {
        $query = "INSERT INTO $this->db_table (user_id, version, blocks) 
                VALUES ($user_id, '$version', " . json_encode($blocks) . ")";
        $stmt = mysqli_query($this->conn, $query);
        
        if($stmt) {
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

        $query = "UPDATE $this->db_table SET version=$version, blocks='" . json_encode($blocks) . "' WHERE id=$id";
        $stmt = mysqli_query($this->conn, $query);

        if ($stmt) return true;
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
