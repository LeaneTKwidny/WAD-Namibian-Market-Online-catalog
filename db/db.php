<?php
function get_db() {
  $dbPath = __DIR__ . '/catalog.sqlite';
  $isNew = !file_exists($dbPath);

  $pdo = new PDO('sqlite:' . $dbPath);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Always ensure schema exists (idempotent)
  $pdo->exec(<<<SQL
PRAGMA foreign_keys=ON;
CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE NOT NULL,
  password_hash TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS products (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  description TEXT NOT NULL,
  category TEXT NOT NULL,
  price REAL NOT NULL CHECK (price >= 0),
  image_url TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
SQL);

  // Seed once if empty
  $count = (int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
  if ($count === 0) {
    $hash = password_hash('admin123', PASSWORD_BCRYPT); // change later
    $pdo->exec("INSERT OR IGNORE INTO users (username,password_hash) VALUES ('admin','$hash')");
    $pdo->exec(<<<SQL
INSERT INTO products (name, description, category, price, image_url) VALUES
('Mahangu (Pearl Millet) 1kg','Locally grown staple grain for porridge and traditional breads.','Agriculture',45.00,'assets/images/mahangu.jpg'),
('Bokomo Cornflakes 500g','Crispy cornflakes — breakfast favourite.','Agriculture',70.00,'assets/images/bokomo-cornflakes.jpg'),
('Himba Necklace','Handcrafted beads & leather inspired by Himba tradition.','Jewelry',220.00,'assets/images/himba-necklace.jpg'),
('Woven Basket (Medium)','Palm/grass basket woven by Kavango artisans.','Crafts',180.00,'assets/images/baskets.jpg'),
('Handcrafted Mat','Traditional handwoven mat from natural reeds.','Crafts',250.00,'assets/images/mat.jpg'),
('Wooden Sculpture','Hand-carved sculpture of Namibian wildlife.','Crafts',400.00,'assets/images/sculpture.jpg'),
('Herbal Facial Balm','Marula & omarula facial balm — hydrating & gentle.','Skincare',120.00,'assets/images/facial-balm.jpg'),
('Leather Shoulder Bag','Locally produced leather bag with adjustable strap.','Fashion',780.00,'assets/images/leather-bag.jpg'),
('Beef Biltong 200g','Air-dried beef biltong packed with flavour.','Meat & Snacks',80.00,'assets/images/biltong.jpg');
SQL);
  }

  return $pdo;
}
