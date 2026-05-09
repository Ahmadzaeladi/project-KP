-- Database Schema for PT Pra Kerja Nusantara CMS
-- Version: 1.0

CREATE DATABASE IF NOT EXISTS pkn_db;
USE pkn_db;

-- Table for Hero Section
CREATE TABLE hero_content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    headline VARCHAR(255) NOT NULL,
    sub_headline TEXT,
    primary_cta_text VARCHAR(50),
    secondary_cta_text VARCHAR(50),
    background_image VARCHAR(255),
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table for Gallery (Arsip Visual)
CREATE TABLE gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    image_path VARCHAR(255) NOT NULL,
    display_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table for Team Collective
CREATE TABLE team (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo_path VARCHAR(255),
    bio TEXT,
    display_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table for Admin Users (Security)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Will store Hashed Password
    full_name VARCHAR(255),
    last_login DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Initial Data for Testing
INSERT INTO users (username, password, full_name) VALUES 
('admin', '$2y$10$YourHashedPasswordHere', 'Super Admin'); -- Use password_hash() in PHP
