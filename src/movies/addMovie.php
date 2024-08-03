<?php
    // reusable assests - connection, header and utilities
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';
    include __DIR__ . '/../reusable/utilities.php';


    //Form submission - basic set up
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movie_name = $_POST['movie_name'];
        $movie_release_date = $_POST['movie_release_date'];
        $youtube_id = $_POST['youtube_id'];

        $stmt = $connect->prepare("INSERT INTO movies (movie_name, release_date, youtube_id) VALUES (?, ? ,?)");

        $stmt->bind_param("sss", $movie_name, $movie_release_date,$youtube_id);

        if($stmt->execute()) {
            setMessageAndRedirect('Movie was added successfully', 'success', BASE_URL . 'src/movies/viewAllMovies.php');
        } else {
            setMessageAndRedirect('Error occurred when trying to add a Movie' . $stmt->error, 'danger', BASE_URL . 'src/movies/viewAllMovies.php');
        }

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
    <title>Add Movie</title>
</head>
<body>

    <div class="container mt-5">
        <h1>Add New Movie</h1>
        <form action="addMovie.php" method="POST">
            <div class="mb-3">
                <label for="movie-name" class="form-label">Movie Name</label>
                <input type="text" class="form-control" id="movie_name" name="movie_name" required>
            </div>
            <div class="mb-3">
                <label for="movie-description" class="form-label">Movie Release Date</label>
                <input type="date" class="form-control" id="movie_release_date" name="movie_release_date" required>
            </div>
            <div class="mb-3">
                <label for="youtube-id" class="form-label">Youtube Video ID</label>
                <input type="text" class="form-control" id="youtube_id" name="youtube_id">
            </div>
            <button type="submit" class="btn btn-primary">Add Movie</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>


<?php
    $connect->close();
?>