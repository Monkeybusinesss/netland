<?php

echo '<a href="index.php">Terug</a><br><br>';

$host = '127.0.0.1';
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

    $id = $_GET['id'];

    $query = "SELECT * FROM series WHERE id=$id";
 
    $data = $con->query($query);
 
    foreach ($data as $row) { 
        echo "<h1>";
        echo $row['title'];
        echo " - ";
        echo $row['rating'];
        echo "</h1>";
        echo "<br>";
        echo "<b>";
        echo "Awards? ";
        echo "</b>";
        echo $row['has_won_awards'];
        echo "<br>";
        echo "<b>";
        echo "Seasons ";
        echo "</b>";
        echo $row['seasons'];
        echo "<br>";
        echo "<b>";
        echo "Country ";
        echo "</b>";
        echo $row['country'];
        echo "<br>";
        echo "<b>";
        echo "Language ";
        echo "</b>";
        echo $row['spoken_in_language'];
        echo "<br>";
        echo "<br>";
        echo $row['summary'];
    }
} catch (PDOException $e) {
     die($e->getMessage());
}

?>