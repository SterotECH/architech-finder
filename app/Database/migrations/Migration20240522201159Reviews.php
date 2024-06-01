<?php

class Migration20240522201159Reviews
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS reviews (
      id INT AUTO_INCREMENT PRIMARY KEY,
      client_id INT,
      project_id INT NOT NULL,
      architect_id INT,
      rating INT NOT NULL,
      review_text TEXT NOT NULL,
      submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (project_id) REFERENCES projects(id),
      FOREIGN KEY (client_id) REFERENCES clients(id),
      FOREIGN KEY (architect_id) REFERENCES architects(id)
    )";
  }

  public function down(): string
  {
      return "DROP TABLE reviews";
  }
}
