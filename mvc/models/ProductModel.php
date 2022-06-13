<?php

require_once "./mvc/core/Model.php";

class ProductModel extends Model {
    private $db_table = "products";

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
        else throw new Exception("Product ID does not exist");
    }

    public function create($product_name, $price, $image, $type, $brand, $hf_1, $hf_2, $hf_3, $hf_4, 
    $star_review, $description, $screen_size, $screen_tech, $screen_phan_giai, $screen_lam_tuoi, 
    $backcam_thong_so, $backcam_quay, $backcam_feature, $frontcam_thong_so, $frontcam_video, $CPU_chipset, 
    $CPU_thong_so, $CPU_GPU, $RAM_dung_luong, $RAM_bo_nho_trong, $pin_dung_luong, $pin_sac, 
    $pin_cong_sac, $communicate_sim, $communicate_OS, $communicate_NFC, $communicate_mang, 
    $communicate_wifi, $communicate_bluetooth, $communicate_GPS, $design_size, $design_weight, 
    $design_chatluong, $design_khung_vien) 
        {
            $query = 'INSERT INTO '.$this->db_table.' (product_name, price, image, type, brand, hf_1, hf_2, hf_3, hf_4, 
            star_review, description, screen_size, screen_tech, screen_phan_giai, screen_lam_tuoi, 
            backcam_thong_so, backcam_quay, backcam_feature, frontcam_thong_so, frontcam_video, CPU_chipset, 
            CPU_thong_so, CPU_GPU, RAM_dung_luong, RAM_bo_nho_trong, pin_dung_luong, pin_sac, 
            pin_cong_sac, communicate_sim, communicate_OS, communicate_NFC, communicate_mang, 
            communicate_wifi, communicate_bluetooth, communicate_GPS, design_size, design_weight, 
            design_chatluong, design_khung_vien, time_create, time_modified) 
                    VALUES ('.$product_name.', '.$price.', '.$image.', '.$type.', '.$brand.', '.$hf_1.', '.$hf_2.', '.$hf_3.',
            '.$hf_4.', '.$star_review.', '.$description.', '.$screen_size.', '.$screen_tech.', '.$screen_phan_giai.', '.$screen_lam_tuoi.', 
            '.$backcam_thong_so.', '.$backcam_quay.', '.$backcam_feature.', '.$frontcam_thong_so.', '.$frontcam_video.', '.$CPU_chipset.', 
            '.$CPU_thong_so.', '.$CPU_GPU.', '.$RAM_dung_luong.', '.$RAM_bo_nho_trong.', '.$pin_dung_luong.', '.$pin_sac.', 
            '.$pin_cong_sac.', '.$communicate_sim.', '.$communicate_OS.', '.$communicate_NFC.', '.$communicate_mang.', 
            '.$communicate_wifi.', '.$communicate_bluetooth.', '.$communicate_GPS.', '.$design_size.', '.$design_weight.', 
            '.$design_chatluong.', '.$design_khung_vien.', NOW(), NOW())';

            $stmt = mysqli_query($this->conn, $query);
            if($stmt) {
                return true;
            }
            else {
                return false;
            }
        }
    
    public function readByBrand($brand) {
        $query = 'SELECT * FROM '.$this->db_table.' WHERE brand="'.$brand.'";';
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $result[] = $row;
        }
        return  $result;
    }
    public function update($id, $product_name, $price, $image, $type, $brand, $hf_1, $hf_2, $hf_3, $hf_4, 
    $star_review, $description, $screen_size, $screen_tech, $screen_phan_giai, $screen_lam_tuoi, 
    $backcam_thong_so, $backcam_quay, $backcam_feature, $frontcam_thong_so, $frontcam_video, $CPU_chipset, 
    $CPU_thong_so, $CPU_GPU, $RAM_dung_luong, $RAM_bo_nho_trong, $pin_dung_luong, $pin_sac, 
    $pin_cong_sac, $communicate_sim, $communicate_OS, $communicate_NFC, $communicate_mang, 
    $communicate_wifi, $communicate_bluetooth, $communicate_GPS, $design_size, $design_weight, 
    $design_chatluong, $design_khung_vien) 
        {
            $condquery = "SELECT * FROM $this->db_table WHERE id=$id";
            $condstmt = mysqli_query($this->conn, $condquery);
            if (mysqli_num_rows($condstmt) <= 0) return false;
            $flag = 1;
            if ($product_name != "null") {
                $query = 'UPDATE '.$this->db_table.' SET product_name = '.$product_name.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($price != "null") {
                $query = 'UPDATE '.$this->db_table.' SET price = '.$price.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($image != "null") {
                $query = 'UPDATE '.$this->db_table.' SET image = '.$image.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($type != "null") {
                $query = 'UPDATE '.$this->db_table.' SET type = '.$type.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($brand != "null") {
                $query = 'UPDATE '.$this->db_table.' SET brand = '.$brand.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($hf_1 != "null") {
                $query = 'UPDATE '.$this->db_table.' SET hf_1 = '.$hf_1.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($hf_2 != "null") {
                $query = 'UPDATE '.$this->db_table.' SET hf_2 = '.$hf_2.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($hf_3 != "null") {
                $query = 'UPDATE '.$this->db_table.' SET hf_3 = '.$hf_3.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($hf_4 != "null") {
                $query = 'UPDATE '.$this->db_table.' SET hf_4 = '.$hf_4.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($star_review != "null") {
                $query = 'UPDATE '.$this->db_table.' SET star_review = '.$star_review.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($description != "null") {
                $query = 'UPDATE '.$this->db_table.' SET description = '.$description.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($screen_size != "null") {
                $query = 'UPDATE '.$this->db_table.' SET screen_size = '.$screen_size.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($screen_tech != "null") {
                $query = 'UPDATE '.$this->db_table.' SET screen_tech = '.$screen_tech.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($screen_phan_giai != "null") {
                $query = 'UPDATE '.$this->db_table.' SET screen_phan_giai = '.$screen_phan_giai.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($screen_lam_tuoi != "null") {
                $query = 'UPDATE '.$this->db_table.' SET screen_lam_tuoi = '.$screen_lam_tuoi.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($backcam_thong_so != "null") {
                $query = 'UPDATE '.$this->db_table.' SET backcam_thong_so = '.$backcam_thong_so.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($backcam_quay != "null") {
                $query = 'UPDATE '.$this->db_table.' SET backcam_quay = '.$backcam_quay.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($backcam_feature != "null") {
                $query = 'UPDATE '.$this->db_table.' SET backcam_feature = '.$backcam_feature.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($frontcam_thong_so != "null") {
                $query = 'UPDATE '.$this->db_table.' SET frontcam_thong_so = '.$frontcam_thong_so.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($frontcam_video != "null") {
                $query = 'UPDATE '.$this->db_table.' SET frontcam_video = '.$frontcam_video.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($CPU_chipset != "null") {
                $query = 'UPDATE '.$this->db_table.' SET CPU_chipset = '.$CPU_chipset.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($CPU_thong_so != "null") {
                $query = 'UPDATE '.$this->db_table.' SET CPU_thong_so = '.$CPU_thong_so.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($CPU_GPU != "null") {
                $query = 'UPDATE '.$this->db_table.' SET CPU_GPU = '.$CPU_GPU.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($RAM_dung_luong != "null") {
                $query = 'UPDATE '.$this->db_table.' SET RAM_dung_luong = '.$RAM_dung_luong.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($RAM_bo_nho_trong != "null") {
                $query = 'UPDATE '.$this->db_table.' SET RAM_bo_nho_trong = '.$RAM_bo_nho_trong.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($pin_dung_luong != "null") {
                $query = 'UPDATE '.$this->db_table.' SET pin_dung_luong = '.$pin_dung_luong.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($pin_sac != "null") {
                $query = 'UPDATE '.$this->db_table.' SET pin_sac = '.$pin_sac.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($pin_cong_sac != "null") {
                $query = 'UPDATE '.$this->db_table.' SET pin_cong_sac = '.$pin_cong_sac.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_sim != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_sim = '.$communicate_sim.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_OS != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_OS = '.$communicate_OS.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_NFC != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_NFC = '.$communicate_NFC.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_mang != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_mang = '.$communicate_mang.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_wifi != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_wifi = '.$communicate_wifi.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_bluetooth != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_bluetooth = '.$communicate_bluetooth.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($communicate_GPS != "null") {
                $query = 'UPDATE '.$this->db_table.' SET communicate_GPS = '.$communicate_GPS.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($design_size != "null") {
                $query = 'UPDATE '.$this->db_table.' SET design_size = '.$design_size.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($design_weight != "null") {
                $query = 'UPDATE '.$this->db_table.' SET design_weight = '.$design_weight.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($design_chatluong != "null") {
                $query = 'UPDATE '.$this->db_table.' SET design_chatluong = '.$design_chatluong.', time_modified = NOW() WHERE id='.$id.'';
                $stmt = mysqli_query($this->conn, $query);
        
                if(!$stmt) $flag = 0; 
            }

            if ($design_khung_vien != "null") {
                $query = 'UPDATE '.$this->db_table.' SET design_khung_vien = '.$design_khung_vien.', time_modified = NOW() WHERE id='.$id.'';
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

    public function searchProduct($name) {
        $query = 'SELECT * FROM '.$this->db_table.' WHERE product_name LIKE \'%'.$name.'%\';';
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 

        while($row = mysqli_fetch_assoc($stmt))
        {
            $result[] = $row;
        }
        return  $result;
    }

    public function filter($brand, $price_low_threshold, $price_high_threshold,
    $screen_size_low_threshold, $screen_size_high_threshold, $RAM_dung_luong_low_threshold, 
    $RAM_dung_luong_high_threshold, $pin_dung_luong_low_threshold, $pin_dung_luong_high_threshold,
    $RAM_bo_nho_trong_low_threshold, $RAM_bo_nho_trong_high_threshold) {
        $query = 'SELECT * FROM '.$this->db_table.' WHERE brand LIKE '.$brand.' AND 
        price > '.$price_low_threshold.' AND price < '.$price_high_threshold.' AND 
        screen_size > '.$screen_size_low_threshold.' AND screen_size < '.$screen_size_high_threshold.' AND
        RAM_dung_luong > '.$RAM_dung_luong_low_threshold.' AND RAM_dung_luong < '.$RAM_dung_luong_high_threshold.' AND
        pin_dung_luong > '.$pin_dung_luong_low_threshold.' AND pin_dung_luong < '.$pin_dung_luong_high_threshold.' AND 
        RAM_bo_nho_trong > '.$RAM_bo_nho_trong_low_threshold.' AND RAM_bo_nho_trong < '.$RAM_bo_nho_trong_high_threshold.';';
        $stmt = mysqli_query($this->conn, $query);
        $result = array(); 
       if (!$stmt)
            return $result;
        
        while($row = mysqli_fetch_assoc($stmt))
        {
            $result[] = $row;
        }
        return  $result;
    }
}
    
?>
