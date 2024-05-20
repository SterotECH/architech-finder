<?php

class Migration20240518100003Password_resets
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS password_resets (
      id INT AUTO_INCREMENT PRIMARY KEY,
      token VARCHAR(16) NOT NULL,
      user_id INT NOT NULL,
      CONSTRAINT FOREIGN KEY (user_id) REFERENCES  users(id),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
  }

  public function down(): string
  {
      return "DROP TABLE password_resets";
  }
}
