<?php include __DIR__ . '/../../config.php'; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid navbar-container">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">
            <img src="<?php echo BASE_URL; ?>images/logo.svg" alt="Logo" width="30" height="30">
            <span class="logo-name">Read2Watch</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>src/books/viewAllBooks.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>src/authors/viewAllAuthors.php">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>src/movies/viewAllMovies.php">Movies</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
