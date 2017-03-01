<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";
    require_once "src/Author.php";

    $server = 'mysql:host=localhost:8889;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AuthorTest extends PHPUnit_Framework_TestCase

    {
        function testGetName()
        {
            $name = "S. King";
            $test_author = new Author($name);

            $result = $test_author->getName();

            $this->assertEquals($name, $result);
        }

        function testGetId()
        {
            $name = "S. King";
            $id = 1;
            $test_author = new Author($name, $id);

            $result = $test_author->getId();

            $this->assertEquals($id, $result);
        }

        function testSetName()
        {
            $name = "S. King";
            $test_author = new Author($name);

            $new_name = "Stephen King";

            $test_author->setName($new_name);
            $result = $test_author->getName();

            $this->assertEquals($new_name, $result);
        }
    }
