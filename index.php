<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>ShopHub</title>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <main>
    <?php include 'includes/hero.php'; ?>
    <?php include 'includes/categories.php'; ?>
    <?php include 'includes/promo.php'; ?>
    <?php $limit = 8; include 'includes/products.php'; ?>
  </main>

  <script src="index.js" defer></script>
</body>
</html>