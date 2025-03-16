<?php
include "config.php";
class DbConnection{
    private static $instance;
    private $connection;
    private function __construct(){
        try{
            $data_source="mysql:host=".host.";dbname=" . database_name . ";charset=utf8mb4";
            $this->connection=new PDO($data_source,username,password);
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        } 
    }

   
    public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new DbConnection(); 
            }
            return self::$instance;
        }
    
        public function getConnection(){
            return $this->connection;
        }
    

}

?>