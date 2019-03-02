<?php 
    /* 
    * PDO class
    * Connect to database
    * Create prepared statement
    * Bind values
    * Return rows and results 
    */

    class Database 
    {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASS;
        private $dbname = DB_NAME;

        private $dbhandler;
        private $statement;
        private $error;

        public function __construct() {
            // Set DSN
            $dsn = "mysql:host=". $this->host .";dbname=". $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try {
                $this->dbhandler = new PDO($dsn, $this->user, $this->password, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Method for preparing statements
        public function query($sql)
        {
            $this->statement = $this->dbhandler->prepare($sql);
        }

        // Bind values
        public function bind($param, $value, $type = NULL)
        {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;

                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }

            $this->statement->bindValue($param, $value, $type);
        }

        // Execute statement
        public function execute()
        {
            return $this->statement->execute();
        }

        // Get Result set as an array of objects
        public function resultSet()
        {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        // Get a single record as an object
        public function single()
        {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount()
        {
            return $this->statement->rowCount();
        }
    }
    
?>