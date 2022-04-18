<?php

require_once "./mvc/core/Model.php";

class UserModel extends Model {
    private $db_table = "users";
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
        else throw new Exception("User ID does not exist");
    }

    public function create($email, $password, $username, $first_name, $last_name, $contact_number,
    $address, $district, $city, $role, $profile_img) 
        {
            $query = 'INSERT INTO '.$this->db_table.' (email, password, username, first_name, last_name, contact_number,
                address, district, city, role, profile_img) 
                VALUES ('.$email.', '.$password.', '.$username.', '.$first_name.', '.$last_name.', '.$contact_number.',
                '.$address.', '.$district.', '.$city.', '.$role.', '.$profile_img.')';
            
            $stmt = mysqli_query($this->conn, $query);    
            if($stmt) {
                return true;
            }
            else {
                return false;
            }
        }
    
    public function update($id, $email, $password, $username, $first_name, $last_name, $contact_number,
    $address, $district, $city, $role, $profile_img) 
        {
            $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
            $condstmt = mysqli_query($this->conn, $condquery);
            if (mysqli_num_rows($condstmt) <= 0) return false;
            $flag = 1;
            if ($email != "null") {
                $query = 'UPDATE '.$this->db_table.' SET email = '.$email.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($password != "null") {
                $query = 'UPDATE '.$this->db_table.' SET password = '.$password.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($username != "null") {
                $query = 'UPDATE '.$this->db_table.' SET username = '.$username.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($first_name != "null") {
                $query = 'UPDATE '.$this->db_table.' SET first_name = '.$first_name.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($last_name != "null") {
                $query = 'UPDATE '.$this->db_table.' SET last_name = '.$last_name.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($contact_number != "null") {
                $query = 'UPDATE '.$this->db_table.' SET contact_number = '.$contact_number.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($address != "null") {
                $query = 'UPDATE '.$this->db_table.' SET address = '.$address.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($district != "null") {
                $query = 'UPDATE '.$this->db_table.' SET district = '.$district.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($city != "null") {
                $query = 'UPDATE '.$this->db_table.' SET city = '.$city.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($role != "null") {
                $query = 'UPDATE '.$this->db_table.' SET role = '.$role.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($profile_img != "null") {
                $query = 'UPDATE '.$this->db_table.' SET profile_img = '.$profile_img.' WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }
            return $flag;
        }
    public function delete($id) {
        $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
        $condstmt = mysqli_query($this->conn, $condquery);
        if (mysqli_num_rows($condstmt)<=0) return false;
        
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