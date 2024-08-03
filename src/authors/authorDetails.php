<?php
    // Include database connection
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';

    // Get author ID from URL
    $author_id = $_GET['id'];

    // Fetch author details
    $sql = "SELECT * FROM authors WHERE author_id = ?";
    $stmt = $connect->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $author_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $author = $result->fetch_assoc();

    if (!$author) {
        die("No author found with the given ID.");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($author['author_name']); ?></h1>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($author['author_email']); ?></p>
        <p><strong>Instagram Handle:</strong> <?php echo htmlspecialchars($author['instagram_handle']); ?></p>

        <div class="btn-group" role="group">
            <a href="updateAuthor.php?id=<?php echo htmlspecialchars($author['author_id']); ?>" class="btn btn-warning">Update Author</a>
            <a href="deleteAuthor.php?id=<?php echo htmlspecialchars($author['author_id']); ?>" class="btn btn-danger">Delete Author</a>
            <a href="viewAllAuthors.php" class="btn btn-primary">Back to Authors</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
