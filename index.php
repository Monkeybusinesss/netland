<?php

$host = 'localhost';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

try {
   $con = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $query = "SELECT id,title,rating FROM series";

   $data = $con->query($query);

   echo "<table>
           <tr>
               <th><a href=''>Title</a></th>
               <th><a href=''>Rating</a></th>
               <th></th>
           </tr>";

  foreach ($data as $row) {
      echo "<tr>";
      echo "<td>" . $row['title'] . "</td>";
      echo "<td>" . $row['rating'] . "</td>";
      echo "<td>";
      echo "<a href='series.php?id=" . $row['id'] . "'> Bekijk details </a>";
      echo "</td>";
      echo "</tr>";
  }

   $query = "SELECT id,title,length_in_minutes FROM movies";

   $data = $con->query($query);

   $sort = "DESC";

   echo "<table>
           <tr>
               <th><a href=''>Title</a></th>
               <th><a href=''>Duur</a></th>
               <th></th>
           </tr>";

  foreach ($data as $row) {
      echo "<tr>";
      echo "<td>" . $row['title'] . "</td>";
      echo "<td>" . $row['length_in_minutes'] . "</td>";
      echo "<td>";
      echo "<a href='films.php?id=" . $row['id'] . "'> Bekijk details </a>";
      echo "</td>";
      echo "</tr><br>";
  }
} catch (PDOException $e) {
   die($e->getMessage());
}
?>