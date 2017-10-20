<?php
error_reporting(E_ALL);
/* Include the database connection */
include("db_connect.php");

/* Get all the GET variables if they are set */
$cost = isset($_GET['cost']) ? $_GET['cost'] : 0;

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $_GET);
// echo "<br>";
// echo $cost;

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $selectors);
// echo "<br>";

/* If the part name is given then query only that part otherwise query everything */
$query = "SELECT DISTINCT S.sname, S.sid FROM Suppliers S, Catalog C WHERE C.sid = S.sid AND C.cost>='" . $cost . "';";

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
	echo "</tr></thead><tbody>";
	while ($row = $result->fetch_row()) {
		echo "<tr>";
		echo "<td>";
		echo $row[0];
		echo "</td>";
		echo "</tr>";
	}
	echo "</tbody></table></div>";
	$result->close();
}


?>

