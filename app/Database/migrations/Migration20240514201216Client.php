<?php

class Migration20240514201216Client
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS clients (
      id INT PRIMARY KEY AUTO_INCREMENT,
      user_id INT UNIQUE,
      address VARCHAR(255) NOT NULL,
      FOREIGN KEY (user_id) REFERENCES users(id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
  }

  public function down(): string
  {
      return "DROP TABLE clients";
  }
}
