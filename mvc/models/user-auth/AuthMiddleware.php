<?php
require 'VmtHandler.php';

class Auth
{
    protected $db;
    protected $headers;
    protected $token;

    public function __construct($db, $headers)
    {
        $this->db = $db;
        $this->headers = $headers;
    }

    public function isValid()
    {

        if (array_key_exists('Authorization', $this->headers) && preg_match('/Bearer\s(\S+)/', $this->headers['Authorization'], $matches)) {
            //$data = $this->jwtDecodeData($matches[1]);
            $vmt = new VmtHandler();
            $data = $vmt->VmtDecode($matches[1]);
            $data = json_decode($data);
            if (
                isset($data->id) &&
                $user = $this->fetchUser($data->id)
            ) :
                return [
                    "success" => 1,
                    "user" => $user
                ];
            else :
                return [
                    "success" => 0,
                    "message" => 'Wrong token',
                ];
            endif;
        } else {
            return [
                "success" => 0,
                "message" => "Token not found in request"
            ];
        }
    }

    protected function fetchUser($user_id)
    {
        try {
            $query = 'SELECT id, email, username, first_name, last_name, contact_number, address, district,
            city, role, profile_img FROM users WHERE id='.$user_id.';';
            $query_stmt = mysqli_query($this->db, $query);
            if(mysqli_num_rows($query_stmt)>0) {
                $row = mysqli_fetch_assoc($query_stmt);
                return $row;
            }
            else return false;
        } catch (PDOException $e) {
            return null;
        }
    }
}

?>