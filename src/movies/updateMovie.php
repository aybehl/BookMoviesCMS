<?php
    // reusable assets - connection, header and utilities
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';
    include __DIR__ . '/../reusable/utilities.php';

    $movie_id = $_GET['id'];
    $message = '';


    $sql = "SELECT * FROM movies WHERE id = $movie_id";
    $stmt = $connect->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("No movie found with the given ID.");
    }
    $movie = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movie_name = $_POST['movie_name'];
        $movie_release_date = $_POST['release_date'];
        $youtube_id = $_POST['youtube_id'];

        if(!empty($movie_name) && !empty($movie_release_date)) {
            $sql = "UPDATE movies SET movie_name = ?, release_date = ?, youtube_id = ? WHERE movie_id = ?";
            $stmt = $connect->prepare($sql);
            if($stmt === false) {
                die("Prepare failed:". htmlspecialchars($connect->error));
            }
            $stmt->bind_param("sssi", $movie_name, $movie_release_date,$youtube_id, $movie_id);
            
            if ($stmt->execute()) {
                setMessageAndRedirect('Movie was updated successfully', 'success', BASE_URL . 'src/movies/viewAllMovies.php');
            } else {
                setMessageAndRedirect('Error occurred when trying to update the movie: ' . $stmt->error, 'danger', BASE_URL . 'src/movies/viewAllMovies.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <title>Update Movie</title>
</head>
<body>

    <div class="container mt-5">
        <h1>Update Movie</h1>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="updateMovie.php?id=<?php echo htmlspecialchars($movie_id); ?>" method="POST">
            <div class="mb-3">
                <label for="movie-name" class="form-label">Movie Name</label>
                <input type="text" class="form-control" id="movie_name" name="movie_name" value="<?php echo $movie['movie_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="movie-description" class="form-label">Movie Release Date</label>
                <input type="date" class="form-control" id="movie_release_date" name="movie_release_date" value="<?php echo $movie['release_date']; ?>">
            </div>
            <div class="mb-3">
                <label for="youtube-id" class="form-label">Youtube Video ID</label>
                <input type="text" class="form-control" id="youtube_id" name="youtube_id" value="<?php echo $movie['youtube_id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Movie</button>
            <a href="viewAllMovies.php" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>


<?php
    $connect->close();
?>