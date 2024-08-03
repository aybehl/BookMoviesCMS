<?php
    $connect = mysqli_connect('localhost', 'root', 'root', 'bookmovies_database');

    if(!$connect){
        die("Connection Failed: " . mysqli_connect_error());
    }