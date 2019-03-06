<?php
    class User 
    {
        private $db;

        public function __construct() {
            $this->db = new Database();    
        }
        
        // Find user by e-mail
        public function findUserByEmail($email)
        {
            $this->db->query("SELECT * FROM user WHERE email = :email");
            $this->db->bind(":email", $email);

            $row = $this->db->single();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
            
        }
    }    
?>