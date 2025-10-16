<?php
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../db/db.php';
$pdo = get_db(); $msg='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name=trim($_POST['name']??''); $description=trim($_POST['description']??'');
  $category=trim($_POST['category']??''); $price=floatval($_POST['price']??0);
  $image_url=trim($_POST['image_url']??'');
  if ($name && $description && $category && $price>=0) {
    $st=$pdo->prepare('INSERT INTO products (name,description,category,price,image_url) VALUES (?,?,?,?,?)');
    $st->execute([$name,$description,$category,$price,$image_url?:null]);
    header('Location: dashboard.php'); exit;
  } else { $msg='Please fill all required fields.'; }
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add Product</title><link rel="stylesheet" href="../styles.css"></head>
<body><main class="wrap" style="max-width:720px;padding:24px 0">
  <h2>Add Product</h2>
  <?php if($msg): ?><p style="color:#a00"><?=$msg?></p><?php endif; ?>
  <form method="post" style="display:grid;gap:10px">
    <input name="name" placeholder="Name *">
    <textarea name="description" rows="4" placeholder="Description *"></textarea>
    <div style="display:flex;gap:10px;flex-wrap:wrap">
      <input name="category" placeholder="Category *" style="flex:1 1 200px">
      <input name="price" type="number" step="0.01" min="0" placeholder="Price (N$) *" style="flex:1 1 200px">
    </div>
    <input name="image_url" placeholder="Image URL (e.g., assets/images/biltong.jpg)">
    <button style="padding:10px;border:0;border-radius:10px;background:#0a7a5c;color:#fff;font-weight:700">Save</button>
  </form>
  <p><a class="badge" href="dashboard.php">← Back</a></p>
</main></body></html>
