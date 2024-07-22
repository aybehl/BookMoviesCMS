<?php
    // Include database connection and header
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';
    include __DIR__ . '/../reusable/utilities.php';

    // Fetch authors and movies for dropdowns
    $authorsResult = $connect->query("SELECT author_id, author_name FROM authors");
    $moviesResult = $connect->query("SELECT movie_id, movie_name FROM movies");

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $author_id = $_POST['author_id'];
        $description = $_POST['description'];
        $movie_id = isset($_POST['movie_id']) ? $_POST['movie_id'] : NULL;

        $stmt = $connect->prepare("INSERT INTO books (name, author_id, description, movie_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $name, $author_id, $description, $movie_id);

        if ($stmt->execute()) {
            setMessageAndRedirect('Book was added successfully', 'success', BASE_URL . 'src/books/viewAllBooks.php');
            //echo "<div class='alert alert-success' role='alert'>Book added successfully!</div>";
        } else {
            setMessageAndRedirect('Error occurred when trying to Add a Book' . $stmt->error, 'danger', BASE_URL . 'src/books/viewAllBooks.php');
            //echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
        }

        // $location = BASE_URL . 'src/books/viewAllBooks.php';
        // header("Location: " . $location);

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <title>Add Book</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Book</h1>
        <form action="addBook.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Author</label>
                <select class="form-select" id="author_id" name="author_id" required>
                    <option value="" disabled selected>Select Author</option>
                    <?php while ($author = $authorsResult->fetch_assoc()): ?>
                        <option value="<?php echo $author['author_id']; ?>"><?php echo $author['author_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="movie_id" class="form-label">Related Movie</label>
                <select class="form-select" id="movie_id" name="movie_id">
                    <option value="" disabled selected>Select Movie (Optional)</option>
                    <?php while ($movie = $moviesResult->fetch_assoc()): ?>
                        <option value="<?php echo $movie['movie_id']; ?>"><?php echo $movie['movie_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
    $connect->close();
?>
