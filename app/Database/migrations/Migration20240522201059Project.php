<?php

class Migration20240522201059Project
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS projects (
      id INT AUTO_INCREMENT PRIMARY KEY,
      client_id INT,
      architect_id INT NULL,
      title VARCHAR(255) NOT NULL,
      slug VARCHAR(255) NOT NULL,
      description TEXT,
      status ENUM('pending', 'in progress', 'completed', 'cancelled') DEFAULT 'pending',
      type ENUM('residential', 'commercial', 'industrial', 'institutional', 'landscape', 'interior', 'urban', 'rural', 'others') NOT NULL,
      budget DECIMAL(10, 2),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      deleted_at TIMESTAMP NULL,
      completed_at TIMESTAMP NULL,
      cancelled_at TIMESTAMP NULL,
      FOREIGN KEY (client_id) REFERENCES clients(id),
      FOREIGN KEY (architect_id) REFERENCES architects(id)
    )";
  }

  public function down(): string
  {
    return "DROP TABLE projects";
  }
}
