<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<?php
include_once "dbh.inc.php";

$sql = "SELECT helyazonosito, COUNT(*) AS eladott_jegyek
        FROM jegy
        GROUP BY helyazonosito
        ORDER BY eladott_jegyek DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Legnépszerűbb járatok adatai</h1>";
    echo "<table  border='1'>";
    echo "<tr><th>Járat azonosító</th><th>Eladott jegyek száma</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["jaratazonosito"] . "</td><td>" . $row["eladott_jegyek"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek adatok a legnépszerűbb járatokról.";
}

// Close the database connection
$conn->close();