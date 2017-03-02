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

    class BookTest extends PHPUnit_Framework_TestCase


    {

        protected function tearDown()
        {
            Book::deleteAll();
            Author::deleteAll();
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

        function testFind()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $title2 = "It";
            $test_book2 = new Book($title2);
            $test_book2->save();

            $result = Book::find($test_book->getId());

            $this->assertEquals($test_book, $result);
        }

        function testUpdate()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $update_title = "Sun";

            $test_book->update($update_title);
            $result = $test_book->getTitle();

            $this->assertEquals($update_title, $result);
        }

        function testDelete()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $title2 = "It";
            $test_book2 = new Book($title2);
            $test_book2->save();

            $test_book2->delete();
            $result = Book::getAll();

            $this->assertEquals([$test_book], $result);
        }

        function testAddAuthor()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $name = "S. King";
            $test_author = new Author($name);
            $test_author->save();

            $test_book->addAuthor($test_author);
            $result = $test_book->getAuthors();

            $this->assertEquals([$test_author], $result);
        }

        function testGetAuthors()
        {
            $title = "Sky";
            $test_book = new Book($title);
            $test_book->save();

            $name = "S. King";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Patti Smith";
            $test_author2 = new Author($name2);
            $test_author2->save();

            $test_book->addAuthor($test_author);
            $test_book->addAuthor($test_author2);
            $result = $test_book->getAuthors();

            $this->assertEquals([$test_author, $test_author2], $result);

        }


    }
 ?>
