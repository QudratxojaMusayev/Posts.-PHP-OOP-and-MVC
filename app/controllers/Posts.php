<?php 
    class Posts extends Controller
    {
        public function index()
        {
            $init = new Posts();
            
            $data = [];
            $init->view("posts/index", $data);
        }
    }
    
?>