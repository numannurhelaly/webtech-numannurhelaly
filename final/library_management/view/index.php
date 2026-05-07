<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

<h2>Library Management System</h2>

<input type="hidden" id="book_id">

<input type="text" id="title" placeholder="Book Title">
<input type="text" id="author" placeholder="Author Name">
<input type="text" id="category" placeholder="Category">

<select id="status">
    <option value="Available">Available</option>
    <option value="Not Available">Not Available</option>
</select>

<button id="addBtn">Add Book</button>
<button id="updateBtn" style="display:none;">Update Book</button>

<hr>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="bookData">

    </tbody>
</table>

<script src="script.js"></script>

</body>
</html>