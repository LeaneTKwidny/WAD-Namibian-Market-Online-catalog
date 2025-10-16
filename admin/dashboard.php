<?php
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../db/db.php';
$pdo = get_db();
$rows = $pdo->query('SELECT * FROM products ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dashboard · Nam Catalog</title><link rel="stylesheet" href="../styles.css"></head>
<body><main class="wrap" style="padding:24px 0">
  <h2>Products</h2>
  <p><a class="badge" href="add.php">+ Add product</a> · <a class="badge" href="logout.php">Logout</a></p>
  <table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($rows as $r): ?>
      <tr>
        <td><?= (int)$r['id'] ?></td>
        <td><?= htmlspecialchars($r['name']) ?></td>
        <td><?= htmlspecialchars($r['category']) ?></td>
        <td>N$ <?= number_format($r['price'],2) ?></td>
        <td>
          <a href="edit.php?id=<?= (int)$r['id'] ?>">Edit</a> ·
          <a href="delete.php?id=<?= (int)$r['id'] ?>" onclick="return confirm('Delete this item?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main></body></html>
