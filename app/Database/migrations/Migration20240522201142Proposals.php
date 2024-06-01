<?php

class Migration20240522201142Proposals
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS proposals (
      id INT AUTO_INCREMENT PRIMARY KEY,
      project_id INT,
      architect_id INT,
      approach TEXT NOT NULL,
      timeline VARCHAR(255),
      fees DECIMAL(10, 2),
      status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
      submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (project_id) REFERENCES projects(id),
      FOREIGN KEY (architect_id) REFERENCES architects(id)
    )";
  }

  public function down(): string
  {
      return "DROP TABLE proposals";
  }
}
