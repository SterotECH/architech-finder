<?php

class Migration20240515011306Architect
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS architects (
      id INT PRIMARY KEY AUTO_INCREMENT,
      user_id INT UNIQUE,
      experience TEXT NOT NULL,
      biography TEXT NOT NULL,
      qualifications TEXT NOT NULL,
      portfolio_link VARCHAR(255) NOT NULL,
      FOREIGN KEY (user_id) REFERENCES users(id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
  }

  public function down(): string
  {
      return "DROP TABLE architects";
  }
}
