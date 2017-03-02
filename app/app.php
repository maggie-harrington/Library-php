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
        return $app['twig']->render('book.html.twig', array('book' => $book));
    });

    $app->get("/author/{id}", function($id) use ($app) {
        $author = Author::find($id);
        return $app['twig']->render('author.html.twig', array('author' => $author));
    });

    return $app;
 ?>
