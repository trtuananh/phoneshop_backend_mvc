<?php

require_once "./mvc/core/Model.php";

class OrderProductModel extends Model {
    private $db_table = "orders_product";

    public function create($order_id, $product_id, $quantity) {
        $query = "INSERT INTO $this->db_table (order_id, product_id, quantity) 
        VALUES ($order_id, $product_id, $quantity)";
        $stmt = mysqli_query($this->conn,$query);
        if($stmt) {
            return true;
        }
        else {
            return false;
        }
    } 

    public function read($order_id) {
        $query = "SELECT * FROM $this->db_table WHERE order_id=$order_id;";
        $stmt = mysqli_query($this->conn,$query);
        $result = array(); 
        while($row = mysqli_fetch_assoc($stmt))
        {
            $result[] = $row;
        }
        return  $result;
    }
}
    
?>