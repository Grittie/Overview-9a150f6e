<?php
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
    #echo($dsn);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$titles = $pdo->query('SELECT title FROM series');
$rating = $pdo->query('SELECT rating FROM series');

echo "
<h1>Netland film review</h1>
<h2>Series</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Rating</th>
    </tr>";

foreach ($titles as $row) {
    echo "<tr>";
    echo "<td>" . $row['title'] . "</td>";

    foreach ($rating as $rowa) {
        echo "<td>" . $rowa['rating'] . "</td>";
        break;
    }
    echo "</tr>";
}
echo "</table>";

$titles = $pdo->query('SELECT title FROM movies');
$duur = $pdo->query('SELECT duur FROM movies');

echo "
<h2>Movies</h2>
<table>
    <tr>
        <th>Titel</th>
        <th>Duration</th>
    </tr>";

foreach ($titles as $row) {
    echo "<tr>";
    echo "<td>" . $row['title'] . "</td>";
    foreach ($duur as $rowa) {
        echo "<td>" . $rowa['duur'] . "</td>";
        break;
    }
    echo "</tr>";
}

echo "</table>";
?>

</body>

</html>