<?php
    // Include database connection
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';

    // Initialize variables
    $name = '';
    $author_id = '';
    $description = '';
    $movie_id = '';
    $message = '';

    // Fetch authors and movies for dropdowns
    $authorsResult = $connect->query("SELECT author_id, author_name FROM authors");
    $moviesResult = $connect->query("SELECT movie_id, movie_name FROM movies");

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $author_id = $_POST['author_id'];
        $description = $_POST['description'];
        $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : NULL;

        // Validate input
        if (!empty($name) && !empty($author_id) && !empty($description)) {
            $sql = "INSERT INTO books (name, author_id, description, movie_id) VALUES (?, ?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sisi", $name, $author_id, $description, $movie_id);

            if ($stmt->execute()) {
                $message = "Book added successfully!";
                // Redirect to the books list after successful insertion
                header("Location: viewAllBooks.php");
                exit();
            } else {
                $message = "Error: " . $stmt->error;
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
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Book</h1>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="addBook.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Author</label>
                <select class="form-select" id="author_id" name="author_id" required>
                    <option value="" disabled selected>Select Author</option>
                    <?php while ($author = $authorsResult->fetch_assoc()): ?>
                        <option value="<?php echo $author['author_id']; ?>" <?php echo ($author_id == $author['author_id']) ? 'selected' : ''; ?>><?php echo $author['author_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="movie_id" class="form-label">Related Movie (optional)</label>
                <select class="form-select" id="movie_id" name="movie_id">
                    <option value="" disabled selected>Select Movie</option>
                    <?php while ($movie = $moviesResult->fetch_assoc()): ?>
                        <option value="<?php echo $movie['movie_id']; ?>" <?php echo ($movie_id == $movie['movie_id']) ? 'selected' : ''; ?>><?php echo $movie['movie_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
            <a href="viewAllBooks.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    $connect->close();
?>
