<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";

    $server = 'mysql:host=localhost:8889;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase

    {
        function testGetTitle()
        {
            $title = "Sky";
            $test_book = new Book($title);

            $result = $test_book->getTitle();

            $this->assertEquals($title, $result);
        }

        function testGetId()
        {
            $title = "Sky";
            $id = 1;
            $test_book = new Book($title, $id);

            $result = $test_book->getId();

            $this->assertEquals($id, $result);
        }

    }
 ?>
