<?php
require 'config.php';
header("Content-Type: application/xml; charset=utf-8");

$urls = [];

// Home
$urls[] = SITE_URL . "/";

// Posts
$posts = $pdo->query("SELECT id, slug, created_at FROM posts")->fetchAll();
foreach ($posts as $p) {
    $urls[] = SITE_URL . "/post/" . $p['id'] . "/" . urlencode($p['slug']);
}

// Categories
$cats = $pdo->query("SELECT slug FROM categories")->fetchAll();
foreach ($cats as $c) {
    $urls[] = SITE_URL . "/category/" . urlencode($c['slug']);
}

// Papers
$papers = $pdo->query("SELECT id, title FROM papers WHERE status='approved'")->fetchAll();
foreach ($papers as $p) {
    $urls[] = SITE_URL . "/papers/" . $p['id'] . "/" . urlencode(strtolower(str_replace(' ', '-', $p['title'])));
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $u): ?>
  <url>
    <loc><?php echo htmlspecialchars($u); ?></loc>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>
</urlset>
