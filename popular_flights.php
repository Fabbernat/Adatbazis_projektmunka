<?php
include_once "misc/navbar.php";
include_once "misc/connect_to_database[[maybe_deprecated]].php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

// Query to get the most popular flights based on helyazonosito
$sql = "SELECT helyazonosito, COUNT(*) AS eladott_jegyek
        FROM jegy
        GROUP BY helyazonosito
        ORDER BY eladott_jegyek DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Legnépszerűbb járatok adatai</h1>";
    echo "<table>";
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