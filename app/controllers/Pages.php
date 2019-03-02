<?php

    class Pages extends Controller
    {
        private $postModel;

        public function __construct() {
        
        }

        public function index()
        {
            $init = new Pages();
        
            $data = [
                "title" => "Welcome",
            ];

            $init->view("pages/index", $data);
        }

        public function about()
        {
            $init = new Pages();
            $data = [
                "title" => "About Us"
            ];

            $init->view("pages/about", $data);
        }
    }
    
?>