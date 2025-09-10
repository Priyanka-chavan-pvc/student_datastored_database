<?php
trait DatabaseConnection {
    protected $conn;

    public function connect() {
        $this->conn = new mysqli("localhost", "root", "", "crud1");
        if ($this->conn->connect_error) {
            die("DB Connection failed: " . $this->conn->connect_error);
        }
    }
}

?>
