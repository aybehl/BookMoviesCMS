<?php
// Include database connection
include __DIR__ . '/../reusable/dbConnection.php';
include __DIR__ . '/../reusable/header.php';

$author_id = $_GET['id'];
$message = '';

// Fetch current author details
$sql = "SELECT * FROM authors WHERE author_id = ?";
$stmt = $connect->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($connect->error));
}
$stmt->bind_param("i", $author_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("No author found with the given ID.");
}
$author = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author_name = $_POST['author_name'];
    $author_email = $_POST['author_email'];
    $instagram_handle = $_POST['instagram_handle'];

    if (!empty($author_name) && !empty($author_email)) {
        $sql = "UPDATE authors SET author_name = ?, author_email = ?, instagram_handle = ? WHERE author_id = ?";
        $stmt = $connect->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($connect->error));
        }
        $stmt->bind_param("sssi", $author_name, $author_email, $instagram_handle, $author_id);

        if ($stmt->execute()) {
            // Redirect to author's detail page after successful update
            header("Location: authorDetails.php?id=" . urlencode($author_id));
            exit();
        } else {
            $message = "Error: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Author</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Author</h1>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="updateAuthor.php?id=<?php echo htmlspecialchars($author_id); ?>" method="post">
            <div class="mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="author_name" name="author_name" value="<?php echo htmlspecialchars($author['author_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author_email" class="form-label">Author Email</label>
                <input type="email" class="form-control" id="author_email" name="author_email" value="<?php echo htmlspecialchars($author['author_email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="instagram_handle" class="form-label">Instagram Handle (optional)</label>
                <input type="text" class="form-control" id="instagram_handle" name="instagram_handle" value="<?php echo htmlspecialchars($author['instagram_handle']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Author</button>
            <a href="viewAllAuthors.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$connect->close();
?>
