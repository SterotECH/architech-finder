<?php

class Migration20240310122800Users
{
  public function up(): string
  {
    return "CREATE TABLE IF NOT EXISTS users (
      id INT PRIMARY KEY AUTO_INCREMENT,
      role ENUM('Client', 'Architect', 'Administrator') NOT NULL,
      email VARCHAR(100) UNIQUE NOT NULL,
      password VARCHAR(255) NOT NULL,
      first_name VARCHAR(100) NOT NULL,
      last_name VARCHAR(100) NOT NULL,
      phone_number VARCHAR(20),
      gender ENUM('Male', 'Female', 'Other') NOT NULL,
      avatar VARCHAR(255) NULL,
      location VARCHAR(255) NULL,
      is_active BOOLEAN NOT NULL DEFAULT TRUE,
      is_superuser BOOLEAN NOT NULL DEFAULT FALSE,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      CHECK (role IN ('Client', 'Architect', 'Administrator')),
      CHECK (gender IN ('male', 'female', 'other')),
      CHECK (is_active IN (0, 1)),
      CHECK (is_superuser IN (0, 1)),
      CONSTRAINT users_phone_number_unique UNIQUE INDEX (phone_number),
      CONSTRAINT users_email_unique UNIQUE INDEX (email)
    )";
  }

  public function down(): string
  {
    return "DROP TABLE users";
  }
}
