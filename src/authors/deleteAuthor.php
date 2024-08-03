<?php
    // Include database connection
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';

    // Get author ID from URL
    $author_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Deletion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDeletion() {
            return confirm('Are you sure you want to delete this author? This action cannot be undone.');
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Confirm Deletion</h1>
        <form action="deleteAuthor.php?id=<?php echo htmlspecialchars($author_id); ?>" method="post" onsubmit="return confirmDeletion();">
            <p>Are you sure you want to delete this author? This action cannot be undone.</p>
            <button type="submit" class="btn btn-danger">Delete Author</button>
            <a href="viewAllAuthors.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($author_id > 0) {
            // Prepare SQL to delete the author
            $sql = "DELETE FROM authors WHERE author_id = ?";
            $stmt = $connect->prepare($sql);
            if ($stmt === false) {
                die("Prepare failed: " . htmlspecialchars($connect->error));
            }

            $stmt->bind_param("i", $author_id);

            if ($stmt->execute()) {
                // Redirect to viewAllAuthors.php after successful deletion
                header("Location: viewAllAuthors.php");
                exit();
            } else {
                echo "Error deleting author: " . htmlspecialchars($stmt->error);
            }

            $stmt->close();
        } else {
            echo "Invalid author ID.";
        }
    }

    $connect->close();
?>
