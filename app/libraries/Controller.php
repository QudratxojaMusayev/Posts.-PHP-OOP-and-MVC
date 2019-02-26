<?php 
    /*
    * Basic controller
    * Loads models and views
    */

    class Controller
    {
        // Load model
        public function model($model)
        {
            // Require model file
            require_once "../app/models/". $model .".php";

            // Initiate model
            return new $model();
        }

        // Load view
        public function view($view, $data = [])
        {   
            if (file_exists("../app/views/". $view . "php")) {
                require_once "../app/views/". $view ."php";
            } else {
                die("View doen't exist");
            }
            
        }
    }
    
?>