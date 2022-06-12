<?php 

class Model {
    protected $servername = "fdb33.awardspace.net";
    protected $username = "4119014_webass";
    protected $password = "webassignment212";
    protected $db_name = "4119014_webass";
    protected $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);
        // Check connection
        if (!$this->conn) {
            echo "null";
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function dbConnection() {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);
        // Check connection
        if (!$conn) {
            echo "null";
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}

?>
