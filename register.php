<?php
require_once 'includes/auth.php';
require_once 'config/database.php';
redirectIfLoggedIn();

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($name && $email && $password && $confirm) {
        if ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters.';
        } else {
            try {
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = 'An account with this email already exists.';
                } else {
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'customer')");
                    $stmt->execute([$name, $email, $hash]);
                    $success = 'Account created successfully! You can now log in.';
                }
            } catch (Exception $e) {
                $error = 'Something went wrong. Please try again.';
            }
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
  <link rel="stylesheet" href="style.css">
  <title>Register — ShopHub</title>
  <style>
    html, body { margin: 0; padding: 0; height: 100%; }
    .auth-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      background: #f9fafb;
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
    .auth-success {
      background: #f0fdf4;
      color: #16a34a;
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
  </style>
</head>
<body>
  <div class="auth-page">
    <div class="auth-card">
      <a href="index.php" class="logo-link">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        ShopHub
      </a>
      <h1>Create Account</h1>
      <p>Join ShopHub and start shopping today.</p>

      <?php if ($error): ?>
        <div class="auth-error"><?= htmlspecialchars($error) ?></div>
      <?php elseif ($success): ?>
        <div class="auth-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" required autocomplete="name" placeholder="John Doe">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required autocomplete="email" placeholder="you@example.com">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="At least 6 characters" minlength="6">
        </div>
        <div class="form-group">
          <label for="confirm">Confirm Password</label>
          <input type="password" id="confirm" name="confirm" required autocomplete="new-password" placeholder="Repeat password">
        </div>
        <button type="submit" class="auth-btn">Create Account</button>
      </form>

      <div class="auth-footer">
        Already have an account? <a href="login.php">Sign in</a>
      </div>
    </div>
  </div>
</body>
</html>