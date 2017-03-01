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
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
        }

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

        function testSave()
        {
            $name = "S. King";
            $test_author = new Author($name);

            $test_author->save();
            $result = Author::getAll();

            $this->assertEquals([$test_author], $result);
        }

        function testGetAll()
        {
            $name = "S. King";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Patty Smith";
            $test_author2 = new Author($name2);
            $test_author2->save();

            $result = Author::getAll();

            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function testDeleteAll()
        {
            $name = "S. King";
            $test_author = new Author($name);
            $test_author->save();

            $name2 = "Patty Smith";
            $test_author2 = new Author($name2);
            $test_author2->save();

            Author::deleteAll();
            $result = Author::getAll();

            $this->assertEquals([], $result);
        }

        

    }
