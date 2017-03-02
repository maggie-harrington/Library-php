<?php

    class Author
{
    private $name;
    private $id;

    function __construct($name, $id=null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function getId()
    {
        return $this->id;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO authors (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_authors = $GLOBALS['DB']->query("SELECT * FROM authors;");
        $authors = array();
        foreach($returned_authors as $author) {
            $name = $author['name'];
            $id = $author['id'];
            $new_author = new Author($name, $id);
            array_push($authors, $new_author);
        }
        return $authors;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM authors;");
    }

    static function find($id)
    {
        $returned_authors = $GLOBALS['DB']->query("SELECT * FROM authors WHERE id = {$id};");
        $found_author = null;
        foreach($returned_authors as $author) {
            $name = $author['name'];
            $id = $author['id'];
            $found_author = new Author($name, $id);
        }
        return $found_author;
    }

    // function update($property, $value)
    // {
    //     $GLOBALS['DB']->exec("UPDATE authors SET {$property} = '{$value}' WHERE id = {$this->getId()};");
    //     $this->{$property} = $value;
    // }


    function update($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE authors SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM authors WHERE id = {$this->getId()};");
    }

    function addBook($new_book)
    {
        $GLOBALS['DB']->exec("INSERT INTO authors_books (author_id, book_id) VALUES ({$this->getId()}, {$new_book->getId()});");
    }

    function getBooks()
    {
        $author_books = array();
        $queried_books = $GLOBALS['DB']->query("SELECT books.* FROM authors
            JOIN authors_books ON (authors_books.author_id = authors.id)
            JOIN books ON (books.id = authors_books.book_id)
            WHERE authors.id = {$this->getId()};");
        foreach($queried_books as $book) {
            $title = $book['title'];
            $id = $book['id'];
            $added_book = new Book($title, $id);
            array_push($author_books, $added_book);
        }

        return $author_books;
    }
}
 ?>
