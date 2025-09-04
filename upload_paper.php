<?php
require 'config.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $uploader = trim($_POST['uploader']);

    if (!empty($_FILES['paper']['name'])) {
        $fileName = time() . "_" . basename($_FILES['paper']['name']);
        $target = __DIR__ . "/uploads/papers/" . $fileName;

        if (move_uploaded_file($_FILES['paper']['tmp_name'], $target)) {
            $stmt = $pdo->prepare("INSERT INTO papers (filename, original_name, title, description, uploader, status) VALUES (?,?,?,?,?, 'pending')");
            $stmt->execute([$fileName, $_FILES['paper']['name'], $title, $desc, $uploader]);
            $message = "✅ Paper uploaded successfully! Waiting for admin approval.";
        } else {
            $message = "❌ Error uploading file.";
        }
    } else {
        $message = "⚠️ Please select a file to upload.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Upload Paper - JKSSB Jobs Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
  <header>
    <h1><a href="<?php echo SITE_URL; ?>">JKSSB Jobs Portal</a></h1>
  </header>

  <main>
    <h2>Upload Previous Year Paper</h2>
    <?php if($message): ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <label>Title:</label><br>
      <input type="text" name="title" required><br><br>

      <label>Description:</label><br>
      <textarea name="description" rows="3"></textarea><br><br>

      <label>Your Name (optional):</label><br>
      <input type="text" name="uploader"><br><br>

      <label>Select Paper (PDF/Image):</label><br>
      <input type="file" name="paper" accept=".pdf,.jpg,.png,.jpeg" required><br><br>

      <button type="submit">Upload</button>
    </form>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> JKSSB Jobs Portal</p>
  </footer>
</body>
</html>
