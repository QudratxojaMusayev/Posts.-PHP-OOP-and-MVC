<?php

    class Pages  
    {
        public function __construct() {
            
        }

        public function index()
        {
            echo "Pages and index method loaded";
        }

        public function about($id)
        {
            print_r($id);
        }
    }
    
?>