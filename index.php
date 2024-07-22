<?php
    include('./src/reusable/utilities.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <title>Books & Movies CMS</title>
</head>
<body>
    <?php include('./src/reusable/header.php')?>

    <div class="content-section">
        <h1>Welcome to Read2Watch</h1>
        <p>Discover an expansive world of literature and cinema, where books meet their movie adaptations.</p>
        <p>Explore detailed profiles of authors, delve into captivating books, and watch trailers of movies based on these literary works.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="./images/books.svg" alt="Books">
                    <h3>Books</h3>
                    <p>Explore our extensive collection of books. From timeless classics to modern bestsellers, we have a book for every reader.</p>
                    <p>Whether you're looking for fiction, non-fiction, mystery, romance, or science fiction, our collection is curated to cater to all literary tastes.</p>
                    <a href="./src/books/viewAllBooks.php" class="btn btn-primary">View Books</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="./images/movie.svg" alt="Movies">
                    <h3>Movies</h3>
                    <p>Watch trailers of movies based on books. Discover how your favorite stories have been adapted into films and enjoy the visual storytelling.</p>
                    <p>Get insights into the movies, learn about the cast, directors, and enjoy exclusive trailers and behind-the-scenes content.</p>
                    <a href="./src/movies/viewAllMovies.php" class="btn btn-primary">View Movies</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="./images/author.svg" alt="Authors">
                    <h3>Authors</h3>
                    <p>Learn more about your favorite authors. Dive into their biographies, explore their works, and understand their literary contributions.</p>
                    <p>Stay updated with author interviews, their latest publications, and personal insights that shape their writing journey.</p>
                    <a href="./src/authors/viewAllAuthors.php" class="btn btn-primary">View Authors</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>