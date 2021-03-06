<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Book.php";
    require_once __DIR__."/../src/Author.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=library';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/librarian", function() use ($app) {
        return $app['twig']->render('librarian.html.twig', array('books' => Book::getAll(), 'authors' => Author::getAll()));
    });

    $app->post("/add-author", function() use ($app) {
        $author = new Author($_POST['name']);
        $author->save();

        return $app['twig']->render('librarian.html.twig', array('books' => Book::getAll(), 'authors' => Author::getAll()));
        // return $app->redirect('/librarian');
    });

    $app->post("/add-book", function() use ($app) {
        $book = new Book($_POST['title']);
        $book->save();

        return $app['twig']->render('librarian.html.twig', array('books' => Book::getAll(), 'authors' => Author::getAll()));
    });

    $app->get("/book/{id}", function($id) use ($app) {
        $book = Book::find($id);
        return $app['twig']->render('book.html.twig', array('book' => $book, 'book_authors' => $book->getAuthors(), 'authors' => Author::getAll()));
    });

    $app->get("/author/{id}", function($id) use ($app) {
        $author = Author::find($id);
        return $app['twig']->render('author.html.twig', array('author' => $author, 'author_books' => $author->getBooks(), 'books' => Book::getAll()));
    });

    $app->patch("/update-author/{id}", function($id) use ($app) {
        $new_name = $_POST['name'];
        $author = Author::find($id);
        $author->update($new_name);
        // return $app->redirect('/author/{id}');
        return $app['twig']->render('author.html.twig', array('author' => $author, 'author_books' => $author->getBooks(), 'books' => Book::getAll()));
    });

    $app->delete("/delete-author/{id}", function($id) use ($app) {
        $author = Author::find($id);
        $author->delete();
        return $app['twig']->render('librarian.html.twig', array('books' => Book::getAll(), 'authors' => Author::getAll()));
    });

    $app->patch("/update-book/{id}", function($id) use ($app) {
        $new_title = $_POST['title'];
        $book = Book::find($id);
        $book->update($new_title);

        return $app['twig']->render('book.html.twig', array('book' => $book, 'book_authors' => $book->getAuthors(), 'authors' => Author::getAll()));
    });

    $app->delete("/delete-book/{id}", function($id) use ($app) {
        $book = Book::find($id);
        $book->delete();
        return $app['twig']->render('librarian.html.twig', array('books' => Book::getAll(), 'authors' => Author::getAll()));
    });

    $app->post("/add-book-author", function() use ($app) {
        $author_id = $_POST['author_id'];
        $author = Author::find($author_id);
        $add_book = Book::find($_POST['book-list']);
        $author->addBook($add_book);
        return $app['twig']->render('author.html.twig', array('author' => $author, 'author_books' => $author->getBooks(), 'books' => Book::getAll()));
    });

    $app->post("/add-author-book", function() use ($app){
        $book_id = $_POST['book_id'];
        $book = Book::find($book_id);
        $add_author = Author::find($_POST['author-list']);
        $book->addAuthor($add_author);
        return $app['twig']->render('book.html.twig', array('book' => $book, 'book_authors' => $book->getAuthors(), 'authors' => Author::getAll()));

    });

    return $app;
 ?>
