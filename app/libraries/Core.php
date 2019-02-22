<?php
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getURL();

            if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
                // If exists set as current controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once "../app/controllers/". $this->currentController .".php";

            // Instantiate controller class
            $this->curretController = new $this->currentController; // $pages = new Pages;
        }

        public function getURL()
        {
            if (isset($_GET["url"])) {
                $url = rtrim($_GET["url"], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode("/", $url);
                return $url;
            }
        }
    }
?>