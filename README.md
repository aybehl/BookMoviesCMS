# Books & Movies CMS

## Introduction
Books & Movies CMS is a web application that allows users to manage a collection of books, their authors, and related movies. The application provides functionalities for adding, viewing, updating, and deleting books and authors, as well as associating books with movies.

## Database

### Database Name: `BooksMoviesDB`

### Entities

1. **Authors**
    - `author_id` (INT, Primary Key, Auto Increment)
    - `author_name` (VARCHAR(100), NOT NULL)
    - `author_email` (VARCHAR(100), NOT NULL)
    - `instagram_handle` (VARCHAR(100), NULL)

2. **Books**
    - `book_id` (INT, Primary Key, Auto Increment)
    - `name` (VARCHAR(255), NOT NULL)
    - `author_id` (INT, Foreign Key, NOT NULL)
    - `description` (TEXT, NOT NULL)
    - `movie_id` (INT, Foreign Key, NULL)

3. **Movies**
    - `movie_id` (INT, Primary Key, Auto Increment)
    - `movie_name` (VARCHAR(255), NOT NULL)
    - `release_date` (DATE, NOT NULL)
    - `youtube_id` (VARCHAR(15), NOT NULL)

### Table Relationships
- A book is written by an author (`books.author_id` -> `authors.author_id`)
- A book may be associated with a movie (`books.movie_id` -> `movies.movie_id`)

## CRUD Operations

### Authors
- **Create**: Add a new author
    - **Endpoint**: `addAuthor.php`
    - **Fields**: `author_name`, `author_email`, `instagram_handle`
- **Read**: View all authors and view individual author details
    - **Endpoint**: `viewAllAuthors.php`, `authorDetails.php`
- **Update**: Edit an author's details
    - **Endpoint**: `updateAuthor.php`
    - **Fields**: `author_name`, `author_email`, `instagram_handle`
- **Delete**: Remove an author
    - **Endpoint**: `deleteAuthor.php`
    - **Fields**: `author_id`
    - **Note**: Cannot delete an author that has a book associated with it

### Books
- **Create**: Add a new book
    - **Endpoint**: `addBook.php`
    - **Fields**: `name`, `author_id`, `description`, `movie_id`(Optional)
- **Read**: View all books and view individual book details
    - **Endpoint**: `viewAllBooks.php`, `bookDetails.php`
- **Update**: Edit a book's details
    - **Endpoint**: `updateBook.php`
    - **Fields**: `name`, `author_id`, `description`, `movie_id`
- **Delete**: Remove a book
    - **Endpoint**: `deleteBook.php`
    - **Fields**: `book_id`
    - **Note**: We can delete any book

### Movies
- **Create**: Add a new movie
    - **Endpoint**: `addMovie.php`
    - **Fields**: `movie_name`, `release_date`, `youtube_id`
- **Read**: View all movies and view individual movie details
    - **Endpoint**: `viewAllMovies.php`, `movieDetails.php`
- **Update**: Edit a movie's details
    - **Endpoint**: `updateMovie.php`
    - **Fields**: `movie_name`, `release_date`, `youtube_id`
- **Delete**: Remove a movie
    - **Endpoint**: `deleteMovie.php`
    - **Fields**: `movie_id`
    - **Note**: Cannot delete a Movie that has a Book associated with it

## Installation

1. **Clone the repository in MAMP/htdoc folder:**
    ```bash
    git clone https://github.com/yourusername/booksmoviescms.git
    ```

2. **Navigate to the project directory:**
    ```bash
    cd booksmoviescms
    ```

3. **Set up the database:**
    - Create a database named `BooksMoviesDB` in PHPMyAdmin.
    - Import the SQL file provided in the project to set up the tables and initial data.

4. **Configure the project:**
    - Update the `config.php` file with your database connection details.

5. **Run the project:**
    - Open a web browser and navigate to `http://localhost/booksmoviescms`

## Usage

- The Homepage contains links to View Movies, Authors and Books
- Navigate to the view all books page to view the list of books.
- Use the "Add a Book" button to add new books to the database.
- Click on a book title to view its details.
- Use the "Update" and "Delete" buttons to manage books.
- Similar functionality is available for managing authors and movies.
