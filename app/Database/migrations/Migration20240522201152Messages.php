<?php

class Migration20240522201152Messages
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS messages (
      id INT AUTO_INCREMENT PRIMARY KEY,
      sender_id INT,
      receiver_id INT,
      project_id INT DEFAULT NULL,
      message TEXT,
      sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (sender_id) REFERENCES users(id),
      FOREIGN KEY (receiver_id) REFERENCES users(id),
      FOREIGN KEY (project_id) REFERENCES projects(id)
    )";
  }

  public function down(): string
  {
      return "DROP TABLE messages";
  }
}
