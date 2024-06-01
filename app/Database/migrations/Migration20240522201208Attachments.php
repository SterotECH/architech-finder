<?php

class Migration20240522201208Attachments
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS attachments (
      id INT AUTO_INCREMENT PRIMARY KEY,
      project_id INT,
      file_name VARCHAR(255),
      file_path VARCHAR(255),
      file_type VARCHAR(255),
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (project_id) REFERENCES projects(id)
    )";
  }

  public function down(): string
  {
      return "DROP TABLE attachments";
  }
}
