<?php
error_reporting(E_ALL);
/* Include the database connection */
include("db_connect.php");

/* Get all the GET variables if they are set */
$color = isset($_GET['color']) ? $_GET['color'] : '';
$address = isset($_GET['address']) ? $_GET['address'] : '';

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $_GET);
// echo "<br>";

$query = "SELECT P.pname
FROM Parts P
WHERE P.color='" . $color . "' AND NOT EXISTS
	(
		SELECT S.sid
		FROM Suppliers S
	  	WHERE S.address='" . $address . "' AND S.sid NOT IN 
		(
			SELECT C.sid
	 		FROM Catalog C
			WHERE C.pid=P.pid
		)
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
	echo "<td><strong>Part Name</strong></td>";
	echo "</tr></thead><tbody>";
	while ($row = $result->fetch_row()) {
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "</tr>";
	}
	echo "</tbody></table></div>";
	$result->close();
}


?>

