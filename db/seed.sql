-- admin = admin / admin123  (change later)
INSERT OR IGNORE INTO users (username, password_hash)
VALUES ('admin', '$2y$10$V2k6Z3mGBzvF0c5u8h3N1eQ1v0M0dQe0vE0kR0Qp3y5jvHkwhI1x6');

DELETE FROM products;

-- Agriculture
INSERT INTO products (name, description, category, price, image_url) VALUES
('Mahangu (Pearl Millet)', 'Locally grown staple grain for porridge and traditional breads.', 'Agriculture', 45.00, 'assets/images/mahangu.jpg'),
('Bokomo Cornflakes 500g', 'Crispy cornflakes — breakfast favourite.', 'Agriculture', 70.00, 'assets/images/bokomo-cornflakes.jpg'),

-- Jewelry
('Himba Necklace', 'Handcrafted beads & leather inspired by Himba tradition.', 'Jewelry', 220.00, 'assets/images/himba-necklace.jpg'),

-- Crafts
('Woven Basket (Medium)', 'Palm/grass basket woven by Kavango artisans.', 'Crafts', 180.00, 'assets/images/baskets.jpg'),
('Handcrafted Mat', 'Traditional handwoven mat from natural reeds.', 'Crafts', 250.00, 'assets/images/mat.jpg'),
('Wooden Sculpture', 'Hand-carved sculpture of Namibian wildlife.', 'Crafts', 400.00, 'assets/images/sculpture.jpg'),

-- Skincare
('Facial mask', 'Marula & omarula facial balm — hydrating & gentle.', 'Skincare', 120.00, 'assets/images/facial-balm.jpg'),

-- Fashion
('Leather Shoulder Bag', 'Locally produced leather bag with adjustable strap.', 'Fashion', 780.00, 'assets/images/leather-bag.jpg'),

-- Meat & Snacks
('Beef Biltong 200g', 'Air-dried beef biltong packed with flavour.', 'Meat & Snacks', 80.00, 'assets/images/biltong.jpg');
