<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html lang="en">

<header>
  <meta charset="UTF-8">
  <title>Home</title>

  <style>
    th {
      text-align: left;
    }

    table,
    th,
    td {
      border: 2px solid grey;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 0.2em;
    }
  </style>
</header>

<body>

  <h1>Database Display</h1>

  <p>Shocwing contents of the book table:</p>

  <table border="1">
    <tr>
      <th>bookID</th>
      <th>Title</th>
      <th>Author</th>
      <th>stock</th>
    </tr>

    <?php

    $db_host   = '192.168.2.13';
    $db_name   = 'bookstorage';
    $db_user   = 'customer';
    $db_passwd = 'Pa55w0rD';

    $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

    $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

    $q = $pdo->query("SELECT * FROM book");

    while ($row = $q->fetch()) {
      echo "<tr><td>" . $row["bookID"] . "</td><td>" . $row["title"] . "</td><td>" . $row["author"] . "</td><td>" . $row["stock"] . "</td></tr>\n";
    }

    ?>
  </table>

  <p>
    Shortcut to go to customer index page <a href="../customer/cIndex.php">here</a>.
  </p>

  <h3>Click <a href="./aLogin.html">here</a> to logout</h3>

</body>

</html>