<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("Post not found!");
}
$id = (int) $_GET['id'];

// Fetch post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found!");
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($post['meta_title'] ?: $post['title']); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($post['meta_desc'] ?: substr(strip_tags($post['body']),0,150)); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if($post['featured']): ?>
    <meta property="og:image" content="<?php echo SITE_URL.'/uploads/posts/'.$post['featured']; ?>">
  <?php endif; ?>
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
  <header>
    <h1><a href="<?php echo SITE_URL; ?>">JKSSB Jobs Portal</a></h1>
  </header>

  <main>
    <article>
      <h2><?php echo htmlspecialchars($post['title']); ?></h2>
      <?php if($post['featured']): ?>
        <img src="/uploads/posts/<?php echo $post['featured']; ?>" alt="Featured image" style="max-width:300px;">
      <?php endif; ?>
      <p><em>Posted on <?php echo date("d M Y", strtotime($post['created_at'])); ?></em></p>
      <div><?php echo nl2br($post['body']); ?></div>
    </article>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> JKSSB Jobs Portal</p>
  </footer>
</body>
</html>
