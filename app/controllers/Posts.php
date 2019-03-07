<?php 
    class Posts extends Controller
    {
        public function __construct() {
            if (!isLoggedIn()) {
                redirect("/users/login");
            }

            $this->postModel = $this->model("Post");

        }

        public function index()
        {
            $init = new Posts();
            
            // Get posts
            $posts = $init->postModel->getPosts();

            $data = [
                "posts" => $posts
            ];
            
            $init->view("posts/index", $data);
        }
    }
    
?>