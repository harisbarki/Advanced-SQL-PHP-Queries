<?php

error_reporting(E_ALL);
/* Include the database connection */
include("db_connect.php");

/* Get all the GET variables if they are set */
$pname = isset($_GET['pname']) ? $_GET['pname'] : '';
$sid = isset($_GET['sid']) ? $_GET['sid'] : false;
$sname = isset($_GET['sname']) ? $_GET['sname'] : false;
$address = isset($_GET['address']) ? $_GET['address'] : false;
$cost = isset($_GET['cost']) ? $_GET['cost'] : false;

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $_GET);
// echo "<br>";

/* Initialize arrays for selectors and their names */
$selectors = [];
$selectorNames = [];

/* If the GET variables are set to true then add them to selectors and the selector names */
if($sid == true) {
	array_push($selectors, 'S.sid');
	array_push($selectorNames, 'ID');
}
if($sname == true) {
	array_push($selectors, 'S.sname');
	array_push($selectorNames, 'Name');
}
if($address == true) {
	array_push($selectors, 'S.address');
	array_push($selectorNames, 'Address');
}
if($cost == true) {
	array_push($selectors, 'C.cost');
	array_push($selectorNames, 'Cost ($)');
}

/* For DEBUG purposes, uncomment the following lines */
// echo implode(' ', $selectors);
// echo "<br>";

/* If the part name is given then query only that part otherwise query everything */
if($pname == '') {
	$query = "SELECT " . implode(', ', $selectors) . " FROM Suppliers S, Parts P, Catalog C WHERE C.sid = S.sid AND C.pid = P.pid;";
} else {
	$query = "SELECT " . implode(', ', $selectors) . " FROM Suppliers S, Parts P, Catalog C WHERE C.sid = S.sid AND C.pid = P.pid AND P.pname='" . $pname . "';";
}

/* For DEBUG purposes, uncomment the following lines */
// echo $query;
// echo "<br>";
// echo "<br>";

/* Run the query in the database, get the results and make a table */
if ($result = $mysqli->query($query)) {
	echo "<div class='table-responsive'>";
	echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
	echo "<thead><tr>";
	for( $i = 0; $i<count($selectorNames); $i++ ) {
		echo "<td><strong>" . $selectorNames[$i] . "</strong></td>";
	}
	echo "</tr></thead><tbody>";
	while ($row = $result->fetch_row()) {
		echo "<tr>";
		for( $i = 0; $i<count($selectors); $i++ ) {
			echo "<td>";
			echo $row[$i];
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table></div>";
	$result->close();
}

?>

