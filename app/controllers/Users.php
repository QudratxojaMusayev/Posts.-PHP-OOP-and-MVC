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
                    
                    // Hash password
                    $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

                    // Register user
                    if ($init->userModel->register($data)) {
                        flash("register_success", "You are registered and now you can log in");
                        redirect("/users/login");
                    } else {
                        die("Something went wrong");
                    }
                    
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

                if($init->userModel->findUserByEmail($data["email"])) {
                    // User found
                } else {
                    // User not found
                    $data["email_err"] = "No user found";
                }

                // If no errors
                if (empty($data['email_err']) && empty($data['password_err'])) {
                    // Validated
                    $loggedInUser = $init->userModel->login($data["email"], $data["password"]);
                    
                    if ($loggedInUser) {
                        // Create session
                        $init->createUserSession($loggedInUser);
                    } else {
                        $data["password_err"] = "Password incorrect";

                        $init->view("users/login", $data);
                    }
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

        public function createUserSession($user)
        {   
            $_SESSION["user_id"] = $user->id;
            $_SESSION["user_email"] = $user->email;
            $_SESSION["user_name"] = $user->name;
            redirect("/pages/index");
        }

        public function logout()
        {
            unset($_SESSION["user_id"]);
            unset($_SESSION["user_email"]);
            unset($_SESSION["user_name"]);
            session_destroy();
            redirect("/users/login");
        }

        public function isLoggedIn()
        {
            if (isset($_SESSION["user_id"])) {
                return true;
            } else {
                return false;
            }
        }
    }
    
?>