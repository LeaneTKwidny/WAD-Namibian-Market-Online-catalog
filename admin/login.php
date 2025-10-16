<?php
session_start();
require_once __DIR__ . '/../db/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username'] ?? '');
  $p = trim($_POST['password'] ?? '');
  if ($u && $p) {
    $pdo = get_db();
    $st = $pdo->prepare('SELECT * FROM users WHERE username=?');
    $st->execute([$u]);
    $user = $st->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($p, $user['password_hash'])) {
      $_SESSION['uid'] = $user['id'];
      $_SESSION['user'] = $user['username'];
      header('Location: dashboard.php'); exit;
    }
  }
  $error = 'Invalid credentials';
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login</title><link rel="stylesheet" href="../styles.css"></head>
<body><main class="wrap" style="max-width:480px;padding:36px 0">
<h2>Admin Login</h2>
<?php if($error): ?><p style="color:#a00"><?=$error?></p><?php endif; ?>
<form method="post" style="display:grid;gap:10px">
  <input name="username" placeholder="Username">
  <input name="password" type="password" placeholder="Password">
  <button style="padding:10px;border:0;border-radius:10px;background:#0a7a5c;color:#fff;font-weight:700">Login</button>
</form>
</main></body></html>
