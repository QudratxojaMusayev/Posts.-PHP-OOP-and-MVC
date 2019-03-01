<?php

    class Pages extends Controller
    {
        public function __construct() {
            
        }

        public function index()
        {
            // echo "Hello from index";
            $init = new Pages();
            $data = [
                "title" => "Welcome"
            ];

            $init->view("pages/index", $data);
        }

        public function about()
        {
            $init = new Pages();
            $init->view("pages/about");
        }
    }
    
?>