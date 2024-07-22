<?php
    // Include database connection
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';

    // Get book ID from URL
    $book_id = $_GET['id'];

    // Fetch book details
    $sql = "SELECT Books.*, Authors.author_id, Authors.author_name, Movies.movie_name, Movies.release_date, Movies.youtube_id
            FROM books 
            JOIN authors ON Books.author_id = Authors.author_id
            LEFT JOIN movies ON Books.movie_id = Movies.movie_id
            WHERE Books.book_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?php echo $book['name']; ?></h1>
                <p class="card-text">
                    <a href="<?php echo BASE_URL; ?>src/authors/authorDetails.php?id=<?php echo $book['author_id']; ?>" class="author-link"><?php echo $book['author_name']; ?></a>
                </p>
                <p class="description-text"><?php echo $book['description']; ?></p>
                <?php if ($book['movie_id']): ?>
                    <h2 class="card-title">Related Movie</h2>
                    <p class="card-text"><strong>Movie Name:</strong> <?php echo $book['movie_name']; ?></p>
                    <p class="card-text"><strong>Release Date:</strong> <?php echo $book['release_date']; ?></p>
                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $book['youtube_id']; ?>" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <div class="btn-group" role="group">
                    <a href="<?php echo BASE_URL; ?>src/books/viewAllBooks.php" class="btn btn-primary">Back to Books</a>
                    <a href="<?php echo BASE_URL; ?>src/books/updateBook.php?id=<?php echo $book['book_id']; ?>" class="btn btn-warning">Update Book</a>
                    <a href="<?php echo BASE_URL; ?>src/books/deleteBook.php?id=<?php echo $book['book_id']; ?>" class="btn btn-danger">Delete Book</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    $stmt->close();
    $connect->close();
?>
