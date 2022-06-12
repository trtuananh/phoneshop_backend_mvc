<?php

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');

require_once "./mvc/models/ProductModel.php";
require_once "./mvc/views/ProductView.php";

class Product {
    private $model;
    private $view;

    function __construct() {
        $this->model = new ProductModel();
        $this->view = new ProductView();
    }

    function execute($arr) {
        if (isset($arr[1])) {
            if ($arr[1]=="read") {
                //echo "read\n";
                //echo $arr[2];
                //echo is_integer($arr[2]);
                //echo ((int)$arr[2])>0;
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    //echo "right para";
                    $result = $this->model->readID((int)$arr[2]);
                    $this->view->readRespond($result);
                }
                else {
                    $result = $this->model->readList();
                    $this->view->readRespond($result);
                }
            }
            else if ($arr[1]=="create") {
                //echo "create";
                $data = json_decode(file_get_contents("php://input"));
                
                $product_name = '"'.$data->product_name.'"';
                $price = $data->price;
                $image = '"'.$data->image.'"';
                $type = '"'.$data->type.'"';
                $brand = '"'.$data->brand.'"';
                $hf_1= isset($data->hf_1) ? '"'.$data->hf_1.'"' : "null";
                $hf_2= isset($data->hf_2) ? '"'.$data->hf_2.'"' : "null";
                $hf_3= isset($data->hf_3) ? '"'.$data->hf_3.'"' : "null";
                $hf_4= isset($data->hf_4) ? '"'.$data->hf_4.'"' : "null"; 
                $star_review= isset($data->star_review) ? $data->star_review : "null";
                $description= isset($data->description) ? '"'.$data->description.'"' : "null";
                $screen_size= isset($data->screen_size) ? $data->screen_size : "null";
                $screen_tech= isset($data->screen_tech) ? '"'.$data->screen_tech.'"' : "null";
                $screen_phan_giai= isset($data->screen_phan_giai) ? '"'.$data->screen_phan_giai.'"' : "null";
                $screen_lam_tuoi= isset($data->screen_lam_tuoi) ? '"'.$data->screen_lam_tuoi.'"' : "null"; 
                $backcam_thong_so= isset($data->backcam_thong_so) ? '"'.$data->backcam_thong_so.'"' : "null";
                $backcam_quay= isset($data->backcam_quay) ? '"'.$data->backcam_quay.'"' : "null";
                $backcam_feature= isset($data->backcam_feature) ? '"'.$data->backcam_feature.'"' : "null";
                $frontcam_thong_so= isset($data->frontcam_thong_so) ? '"'.$data->frontcam_thong_so.'"' : "null";
                $frontcam_video= isset($data->frontcam_video) ? '"'.$data->frontcam_video.'"' : "null";
                $CPU_chipset= isset($data->CPU_chipset) ? '"'.$data->CPU_chipset.'"' : "null";
                $CPU_thong_so= isset($data->CPU_thong_so) ? '"'.$data->CPU_thong_so.'"' : "null";
                $CPU_GPU= isset($data->CPU_GPU) ? '"'.$data->CPU_GPU.'"' : "null";
                $RAM_dung_luong= isset($data->RAM_dung_luong) ? $data->RAM_dung_luong : "null";
                $RAM_bo_nho_trong= isset($data->RAM_bo_nho_trong) ? $data->RAM_bo_nho_trong : "null";
                $pin_dung_luong= isset($data->pin_dung_luong) ? $data->pin_dung_luong : "null";
                $pin_sac= isset($data->pin_sac) ? '"'.$data->pin_sac.'"' : "null";
                $pin_cong_sac= isset($data->pin_cong_sac) ? '"'.$data->pin_cong_sac.'"' : "null";
                $communicate_sim= isset($data->communicate_sim) ? '"'.$data->communicate_sim.'"' : "null";
                $communicate_OS= isset($data->communicate_OS) ? '"'.$data->communicate_OS.'"' : "null";
                $communicate_NFC= isset($data->communicate_NFC) ? '"'.$data->communicate_NFC.'"' : "null";
                $communicate_mang= isset($data->communicate_mang) ? '"'.$data->communicate_mang.'"' : "null";  
                $communicate_wifi= isset($data->communicate_wifi) ? '"'.$data->communicate_wifi.'"' : "null";
                $communicate_bluetooth= isset($data->communicate_bluetooth) ? '"'.$data->communicate_bluetooth.'"' : "null";
                $communicate_GPS= isset($data->communicate_GPS) ? '"'.$data->communicate_GPS.'"' : "null";
                $design_size= isset($data->design_size) ? '"'.$data->design_size.'"' : "null";
                $design_weight= isset($data->design_weight) ? '"'.$data->design_weight.'"' : "null";  
                $design_chatluong= isset($data->design_chatluong) ? '"'.$data->design_chatluong.'"' : "null";
                $design_khung_vien= isset($data->design_khung_vien) ? '"'.$data->design_khung_vien.'"' : "null";
                
                $result = $this->model->create($product_name, $price, $image, $type, $brand, $hf_1, $hf_2, $hf_3, $hf_4, 
                $star_review, $description, $screen_size, $screen_tech, $screen_phan_giai, $screen_lam_tuoi, 
                $backcam_thong_so, $backcam_quay, $backcam_feature, $frontcam_thong_so, $frontcam_video, $CPU_chipset, 
                $CPU_thong_so, $CPU_GPU, $RAM_dung_luong, $RAM_bo_nho_trong, $pin_dung_luong, $pin_sac, 
                $pin_cong_sac, $communicate_sim, $communicate_OS, $communicate_NFC, $communicate_mang, 
                $communicate_wifi, $communicate_bluetooth, $communicate_GPS, $design_size, $design_weight, 
                $design_chatluong, $design_khung_vien);
                $this->view->createRespond($result);
            }

            else if ($arr[1]=="readByBrand") {
                
                if (isset($arr[2])) {
                    //echo "right para";
                    $result = $this->model->readByBrand($arr[2]);
                    $this->view->readRespond($result);
                }
            }

            else if ($arr[1]=="update") {
                $data = json_decode(file_get_contents("php://input"));
                
                $id = $data->id;
                $product_name = isset($data->product_name) ? '"'.$data->product_name.'"' : "null";
                $price = isset($data->price) ? $data->price : "null";
                $image = isset($data->image) ? '"'.$data->image.'"' : "null";
                $type = isset($data->type) ? '"'.$data->type.'"' : "null";
                $brand = isset($data->brand) ? '"'.$data->brand.'"' : "null";
                $hf_1= isset($data->hf_1) ? '"'.$data->hf_1.'"' : "null";
                $hf_2= isset($data->hf_2) ? '"'.$data->hf_2.'"' : "null";
                $hf_3= isset($data->hf_3) ? '"'.$data->hf_3.'"' : "null";
                $hf_4= isset($data->hf_4) ? '"'.$data->hf_4.'"' : "null"; 
                $star_review= isset($data->star_review) ? $data->star_review : "null";
                $description= isset($data->description) ? '"'.$data->description.'"' : "null";
                $screen_size= isset($data->screen_size) ? $data->screen_size : "null";
                $screen_tech= isset($data->screen_tech) ? '"'.$data->screen_tech.'"' : "null";
                $screen_phan_giai= isset($data->screen_phan_giai) ? '"'.$data->screen_phan_giai.'"' : "null";
                $screen_lam_tuoi= isset($data->screen_lam_tuoi) ? '"'.$data->screen_lam_tuoi.'"' : "null"; 
                $backcam_thong_so= isset($data->backcam_thong_so) ? '"'.$data->backcam_thong_so.'"' : "null";
                $backcam_quay= isset($data->backcam_quay) ? '"'.$data->backcam_quay.'"' : "null";
                $backcam_feature= isset($data->backcam_feature) ? '"'.$data->backcam_feature.'"' : "null";
                $frontcam_thong_so= isset($data->frontcam_thong_so) ? '"'.$data->frontcam_thong_so.'"' : "null";
                $frontcam_video= isset($data->frontcam_video) ? '"'.$data->frontcam_video.'"' : "null";
                $CPU_chipset= isset($data->CPU_chipset) ? '"'.$data->CPU_chipset.'"' : "null";
                $CPU_thong_so= isset($data->CPU_thong_so) ? '"'.$data->CPU_thong_so.'"' : "null";
                $CPU_GPU= isset($data->CPU_GPU) ? '"'.$data->CPU_GPU.'"' : "null";
                $RAM_dung_luong= isset($data->RAM_dung_luong) ? $data->RAM_dung_luong : "null";
                $RAM_bo_nho_trong= isset($data->RAM_bo_nho_trong) ? $data->RAM_bo_nho_trong : "null";
                $pin_dung_luong= isset($data->pin_dung_luong) ? $data->pin_dung_luong : "null";
                $pin_sac= isset($data->pin_sac) ? '"'.$data->pin_sac.'"' : "null";
                $pin_cong_sac= isset($data->pin_cong_sac) ? '"'.$data->pin_cong_sac.'"' : "null";
                $communicate_sim= isset($data->communicate_sim) ? '"'.$data->communicate_sim.'"' : "null";
                $communicate_OS= isset($data->communicate_OS) ? '"'.$data->communicate_OS.'"' : "null";
                $communicate_NFC= isset($data->communicate_NFC) ? '"'.$data->communicate_NFC.'"' : "null";
                $communicate_mang= isset($data->communicate_mang) ? '"'.$data->communicate_mang.'"' : "null";  
                $communicate_wifi= isset($data->communicate_wifi) ? '"'.$data->communicate_wifi.'"' : "null";
                $communicate_bluetooth= isset($data->communicate_bluetooth) ? '"'.$data->communicate_bluetooth.'"' : "null";
                $communicate_GPS= isset($data->communicate_GPS) ? '"'.$data->communicate_GPS.'"' : "null";
                $design_size= isset($data->design_size) ? '"'.$data->design_size.'"' : "null";
                $design_weight= isset($data->design_weight) ? '"'.$data->design_weight.'"' : "null";  
                $design_chatluong= isset($data->design_chatluong) ? '"'.$data->design_chatluong.'"' : "null";
                $design_khung_vien= isset($data->design_khung_vien) ? '"'.$data->design_khung_vien.'"' : "null";
                
                $result = $this->model->update($id, $product_name, $price, $image, $type, $brand, $hf_1, $hf_2, $hf_3, $hf_4, 
                $star_review, $description, $screen_size, $screen_tech, $screen_phan_giai, $screen_lam_tuoi, 
                $backcam_thong_so, $backcam_quay, $backcam_feature, $frontcam_thong_so, $frontcam_video, $CPU_chipset, 
                $CPU_thong_so, $CPU_GPU, $RAM_dung_luong, $RAM_bo_nho_trong, $pin_dung_luong, $pin_sac, 
                $pin_cong_sac, $communicate_sim, $communicate_OS, $communicate_NFC, $communicate_mang, 
                $communicate_wifi, $communicate_bluetooth, $communicate_GPS, $design_size, $design_weight, 
                $design_chatluong, $design_khung_vien);
                $this->view->updateRespond($result);
            }
            else if ($arr[1]=="delete") {
                if (isset($arr[2]) && is_numeric($arr[2]) && (int)$arr[2]>0) {
                    $this->view->deleteRespond($this->model->delete($arr[2]));
                }
                else throw new Exception("Wrong Product ID");
            }
            else if ($arr[1]=="searchProduct") {
                if (isset($arr[2])) {
                    $this->view->readRespond($this->model->searchProduct($arr[2]));
                }
            }
            else if ($arr[1]=="filter") {
                $data = json_decode(file_get_contents("php://input"));
                $brand = isset($data->brand) ? '"'.$data->brand.'"' : '"%"';
                $price_low_threshold = isset($data->price_low_threshold) ? $data->price_low_threshold : -100;
                $price_high_threshold = isset($data->price_high_threshold) ? $data->price_high_threshold : 999999999999999;
                $screen_size_low_threshold = isset($data->screen_size_low_threshold) ? $data->screen_size_low_threshold : -100;
                $screen_size_high_threshold = isset($data->screen_size_high_threshold) ? $data->screen_size_high_threshold : 999999999999999;
                $RAM_dung_luong_low_threshold = isset($data->RAM_dung_luong_low_threshold) ? $data->RAM_dung_luong_low_threshold : -100;
                $RAM_dung_luong_high_threshold = isset($data->RAM_dung_luong_high_threshold) ? $data->RAM_dung_luong_high_threshold : 999999999999999;
                $pin_dung_luong_low_threshold = isset($data->pin_dung_luong_low_threshold) ? $data->pin_dung_luong_low_threshold : -100;
                $pin_dung_luong_high_threshold = isset($data->pin_dung_luong_high_threshold) ? $data->pin_dung_luong_high_threshold : 999999999999999;
                $RAM_bo_nho_trong_low_threshold = isset($data->RAM_bo_nho_trong_low_threshold) ? $data->RAM_bo_nho_trong_low_threshold : -100;
                $RAM_bo_nho_trong_high_threshold = isset($data->RAM_bo_nho_trong_high_threshold) ? $data->RAM_bo_nho_trong_high_threshold : 999999999999999;

                $this->view->readRespond($this->model->filter($brand, $price_low_threshold, $price_high_threshold,
                $screen_size_low_threshold, $screen_size_high_threshold, $RAM_dung_luong_low_threshold, 
                $RAM_dung_luong_high_threshold, $pin_dung_luong_low_threshold, $pin_dung_luong_high_threshold,
                $RAM_bo_nho_trong_low_threshold, $RAM_bo_nho_trong_high_threshold));
            }
            else throw new Exception("Wrong URL");
        }
        else throw new Exception("Wrong URL");
    }

}

?>
