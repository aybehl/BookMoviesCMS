<?php
    // Include database connection
    include __DIR__ . '/../reusable/dbConnection.php';
    include __DIR__ . '/../reusable/header.php';

    // Get book ID from URL
    $book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($book_id > 0) {
            // Prepare SQL to delete the book
            $sql = "DELETE FROM books WHERE book_id = ?";
            $stmt = $connect->prepare($sql);
            if ($stmt === false) {
                die("Prepare failed: " . htmlspecialchars($connect->error));
            }

            $stmt->bind_param("i", $book_id);

            if ($stmt->execute()) {
                // Redirect to viewAllBooks.php after successful deletion
                header("Location: viewAllBooks.php");
                exit();
            } else {
                echo "Error deleting book: " . htmlspecialchars($stmt->error);
            }

            $stmt->close();
        } else {
            echo "Invalid book ID.";
        }
    }

    $connect->close();
?>

