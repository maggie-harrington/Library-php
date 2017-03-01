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

}
 ?>
