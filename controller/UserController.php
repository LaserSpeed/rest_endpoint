<?php    
    // User model
    class UserController {
        private $conn;
        private $table = "users";

        public $id;
        public $name;
        public $email;

        // Controller 
        // constructor to connect with databse
        public function __construct($db) {
            $this->conn = $db;
        }

        // get all workflow
        public function getAllUser() {
            $sql = "
                SELECT * FROM ".$this->table."
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        // get all workflow
        public function getSingleUser() {
            $sql = "
                SELECT * FROM ".$this->table." WHERE id=:id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam("id", $this->id);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->email = $row['email'];
            }
            return $stmt;
        }
    }
?>