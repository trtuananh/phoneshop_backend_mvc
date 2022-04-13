<?php

require_once "./mvc/core/Model.php";
require_once "./mvc/models/OrderProductModel.php";

class OrderModel extends Model {
    private $db_table = "orders";
    private static $count = 0;
    private $orderProduct;

    public function __construct()
    {
        parent::__construct();

        $this->orderProduct = new OrderProductModel();
    }

    public function read($user_id) {
        //if (!$this->conn) echo "null";
        $query = "SELECT * FROM $this->db_table WHERE user_id=$user_id";
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $row["product_list"] = $this->orderProduct->read($row["id"]);
            $result[] = $row;
        }
        return  $result;
    }

    public function create($user_id, $productList) {
        //if (!$this->conn) echo "null";

        $query = "INSERT INTO $this->db_table (user_id) VALUES ($user_id)";
        $stmt = mysqli_query($this->conn, $query);
        
        //if (!$this->orderProduct) echo "null";

        foreach ($productList as $val) {
            
            if (!$this->orderProduct->create(self::$count, $val->product_id, $val->quantity)) 
                return false;
        }
        if($stmt) {
            self::$count++;
            return true;
        }
        else {
            return false;
        }
    } 
}
    
?>