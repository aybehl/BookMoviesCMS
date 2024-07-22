<?php
    $connect = mysqli_connect('localhost', 'root', 'root', 'BooksMoviesDB');

    if(!$connect){
        die("Connection Failed: " . mysqli_connect_error());
    }