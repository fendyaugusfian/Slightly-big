<?php 
  class Auth {
    // DB stuff
    private $conn;
    private $table = 'auth';

    // Post Properties
    public $username;
    public $password;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT username as username, password as password FROM ' . $this->table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
      $this->username = $row['username'];
      $this->password = $row['password'];
    
  }
}