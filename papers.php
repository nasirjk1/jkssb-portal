<?php
require 'config.php';

// Fetch approved papers
$stmt = $pdo->prepare("SELECT * FROM papers WHERE status = 'approved' ORDER BY created_at DESC");
$stmt->execute();
$papers = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Previous Year Papers - JKSSB Jobs Portal</title>
  <meta name="description" content="Download JKSSB previous year question papers for free.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
  <header>
    <h1><a href="<?php echo SITE_URL; ?>">JKSSB Jobs Portal</a></h1>
  </header>

  <main>
    <h2>Previous Year Papers</h2>
    <?php if ($papers): ?>
      <ul>
        <?php foreach ($papers as $p): ?>
          <li>
            <strong><?php echo htmlspecialchars($p['title']); ?></strong><br>
            <em><?php echo htmlspecialchars($p['description']); ?></em><br>
            <a href="/uploads/papers/<?php echo $p['filename']; ?>" target="_blank">📥 Download</a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>No papers uploaded yet.</p>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> JKSSB Jobs Portal</p>
  </footer>
</body>
</html>
