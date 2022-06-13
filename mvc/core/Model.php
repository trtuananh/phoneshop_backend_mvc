<?php 

class Model {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "1234";
    protected $db_name = "phoneshop";
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
