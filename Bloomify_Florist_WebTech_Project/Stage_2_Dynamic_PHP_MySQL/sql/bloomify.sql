CREATE DATABASE IF NOT EXISTS bloomify;
USE bloomify;

CREATE TABLE IF NOT EXISTS flowers (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(150) NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 category VARCHAR(50) NOT NULL,
 emoji VARCHAR(20) NOT NULL,
 description VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
 id INT AUTO_INCREMENT PRIMARY KEY,
 customer_name VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL,
 product_name VARCHAR(150) NOT NULL,
 quantity INT NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS messages (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL,
 message TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO flowers(name,price,category,emoji,description) VALUES
('Blush Garden Bouquet',1499,'romantic','💐','Soft pink roses, lilies & seasonal blooms.'),
('Sunshine Celebration',1199,'birthday','🌻','Bright sunflowers for a cheerful surprise.'),
('Forever Roses',1799,'romantic','🌹','Classic red roses wrapped with baby''s breath.'),
('Pastel Dream',1399,'gift','🌷','Delicate pastel tulips in a premium wrap.'),
('Lavender Love',1299,'gift','💜','Lavender tones with fragrant seasonal flowers.'),
('Birthday Bloom Box',1599,'birthday','🎁','A flower box made for unforgettable smiles.'),
('White Elegance',1699,'gift','🌼','Elegant white blooms with eucalyptus.'),
('Red Romance',1999,'romantic','🌹','A luxurious dozen-rose arrangement.');