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

        protected function tearDown()
        {
            Book::deleteAll();
        }

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

        function testSetTitle()
        {
            $title = "Sky";
            $test_book = new Book($title);

            $new_title = "Sun";

            $test_book->setTitle($new_title);
            $result = $test_book->getTitle();

            $this->assertEquals($new_title, $result);
        }

        function testSave()
        {
            $title = "Sky";
            $test_book = new Book($title);

            $test_book->save();
            $result = Book::getAll();

            $this->assertEquals([$test_book], $result);
        }

        function testGetAll()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $title2 = "It";
            $test_book2 = new Book($title2);
            $test_book2->save();

            $result = Book::getAll();

            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function testDeleteAll()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $title2 = "It";
            $test_book2 = new Book($title2);
            $test_book2->save();

            Book::deleteAll();
            $result = Book::getAll();

            $this->assertEquals([], $result);
        }


    }
 ?>
