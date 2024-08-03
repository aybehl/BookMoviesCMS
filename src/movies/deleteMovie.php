<?php

    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';
    include __DIR__ . '/../reusable/utilities.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Check if the movie ID exists in the books table
        $checkQuery = "SELECT * FROM books WHERE movie_id = '$id'";
        $checkResult = mysqli_query($connect, $checkQuery);

        if(mysqli_num_rows($checkResult) > 0){
            setMessageAndRedirect('Cannot delete movie as it is linked to a Book', 'danger', BASE_URL . 'src/movies/movieDetails.php?id=' . $id);
        } else {
            $query = "DELETE FROM movies WHERE id = '$id'";
            $movie = mysqli_query($connect, $query);

            if($movie){
                setMessageAndRedirect('Movie was deleted successfully', 'success', BASE_URL . 'src/movies/viewAllMovies.php');
            } else {
                echo "Failed: " . mysqli_error($connect);
                setMessageAndRedirect('Error occurred when trying to delete a Movie', 'danger', BASE_URL . 'src/movies/viewAllMovies.php');
            }
        }
        
        // code skips to this line and does not delete
    } else {
        echo 'Not Authorized';
    }

?>

