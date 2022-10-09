
<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Admin page</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the BOOKS table exists. */
  VerifyBooksTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the BOOKS table. */
  $book_name = htmlentities($_POST['BOOKNAME']);
  $book_author = htmlentities($_POST['BOOKAUTHOR']);
  $book_stock = htmlentities($_POST['STOCK']);

  if (strlen($book_name) && strlen($book_author) && isset($book_stock)) {
    AddBook($connection, $book_name, $book_author, $book_stock);
  }

  $book_id = htmlentities($_POST['BOOKID']);

  /* If book id is populated, delete a row from the BOOKS table. */
  if(isset($book_id)) {
          RemoveBook($connection, $book_id);
  }

?>

<h2> Add Book </h2>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>AUTHOR</td>
      <td>STOCK</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="BOOKNAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="BOOKAUTHOR" maxlength="90" size="60" />
      </td>
        <td>
                <input type="number" name="STOCK" min="0" />
        </td>
      <td>
        <input type="submit" value="Add Book" />
      </td>
    </tr>
  </table>
</form>

<h2> Books </h2>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>BOOK NAME</td>
    <td>BOOK AUTHOR</td>
    <td>BOOK STOCK</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM BOOKS");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>";
  echo "</tr>";
}
?>

</table>

<br>

<h2> Remove Book by ID </h2>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>BOOK ID</td>
    </tr>
    <tr>
      <td>
        <input type="number" name="BOOKID" min="0" />
      </td>
      <td>
        <input type="submit" value="Remove Book" />
      </td>
    </tr>
  </table>
</form>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>

CREATE TABLE BORROWEDBOOKS (
        BORROWEDBOOKID int UNSIGNED AUTO_INCREMENT,
        BOOKID int UNSIGNED NOT NULL,
        PRIMARY KEY (BORROWEDBOOKID),
        FOREIGN KEY(BOOKID) REFERENCES BOOKS(BOOKID)
     );
<?php

/* Add a book to the table. */
function AddBook($connection, $name, $author, $stock) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $author);
   $s = mysqli_real_escape_string($connection, $stock);
   
   $query = "INSERT INTO BOOKS (BOOKNAME, BOOKAUTHOR, STOCK) VALUES ('$n', '$a', '$s');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding book data.</p>");
}

/* Remove a book from the table. */
function RemoveBook($connection, $id) {
   $id = mysqli_real_escape_string($connection, $id);

   $query = "DELETE FROM BOOKS WHERE BOOKID = '$id';";

   if(!mysqli_query($connection, $query)) echo("<p>Error deleting book data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyBooksTable($connection, $dbName) {
  if(!TableExists("BOOKS", $connection, $dbName))
  {
     $query = "CREATE TABLE BOOKS (
         BOOKID int UNSIGNED AUTO_INCREMENT,
         BOOKNAME VARCHAR(45) NOT NULL,
         BOOKAUTHOR VARCHAR(90) NOT NULL,
         STOCK int NOT NULL,
         PRIMARY KEY (BOOKID)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection, 
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>