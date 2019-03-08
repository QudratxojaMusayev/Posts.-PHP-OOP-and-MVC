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

        public function add()
        {
            $init = new Posts();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Sanitize the data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    "title" => trim($_POST["title"]),
                    "body" => trim($_POST["body"]),
                    "user_id" => $_SESSION["user_id"],
                    "title_err" => "",
                    "body_err" => ""
                ];

                // Validate title
                if (empty($data["title"])) {
                    $data["title_err"] = "Please enter the title";
                }

                // Validate the body
                if (empty($data["body"])) {
                    $data["body_err"] = "Body can't be empty";
                }

                // If no errors
                if (empty($data["title_err"]) && empty($data["body_err"])) {
                    // Validated
                    if ($init->postModel->addPost($data)) {
                        flash("post_message", "Post added successfully");
                        redirect("/posts");
                    } else {
                        die("Something went wrong");
                    }
                    
                } else {
                    // Load view with the errors
                    $init->view("posts/add", $data);
                }
            } else {         
                $data = [
                    "title" => "",
                    "body" => ""
                ];

                $init->view("posts/add", $data);
            }
        }
    }
    
?>