<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
requireAdmin();
$user = currentUser();

$stats = ['users' => 0, 'categories' => 0, 'products' => 0];
try {
    $pdo = Database::getConnection();
    $stats['users'] = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $stats['categories'] = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    $stats['products'] = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
} catch (Exception $e) {}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <title>Admin Dashboard — ShopHub</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; padding-top: 0 !important; }
    .admin-layout { display: flex; min-height: 100vh; }
    .admin-sidebar {
      width: 240px;
      background: #fff;
      border-right: 1px solid #e5e7eb;
      padding: 20px 12px;
      display: flex;
      flex-direction: column;
    }
    .admin-sidebar .logo-link {
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      color: #4f46e5;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 18px;
      padding: 8px 4px;
      margin-bottom: 24px;
    }
    .admin-sidebar .logo-link svg { width: 24px; height: 24px; }
    .admin-nav { display: flex; flex-direction: column; gap: 2px; flex: 1; }
    .admin-nav a {
      padding: 10px 14px;
      border-radius: 8px;
      text-decoration: none;
      color: #6b7280;
      font-size: 14px;
      font-weight: 500;
      transition: all .15s;
    }
    .admin-nav a:hover { background: #f3f4f6; color: #111827; }
    .admin-nav a.active { background: #eef2ff; color: #4f46e5; font-weight: 600; }
    .admin-nav a.logout { margin-top: auto; color: #ef4444; }
    .admin-nav a.logout:hover { background: #fef2f2; }
    .admin-main { flex: 1; padding: 24px 32px; }
    .admin-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
    }
    .admin-header h1 {
      font-family: 'Poppins', sans-serif;
      font-size: 24px;
      color: #111827;
    }
    .admin-header .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .admin-header .user-info span {
      color: #6b7280;
      font-size: 14px;
    }
    .admin-header .user-info .avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: #4f46e5;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 14px;
    }
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 32px;
    }
    .stat-card {
      background: #fff;
      border-radius: 12px;
      padding: 24px;
      border: 1px solid #e5e7eb;
    }
    .stat-card .stat-label {
      font-size: 13px;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: .5px;
      margin-bottom: 8px;
    }
    .stat-card .stat-value {
      font-family: 'Poppins', sans-serif;
      font-size: 32px;
      font-weight: 600;
      color: #111827;
    }
    .admin-empty {
      text-align: center;
      padding: 60px 20px;
      color: #9ca3af;
    }
    .admin-empty h2 {
      font-family: 'Poppins', sans-serif;
      font-size: 20px;
      color: #6b7280;
      margin-bottom: 8px;
    }
  </style>
</head>
<body>
  <div class="admin-layout">
    <aside class="admin-sidebar">
      <a href="../index.php" class="logo-link">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        ShopHub
      </a>
      <nav class="admin-nav">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="#">Categories</a>
        <a href="#">Products</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-header">
        <h1>Dashboard</h1>
        <div class="user-info">
          <span><?= htmlspecialchars($user['name']) ?></span>
          <div class="avatar"><?= strtoupper(substr($user['name'], 0, 1)) ?></div>
        </div>
      </div>

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-label">Total Users</div>
          <div class="stat-value"><?= $stats['users'] ?></div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Categories</div>
          <div class="stat-value"><?= $stats['categories'] ?></div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Products</div>
          <div class="stat-value"><?= $stats['products'] ?></div>
        </div>
      </div>

      <div class="admin-empty">
        <h2>Welcome to the Admin Panel</h2>
        <p>Manage your store from here. More features coming soon.</p>
      </div>
    </main>
  </div>
</body>
</html>