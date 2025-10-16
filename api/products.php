<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db/db.php';   // <-- this must be here

try {
  $pdo = get_db();                         // uses function from db.php
  $rows = $pdo->query('SELECT id,name,description,category,price,image_url FROM products ORDER BY created_at DESC')
              ->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode(['products' => $rows], JSON_PRETTY_PRINT);
} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}