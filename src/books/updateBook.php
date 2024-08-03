<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection and header
include __DIR__ . '/../reusable/dbConnection.php';
include __DIR__ . '/../reusable/header.php';
include __DIR__ . '/../reusable/utilities.php';

// Check if the ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid book ID.');
}

// Get book ID from URL
$book_id = (int) $_GET['id'];

// Fetch authors and movies for dropdowns
$authorsResult = $connect->query("SELECT author_id, author_name FROM authors");
$moviesResult = $connect->query("SELECT movie_id, movie_name FROM movies");

// Fetch book details
$sql = "SELECT * FROM books WHERE book_id = ?";
$stmt = $connect->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . $connect->error);
}
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die('No book found with the given ID.');
}
$book = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $author_id = $_POST['author_id'];
    $description = $_POST['description'];
    $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : NULL;

    $stmt = $connect->prepare("UPDATE books SET name = ?, author_id = ?, description = ?, movie_id = ? WHERE book_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $connect->error);
    }
    $stmt->bind_param("sisii", $name, $author_id, $description, $movie_id, $book_id);

    if ($stmt->execute()) {
        // Set a session message and redirect to the book details page
        $_SESSION['message'] = 'Book was updated successfully';
        $_SESSION['message_type'] = 'success';
        header("Location: bookDetails.php?id=" . $book_id);
        exit();
    } else {
        $_SESSION['message'] = 'Error occurred when trying to Update the Book: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
        header("Location: bookDetails.php?id=" . $book_id);
        exit();
    }

    $stmt->close();
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <title>Update Book</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Update Book</h1>
        <form action="updateBook.php?id=<?php echo $book_id; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($book['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Author</label>
                <select class="form-select" id="author_id" name="author_id" required>
                    <option value="" disabled>Select Author</option>
                    <?php while ($author = $authorsResult->fetch_assoc()): ?>
                        <option value="<?php echo $author['author_id']; ?>" <?php echo $book['author_id'] == $author['author_id'] ? 'selected' : ''; ?>>
                            <?php echo $author['author_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($book['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="movie_id" class="form-label">Related Movie</label>
                <select class="form-select" id="movie_id" name="movie_id">
                    <option value="" disabled>Select Movie (Optional)</option>
                    <?php while ($movie = $moviesResult->fetch_assoc()): ?>
                        <option value="<?php echo $movie['movie_id']; ?>" <?php echo $book['movie_id'] == $movie['movie_id'] ? 'selected' : ''; ?>>
                            <?php echo $movie['movie_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
