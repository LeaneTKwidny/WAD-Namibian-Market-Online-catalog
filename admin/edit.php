<?php
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../db/db.php';
$pdo = get_db();
$id = intval($_GET['id'] ?? 0);
if(!$id){ header('Location: dashboard.php'); exit; }

$msg='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name=trim($_POST['name']??''); $description=trim($_POST['description']??'');
  $category=trim($_POST['category']??''); $price=floatval($_POST['price']??0);
  $image_url=trim($_POST['image_url']??'');
  if ($name && $description && $category && $price>=0) {
    $st=$pdo->prepare('UPDATE products SET name=?,description=?,category=?,price=?,image_url=? WHERE id=?');
    $st->execute([$name,$description,$category,$price,$image_url?:null,$id]);
    header('Location: dashboard.php'); exit;
  } else { $msg='Please fill all required fields.'; }
}
$st=$pdo->prepare('SELECT * FROM products WHERE id=?'); $st->execute([$id]); $p=$st->fetch(PDO::FETCH_ASSOC);
if(!$p){ header('Location: dashboard.php'); exit; }
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Edit Product</title><link rel="stylesheet" href="../styles.css"></head>
<body><main class="wrap" style="max-width:720px;padding:24px 0">
  <h2>Edit Product</h2>
  <?php if($msg): ?><p style="color:#a00"><?=$msg?></p><?php endif; ?>
  <form method="post" style="display:grid;gap:10px">
    <input name="name" value="<?=htmlspecialchars($p['name'])?>">
    <textarea name="description" rows="4"><?=htmlspecialchars($p['description'])?></textarea>
    <div style="display:flex;gap:10px;flex-wrap:wrap">
      <input name="category" value="<?=htmlspecialchars($p['category'])?>" style="flex:1 1 200px">
      <input name="price" type="number" step="0.01" min="0" value="<?=htmlspecialchars($p['price'])?>" style="flex:1 1 200px">
    </div>
    <input name="image_url" value="<?=htmlspecialchars($p['image_url'])?>">
    <button style="padding:10px;border:0;border-radius:10px;background:#0a7a5c;color:#fff;font-weight:700">Update</button>
  </form>
  <p><a class="badge" href="dashboard.php">← Back</a></p>
</main></body></html>
