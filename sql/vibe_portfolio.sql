-- Create Database
CREATE DATABASE IF NOT EXISTS vibe_portfolio;
USE vibe_portfolio;

-- Admin Table
CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Insert default admin (username: Deva, password: 1122 — plain, hash it later)
INSERT INTO admin (username, password) VALUES ('Deva', '1122');

-- Projects Table
CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  link VARCHAR(255),
  icon VARCHAR(100),
  badge VARCHAR(100)
);

-- Optional: Sample Project Entry
INSERT INTO projects (title, description, link, icon, badge) VALUES
('AI Tools Directory', 'A categorized directory of AI tools curated for productivity and design.', 'https://Aitools-dev.netlify.app', 'fa-globe', 'Bolt.new'),
('Ping Vault', 'A secure locker app for notes and links with password protection and auto-expiry.', 'https://app--ping-vault-e9ae59b0.base44.app/', 'fa-lock', 'Base44.app');
