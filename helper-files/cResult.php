<?php
error_reporting(E_ALL);
/* Include the database connection */
include("db_connect.php");

/* Get all the GET variables if they are set */
$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $_GET);
// echo "<br>";
// echo $cost;

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $selectors);
// echo "<br>";

$query = "SELECT S.sname, S.address, S.sid, C.cost, C.pid
FROM Suppliers S, Catalog C
WHERE C.sid = S.sid AND C.pid='" . $pid . "'  
AND S.sid NOT IN (
	SELECT S1.sid
	FROM Suppliers S1, Catalog C1, Suppliers S2, Catalog C2
	WHERE S1.sid = C1.sid
	AND S2.sid = C2.sid
	AND C1.pid='" . $pid . "'  AND C2.pid='" . $pid . "' 
	AND C1.cost < C2.cost
)";

/* For DEBUG purposes, uncomment the following lines */
// echo $query;
// echo "<br>";
// echo "<br>";

/* Run the query in the database, get the results and make a table */
if ($result = $mysqli->query($query)) {
	echo "<div class='table-responsive'>";
	echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
	echo "<thead><tr>";
	echo "<td><strong>Name</strong></td>";
	echo "<td><strong>Address</strong></td>";
	echo "</tr></thead><tbody>";
	while ($row = $result->fetch_row()) {
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "<td>" . $row[1] . "</td>";
		echo "</tr>";
	}
	echo "</tbody></table></div>";
	$result->close();
}


?>

