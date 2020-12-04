<?php 
  class Disburse {
    // DB stuff
    private $conn;
    private $table = 'disburse';

    // Post Properties
    public $username;
    public $password;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get Posts
    public function read_disburse() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
      $this->bank_code = $row['bank_code'];
      $this->account_number = $row['account_number'];
      $this->amount = $row['amount'];
      $this->remark = $row['remark'];
      $this->id_disburse = $row['id_disburse'];
      $this->status = $row['status'];
      $this->timestamp = $row['timestamp'];
      $this->beneficiary_name = $row['beneficiary_name'];
      $this->receipt = $row['receipt'];
      $this->time_served = $row['time_served'];
      $this->fee = $row['fee'];
    
  }

    public function update_disburse($result) {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET id_disburse = :id_disburse, status = :status, timestamp = :timestamp, beneficiary_name = :beneficiary_name, receipt =:receipt, time_served =:time_served, fee =:fee
                                WHERE bank_code = :bank_code and account_number = :account_number and amount = :amount and remark = :remark';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id_disburse = $result['id'];
          $this->status = $result['status'];
          $this->timestamp = $result['timestamp'];
          $this->beneficiary_name = $result['beneficiary_name'];
          $this->receipt = $result['receipt'];
          $this->time_served = $result['time_served'];
          $this->fee = $result['fee'];
          $this->bank_code = $result['bank_code'];
          $this->account_number = $result['account_number'];
          $this->amount = $result['amount'];
          $this->remark = $result['remark'];
          // Bind data
          $stmt->bindParam(':id_disburse', $this->id_disburse);
          $stmt->bindParam(':status', $this->status);
          $stmt->bindParam(':timestamp', $this->timestamp);
          $stmt->bindParam(':beneficiary_name', $this->beneficiary_name);
          $stmt->bindParam(':receipt', $this->receipt);
          $stmt->bindParam(':time_served', $this->time_served);
          $stmt->bindParam(':fee', $this->fee);
          $stmt->bindParam(':bank_code', $this->bank_code);
          $stmt->bindParam(':account_number', $this->account_number);
          $stmt->bindParam(':amount', $this->amount);
          $stmt->bindParam(':remark', $this->remark);      
          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

}