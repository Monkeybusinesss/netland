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

    $query = "SELECT * FROM movies WHERE id = $id";

    $data = $con->query($query);

    foreach ($data as $row) {
        echo "<h1>";
        echo $row['title'];
        echo " - ";
        echo $row['length_in_minutes'] . " minuten";
        echo "</h1>";
        echo "<br>";
        echo "<b>";
        echo "Datum van uitkomst ";
        echo "</b>";
        echo $row['released_at'];
        echo "<br>";
        echo "<b>";
        echo "Land van uitkomst ";
        echo "</b>";
        echo $row['country_of_origin'];
        echo "<br>";
        echo "<br>";
        echo $row['summary'];
        echo "<br>";
        echo "<br>";
        $video = $row['youtube_trailer_id'];
        $video = '<iframe width="640" height="360" src="https://www.youtube.com/embed/' . $video . '"></iframe>';
        echo $video;
    }
} catch (PDOException $e) {
    die($e->getMessage());
}

?>