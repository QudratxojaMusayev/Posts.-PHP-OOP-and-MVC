<?php
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $this->getURL();
        }

        public function getURL()
        {
            echo $_GET["url"];
        }
    }
?>