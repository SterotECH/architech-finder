CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role ENUM('Client', 'Architect') NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    location VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE architects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE,
    experience TEXT NOT NULL,
    expertise VARCHAR(255) NOT NULL,
    qualifications TEXT NOT NULL,
    portfolio_link VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE clients (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE,
    address VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    title VARCHAR(255) NOT NULL,
    type ENUM('residential', 'commercial', 'industrial', 'institutional', 'landscape', 'interior', 'urban', 'rural', 'others') NOT NULL,
    size VARCHAR(255),
    budget DECIMAL(10, 2),
    timeline VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE proposals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    architect_id INT,
    approach TEXT NOT NULL,
    timeline VARCHAR(255),
    fees DECIMAL(10, 2),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id),
    FOREIGN KEY (architect_id) REFERENCES architects(id)
);

CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT,
    receiver_id INT,
    project_id INT DEFAULT NULL,
    message TEXT,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);

CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    project_id INT NOT NULL,
    architect_id INT,
    rating INT,
    rating INT NOT NULL,
    review_text TEXT NOT NULL,
    submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id),
    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (architect_id) REFERENCES architects(id)
);

CREATE TABLE attachments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT,
    file_name VARCHAR(255),
    file_path VARCHAR(255),
    file_type VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id)
);
