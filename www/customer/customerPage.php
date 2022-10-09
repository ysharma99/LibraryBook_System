<?php include "../inc/dbinfo.inc"; ?>
<html>

<head>
        <title>Customer Page</title>

        <style>
                body {
                        font-family: "Verdana", "sans-serif";
                }

                h1 {
                        margin: auto;
                        text-align: center;
                }

                table {
                        border-color: red;
                }
        </style>
</head>

<body>
<h1>Customer page</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the BOOKS table exists. */
  VerifyBooksTable($connection, DB_DATABASE);
//  VerifyBorrowedBooksTable($connection, $database);

  /* If input fields are populated, add a row to the BOOKS table. */
//  $book_id_borrow = htmlentities($_POST['BOOKIDBORROW']);

  /* If the "borrow" book id is populated, add a row from the borrowed books table. */
/*  if(!isset($book_id_borrow)) {
          BorrowBook($connection, $book_id_borrow);
  }
 */
  /* If input field are populated, remove a row to the borrowed table. */
//  $book_id_return = htmlentities($_POST['BOOKIDRETURN']);

  /* If book id is populated, delete a row from the borrowed books table. */
/*  if(!isset($book_id_return)) {
          ReturnBook($connection, $book_id_return);
    }
 */
?>

<h2> Borrow Book by ID </h2>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>BOOK ID</td>
    </tr>
    <tr>
      <td>
      <input type="number" name="BOOKIDBORROW" min="0" />
      </td>
      <td>
        <input type="submit" value="Borrow Book" />
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

<h2> Return Book by ID </h2>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>BOOK ID</td>
    </tr>
    <tr>
      <td>
        <input type="number" name="BOOKIDRETURN" min="0" />
      </td>
      <td>
        <input type="submit" value="Return Book" />
      </td>
    </tr>
  </table>
</form>
<!--
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>BOOK NAME</td>
    <td>BOOK AUTHOR</td>
 </tr>
-->
<?php
/*
$result = mysqli_query($connection, "SELECT * FROM BORROWEDBOOKS");
$arr = array();

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[1],"</td>";
  echo "</tr>";
  $arr[] = $query_data[1];
}

$values = "(\"".implode("\",\"", $arr)."\")";
echo $values;
//$result_imports = mysqli_query($connection, "SELECT * FROM BOOKS WHERE BOOKID IN $values";



</table>
*/
?>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);
  echo "Errors: ";
  ini_set("display_errors", "on");
  ini_set("log_errors", "on");
  ini_set("display_startup_errors", "on");
//  error_report(E_ALL);
?>

</body>
</html>

<?php

/* Add a book to the borrow table. */
/*function BorrowBook($connection, $id) {
   $id = mysqli_real_escape_string($connection, $id);

   $query = "INSERT INTO BORROWEDBOOKS (BOOKID) VALUES ('$id');";


   if(!mysqli_query($connection, $query)) echo("<p>Error adding book data.</p>");

}
 */
/* Remove a book from the borrow table. */
/*function ReturnBook($connection, $id) {
   $id = mysqli_real_escape_string($connection, $id);

   $query = "DELETE FROM BORROWEDBOOKS WHERE BOOKID = '$id';";


   if(!mysqli_query($connection, $query)) echo("<p>Error deleting book data.</p>");

}
 */
/* Check whether the table exists and, if not, print error message. */
function VerifyBooksTable($connection, $dbName) {
  if(TableExists("BOOKS", $connection, $dbName))
  {
     $query = "SELECT * FROM BOOKS;";

  } else
  {
        echo("<p>Error querying table.</p>");
  }
}

/* Check whether the table exists and, if not, create it. */
/*function VerifyBorrowedBooksTable($connection, $dbName) {
  if(!TableExists("BORROWEDBOOKS", $connection, $dbName))
  {
     $query = "CREATE TABLE BORROWEDBOOKS (
        BORROWEDBOOKID int UNSIGNED AUTO_INCREMENT,
        BOOKID int UNSIGNED NOT NULL,
        PRIMARY KEY (BORROWEDBOOKID),
        FOREIGN KEY(BOOKID) REFERENCES BOOKS(BOOKID)
     );";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}
 */
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