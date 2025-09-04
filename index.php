<?php
require 'config.php';

// Fetch latest posts
$posts = $pdo->query("SELECT id, slug, title, meta_desc, created_at 
                      FROM posts ORDER BY created_at DESC LIMIT 10")->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>JKSSB Jobs Portal</title>
  <meta name="description" content="Latest job updates, MCQs, and previous year papers for JKSSB aspirants.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/style.css">
  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_MEASUREMENT_ID; ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo GA_MEASUREMENT_ID; ?>');
  </script>
</head>
<body>
  <header>
    <h1>JKSSB Jobs Portal</h1>
    <nav>
      <a href="index.php">Home</a> |
      <a href="papers.php">Previous Year Papers</a> |
      <a href="category.php?slug=mcqs">MCQs</a>
    </nav>
  </header>

  <main>
    <h2>Latest Job Posts</h2>
    <ul>
      <?php foreach($posts as $p): ?>
        <li>
          <a href="/post/<?php echo $p['id'].'/'.urlencode($p['slug']); ?>">
            <?php echo htmlspecialchars($p['title']); ?>
          </a> 
          <small>(<?php echo date("d M Y", strtotime($p['created_at'])); ?>)</small>
        </li>
      <?php endforeach; ?>
    </ul>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> JKSSB Jobs Portal. All rights reserved.</p>
  </footer>
</body>
</html>
