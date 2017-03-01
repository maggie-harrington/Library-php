# _Library_

#### _A library catalogue app for librarians and patrons._

#### By _**Maggie Harrington & Leah Sherrell**_

## Description

_This app allows a user (Librarian) to inventory the catalogue, search for a title and keep a list of overdue books. It also allows a user (Patron) to check out a book, know how many copies of a book are on the shelf, view a check-out history, and know due-date._

## Setup/Installation Requirements

* Ensure [composer](https://getcomposer.org/) is installed on your computer.

* In terminal run the following commands:

1. _Fork and clone this repository from_ [gitHub]https://github.com/leahsherrell/Library-php.git.
2. Navigate to the root directory of the project in the CLI shell you are using and run the command: `composer install`.
3. To run tests enter `composer test` in terminal.
4. Use MAMP.
5. Open the directory http://localhost:8888/.
6. Start server with MAMP and make sure your mySQL server is set to 3306.
7. Open phpMyAdmin and import the database zip files named library.sql.zip and library_test.sql.zip located in the project folder to import the databases needed.

## Specifications

|    *Behavior*   |    *Input*    |     *Output*    |
|-----------------|---------------|-----------------|
|Create book record|Enter Title and Author ("It" by Stephen King)|"It" added to book list|
|Read book record|Click on book title "It"|Record for "It"|
|Update book record|click update, type updated info "It, new edition" |"It, new edition" instead of "It"|
|Delete book record|click delete in "It" record|List books without "It"|
|Search for a book by title |Enter "It" into search field|List of books containing the word "It" in the title |
|Search for a book by author |Enter "Stephen King" into search field|List of books written by Stephen King |
|Enter multiple authors for one book | Enter "Maggie Harrington" and "Leah Sherrell" as authors for "Sky" |"Sky" is now listed with 2 authors|



## Known Bugs

_None so far._

## Support and contact details

_Please contact maggie.harrington@gmail.com or leahsherrell@gmail.com with concerns or comments._

## Technologies Used

* _Composer_
* _CSS_
* _HTML_
* _MySQL_
* _PHP_
* _PHPUnit_
* _Silex_
* _Twig_

### License

*MIT license*

Copyright (c) 2017 **Leah Sherrell & Maggie Harrington** All Rights Reserved.
