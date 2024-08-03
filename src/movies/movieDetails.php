<?php
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';

    $movie_id = $_GET['id'];

    $query= 'SELECT * FROM movies WHERE Movies.movie_id = ' . $movie_id . ';';
    $results = mysqli_query($connect, $query);
    $movie = $results->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $movie['movie_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?php echo $movie['movie_name'] ?></h1>
                <p class="card-text fw-bold">
                    Release Date:
                </p>
                <p class="card-text"><?php echo $movie['release_date']; ?></p>
                <div class="embed-responsive embed-responsive-16by9 mb-3">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $movie['youtube_id']; ?>" allowfullscreen></iframe>
                </div>
                <div class="btn-group" role="group">
                    <a href="<?php echo BASE_URL; ?>src/movies/viewAllMovies.php" class="btn btn-primary">Back to Movies</a>
                    <a href="<?php echo BASE_URL; ?>src/movies/updateMovie.php?id=<?php echo $result['movie_id']; ?>" class="btn btn-warning">Update Movie</a>
                    <a href="<?php echo BASE_URL; ?>src/movies/deleteMovie.php?id=<?php echo $result['movie_id']; ?>" class="btn btn-danger">Delete Movie</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    $connect->close();
?>