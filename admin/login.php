<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
redirectIfLoggedIn();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? AND role = 'admin'");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id']    = $user['id'];
                $_SESSION['user_name']  = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role']       = $user['role'];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid admin credentials.';
            }
        } catch (Exception $e) {
            $error = 'Something went wrong. Please try again.';
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <title>Admin Login — ShopHub</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #f1f5f9; padding-top: 0 !important; }
    .auth-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .auth-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0,0,0,.08);
      padding: 40px;
      width: 100%;
      max-width: 400px;
    }
    .auth-card h1 {
      font-family: 'Poppins', sans-serif;
      font-size: 24px;
      margin-bottom: 4px;
      color: #111827;
    }
    .auth-card p {
      color: #6b7280;
      font-size: 14px;
      margin-bottom: 24px;
    }
    .auth-card .logo-link {
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      color: #4f46e5;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 20px;
      margin-bottom: 24px;
    }
    .auth-card .logo-link svg { width: 28px; height: 28px; }
    .form-group { margin-bottom: 16px; }
    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #374151;
      margin-bottom: 6px;
    }
    .form-group input {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      box-sizing: border-box;
      outline: none;
      transition: border-color .2s;
    }
    .form-group input:focus {
      border-color: #4f46e5;
      box-shadow: 0 0 0 3px rgba(79,70,229,.1);
    }
    .auth-btn {
      width: 100%;
      padding: 12px;
      background: #4f46e5;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background .2s;
    }
    .auth-btn:hover { background: #4338ca; }
    .auth-error {
      background: #fef2f2;
      color: #dc2626;
      padding: 10px 14px;
      border-radius: 8px;
      font-size: 14px;
      margin-bottom: 16px;
    }
    .auth-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #6b7280;
    }
    .auth-footer a {
      color: #4f46e5;
      text-decoration: none;
      font-weight: 500;
    }
    .auth-footer a:hover { text-decoration: underline; }
    .admin-badge {
      display: inline-block;
      background: #eef2ff;
      color: #4f46e5;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 4px 10px;
      border-radius: 20px;
      margin-bottom: 16px;
    }
  </style>
</head>
<body>
  <div class="auth-page">
    <div class="auth-card">
      <a href="../index.php" class="logo-link">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        ShopHub
      </a>
      <div class="admin-badge">Admin Panel</div>
      <h1>Admin Login</h1>
      <p>Sign in with your admin credentials.</p>

      <?php if ($error): ?>
        <div class="auth-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required autocomplete="email" placeholder="admin@shophub.com">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="••••••••">
        </div>
        <button type="submit" class="auth-btn">Sign In</button>
      </form>

      <div class="auth-footer">
        <a href="../login.php">Customer Login →</a>
      </div>
    </div>
  </div>
</body>
</html>