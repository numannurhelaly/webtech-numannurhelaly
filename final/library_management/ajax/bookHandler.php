<?php

require_once("../controller/BookController.php");

if (isset($_POST['action']))
{
    $action = $_POST['action'];

    // ADD BOOK
    if ($action == "add")
    {
        insertBookController($_POST);
    }

    // FETCH BOOKS
    if ($action == "fetch")
    {
        $books = showBooksController();

        while($row = mysqli_fetch_assoc($books))
        {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['category']}</td>
                <td>{$row['status']}</td>

                <td>
                    <button onclick='editBook({$row['id']})'>Edit</button>

                    <button onclick='deleteBook({$row['id']})'>
                        Delete
                    </button>
                </td>
            </tr>
            ";
        }
    }

    // DELETE BOOK
    if ($action == "delete")
    {
        removeBookController($_POST['id']);
    }

    // GET SINGLE BOOK
    if ($action == "get")
    {
        $book = editBookController($_POST['id']);

        echo json_encode($book);
    }

    // UPDATE BOOK
    if ($action == "update")
    {
        updateBookController($_POST);
    }
}

?>