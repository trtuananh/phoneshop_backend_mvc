<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

    public function login($username, $password) {
        require 'user-auth/JwtHandler.php';
        try{
            
            $query = 'SELECT * FROM '.$this->db_table.' WHERE username ="'.$username.'";';
            $query_stmt = mysqli_query($this->conn, $query);
            // IF THE USER IS FOUNDED BY EMAIL
            if(mysqli_num_rows($query_stmt)>0):
                $row = mysqli_fetch_assoc($query_stmt);
                $data = $row;
                $check_password = false;
                if ($data["password"] == $password) $check_password = true;

                // VERIFYING THE PASSWORD (IS CORRECT OR NOT?)
                // IF PASSWORD IS CORRECT THEN SEND THE LOGIN TOKEN
                if($check_password):

                    $jwt = new JwtHandler();
                    $token = $jwt->jwtEncodeData(
                        'http://localhost/phoneshop_backend_mvc/mvc/models/php-jwt/',
                        array("id"=> $data['id'],
                        )
                    );
                    
                    $returnData = [
                        'message' => 'successful',
                        'token' => $token
                    ];

                // IF INVALID PASSWORD
                else:
                    $returnData = array("message" => "Invalid password");
                endif;

            // IF THE USER IS NOT FOUNDED BY EMAIL THEN SHOW THE FOLLOWING ERROR
            else:
                $returnData = array("message" => "Invalid username");
            endif;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
        return $returnData;
    }

    public function getUser() {
        require 'user-auth/AuthMiddleware.php';

        $allHeaders = getallheaders();
        $conn = $this->dbConnection();
        $auth = new Auth($conn, $allHeaders);

        return $auth->isValid();
    }
}
    
?>