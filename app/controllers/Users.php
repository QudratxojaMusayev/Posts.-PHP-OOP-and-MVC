<?php 
    class Users extends Controller
    {
        public function __construct() {
            $this->userModel = $this->model("User");
        }

        public function register()
        {
            $init = new Users();
            // Check for POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Sanitize the data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Initial data
                $data = [
                    "name" => trim($_POST['name']),
                    "email" => trim($_POST['email']),
                    "password" => trim($_POST['password']),
                    "confirm_password" => trim($_POST['confirm_password']),
                    "name_err" => "",
                    "email_err" => "",
                    "password_err" => "",
                    "confirm_password_err" => ""
                ];

                if(empty($data['name'])) {
                    $data['name_err'] = "Please enter name";
                }

                if(empty($data['email'])) {
                    $data['email_err'] = "Please enter email";
                } else {
                    if ($init->userModel->findUserByEmail($data["email"])) {
                        $data['email_err'] = "This email already registered";
                    }
                }

                if(empty($data['password'])) {
                    $data['password_err'] = "Please enter password";
                } elseif(strlen($data['password']) < 6) {
                    $data['password_err'] = "Password must be at least 6 characters";
                }

                if(empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = "Please confirm password";
                } else {
                    if($data['password'] != $data['confirm_password']) { 
                        $data['confirm_password_err'] = "Passwords doesn't match";
                    }
                }

                // Make sure errors are empty 
                if (empty($data['name_err']) && empty($data['email_err']) 
                && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // Validated
                    die("SUCCESS");                
                } else {
                    $init->view("users/register", $data);
                }
            } else {
                // Initial data
                $data = [
                    "name" => "",
                    "email" => "",
                    "password" => "",
                    "confirm_password" => "",
                    "name_err" => "",
                    "email_err" => "",
                    "password_err" => "",
                    "confirm_password_err" => ""
                ];

                $init->view("users/register", $data);
            }
        }

        public function login()
        {
            $init = new Users();
            // Check for POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Sanitize the data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Initial data
                $data = [
                    "email" => trim($_POST['email']),
                    "password" => trim($_POST['password']),
                    "email_err" => "",
                    "password_err" => "",
                ];

                if(empty($data['email'])) {
                    $data['email_err'] = "Please enter email";
                }

                if(empty($data['password'])) {
                    $data['password_err'] = "Please enter password";
                }

                // If no errors
                if (empty($data['email_err']) && empty($data['password_err'])) {
                    // Validated
                    die("SUCCESS");                
                } else {
                    $init->view("users/login", $data);
                }
            } else {
                // Initial data
                $data = [
                    "email" => "",
                    "password" => "",
                    "email_err" => "",
                    "password_err" => "",
                ];

                $init->view("users/login", $data);
            }
        }
    }
    
?>