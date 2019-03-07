<?php

    class Pages extends Controller
    {
        private $postModel;

        public function __construct() {
        
        }

        public function index()
        {
            if (isLoggedIn()) {
                redirect("/posts");
            }

            $init = new Pages();
        
            $data = [
                "title" => "Welcome",
                "description" => "Simple social network to share your posts"
            ];

            $init->view("pages/index", $data);
        }

        public function about()
        {
            $init = new Pages();
            $data = [
                "title" => "About Us",
                "description" => "App to share posts with other people"
            ];

            $init->view("pages/about", $data);
        }
    }
    
?>