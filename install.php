<?php
require 'config.php';

$queries = [];

// Posts table
$queries[] = "CREATE TABLE IF NOT EXISTS posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(255) NOT NULL UNIQUE,
  title VARCHAR(255) NOT NULL,
  category VARCHAR(100) NOT NULL,
  body TEXT NOT NULL,
  featured VARCHAR(255) DEFAULT NULL,
  meta_title VARCHAR(255) DEFAULT NULL,
  meta_desc VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// MCQs table
$queries[] = "CREATE TABLE IF NOT EXISTS mcqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category VARCHAR(100) NOT NULL,
  question TEXT NOT NULL,
  optA VARCHAR(255), 
  optB VARCHAR(255), 
  optC VARCHAR(255), 
  optD VARCHAR(255),
  correct CHAR(1) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Papers table
$queries[] = "CREATE TABLE IF NOT EXISTS papers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  filename VARCHAR(255) NOT NULL,
  original_name VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  uploader VARCHAR(100) DEFAULT NULL,
  status ENUM('pending','approved','rejected') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Categories table
$queries[] = "CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL UNIQUE,
  slug VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Admin table
$queries[] = "CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// Run queries
foreach ($queries as $q) { 
    $pdo->exec($q); 
}

// Default admin user
$stmt = $pdo->query("SELECT COUNT(*) as cnt FROM admin");
$row = $stmt->fetch();
if ($row['cnt'] == 0) {
    $hash = password_hash("ChangeMe123!", PASSWORD_DEFAULT);
    $pdo->prepare("INSERT INTO admin (username,password_hash) VALUES (?,?)")
        ->execute(['admin',$hash]);
    echo "✅ Default Admin created: <br> Username: admin <br> Password: ChangeMe123! <br><br>";
}

echo "✅ Database tables created successfully!<br>⚠️ Please delete install.php after setup.";
?>
