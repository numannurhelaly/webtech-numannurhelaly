<?php

require_once("../model/BookModel.php");

function insertBookController($data)
{
    return addBook(
        $data['title'],
        $data['author'],
        $data['category'],
        $data['status']
    );
}

function showBooksController()
{
    return getBooks();
}

function removeBookController($id)
{
    return deleteBook($id);
}

function editBookController($id)
{
    return getBookById($id);
}

function updateBookController($data)
{
    return updateBook(
        $data['id'],
        $data['title'],
        $data['author'],
        $data['category'],
        $data['status']
    );
}

?>