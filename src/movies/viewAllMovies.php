<?php
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';
    include __DIR__ . '/../reusable/utilities.php';


    $query= 'SELECT * FROM movies';
    $movies = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&display=swap" rel="stylesheet">
    <title>Movies</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
            <?php
                getMessage();
            ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <h1>Movies</h1>
            </div>
            <div class="col text-end">
                <a href="addMovie.php" class="btn btn-success">Add a Movie</a>
            </div>
        </div>

        <div class="row">
            <?php while($row = $movies->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['movie_name']; ?></h5>
                            <a href="movieDetails.php?id=<?php echo $row['movie_id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
    $connect->close();
?>