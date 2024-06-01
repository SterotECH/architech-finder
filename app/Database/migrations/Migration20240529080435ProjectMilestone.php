<?php

class Migration20240529080435ProjectMilestone
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS project_milestones (
      id INT AUTO_INCREMENT PRIMARY KEY,
      project_id INT,
      description VARCHAR(255) NOT NULL,
      status ENUM('pending', 'completed') DEFAULT 'pending',
      completed_at TIMESTAMP NULL,
      FOREIGN KEY (project_id) REFERENCES projects(id)
  );";
  }

  public function down(): string
  {
      return "DROP TABLE ProjectMilestone";
  }
}
