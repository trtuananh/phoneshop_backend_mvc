<?php
    class VmtHandler {
        private $ciphering ;
        private $iv_length ;
        private $options ;
        private $encryption_iv ;
        private $encryption_key ;

        public function __construct() {
            $this->ciphering = "AES-128-CTR";
            $this->iv_length = openssl_cipher_iv_length($this->ciphering);
            $this->options = 0;
            $this->encryption_iv = '1234567891011121';
            $this->encryption_key = "VoMinhTri";
        }
        public function VmtEncode($dataString) {
            // Use openssl_encrypt() function to encrypt the data
            $encryption = openssl_encrypt($dataString, $this->ciphering,
              $this->encryption_key, $this->options, $this->encryption_iv);
  
            return $encryption;
        }
        public function VmtDecode($dataString) {
            // Use openssl_encrypt() function to encrypt the data
            $decryption = openssl_decrypt($dataString, $this->ciphering,
              $this->encryption_key, $this->options, $this->encryption_iv);
            
            return $decryption;
        }
        
    }
?>