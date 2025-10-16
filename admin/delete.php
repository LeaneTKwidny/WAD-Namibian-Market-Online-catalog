<?php
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../db/db.php';
$pdo = get_db();
$id = intval($_GET['id'] ?? 0);
if ($id) { $st = $pdo->prepare('DELETE FROM products WHERE id=?'); $st->execute([$id]); }
header('Location: dashboard.php');
