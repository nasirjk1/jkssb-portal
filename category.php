<?php
require 'config.php';

if (!isset($_GET['slug'])) {
    die("Category not found!");
}
$slug = $_GET['slug'];

// Fetch category
$stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
$stmt->execute([$slug]);
$category = $stmt->fetch();

if (!$category) {
    die("Category not found!");
}

// Fetch posts in category
$stmt = $pdo->prepare("SELECT id, slug, title, created_at FROM posts WHERE category = ? ORDER BY created_at DESC");
$stmt->execute([$category['name']]);
$posts = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($category['name']); ?> - JKSSB Jobs Portal</title>
  <meta name="description" content="Latest posts in <?php echo htmlspecialchars($category['name']); ?> category.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
  <header>
    <h1><a href="<?php echo SITE_URL; ?>">JKSSB Jobs Portal</a></h1>
  </header>

  <main>
    <h2>Category: <?php echo htmlspecialchars($category['name']); ?></h2>
    <?php if ($posts): ?>
      <ul>
        <?php foreach ($posts as $p): ?>
          <li>
            <a href="/post/<?php echo $p['id'].'/'.urlencode($p['slug']); ?>">
              <?php echo htmlspecialchars($p['title']); ?>
            </a>
            <small>(<?php echo date("d M Y", strtotime($p['created_at'])); ?>)</small>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>No posts found in this category.</p>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> JKSSB Jobs Portal</p>
  </footer>
</body>
</html>
