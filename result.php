<?php
error_reporting(E_ALL);
if ( isset($_GET['date']) ){
	include("db_connect.php");
	$date = $_GET['date'];
	$dateFrom = $_GET['dateFrom'];
	$dateTo = $_GET['dateTo'];

	$processAppName = $_GET['processAppName'];
	$processname;
	$totalCount = 0;

	class Process {
		public $start_time;
		public $end_time;

		public static $max_count = 0;
		public static $current_count = 0;

		function getStartTime () {
			return $this->start_time;
		}

		function getEndTime () {
			return $this->start_time;
		}

		function __construct($start_time, $end_time) {
			$this->start_time = $start_time;
			$this->end_time = $end_time;
		}
	}

	$arr_process = array();

	if ($processAppName == "All") {
		$query = "SELECT * FROM ps_include;";

		if ($result = $mysqli->query($query)) {
			echo "<table class='table table-striped table-responsive'><thead><tr><th>App Name</th><th>Paid Software?</th><th>Process Name</th><th>Total Usage</th><th>Max Concurrent Users</th></tr></thead><tbody>";
			while ($row_names = $result->fetch_row()) {
				$processname = $row_names[2];
				$appname = $row_names[1];
				$paid_or_not = $row_names[3];

				$query2 = "SELECT * FROM ps_track WHERE name='" . $processname . "' AND start_time >= '" . $dateFrom . "' AND end_time <= '" . $dateTo . "' ORDER BY start_time, end_time;";
				if ($result2 = $mysqli->query($query2)) {
					while ($row_count = $result2->fetch_row()) {
						$nameofprocess = $row_count[1];
						$start_time = $row_count[2];
						$end_time = $row_count[3];
						$latest = new Process($start_time, $end_time);
						$arr_process[] = $latest;
						Process::$current_count++;

						$deleteTheseItems = array();

						for ($i=0; $i<count($arr_process)-1; $i++) {
							if($latest->start_time > $arr_process[$i]->end_time) {
								$deleteTheseItems[] = $i;
							}
						}
						$deleteTheseItems = array_reverse($deleteTheseItems);
						Process::$current_count -= count($deleteTheseItems);
						if(Process::$max_count < Process::$current_count) {
							Process::$max_count = Process::$current_count;
						}
						foreach($deleteTheseItems as $i) {
							array_splice($arr_process, $i, 1);
						}

						unset($deleteTheseItems);
						$totalCount++;
					}
					echo "<tr><td> " . $appname . " </td>";
					if($paid_or_not) {
						echo "<td> Yes </td>";
					}
					else {
						echo "<td> No </td>";
					}
					echo "<td> " . $processname . " </td>";
					echo "<td> " . $totalCount . "</td>";
					echo "<td> " . Process::$max_count . "</td></tr>";
					$totalCount=0;
					Process::$max_count = 0;
					Process::$current_count = 0;
					unset($arr_process);
				}
				$result2->close();
			}
			echo "</tbody></table> ";


			$result->close();
		}


	}
	else {
		$query = "SELECT process_name FROM ps_include WHERE app_name='" . $processAppName . "';";

		if ($result = $mysqli->query($query)) {
			while ($row = $result->fetch_row()) {
				$processname = $row[0];
				echo "<br />Process Name: " . $processname;
			}
			$result->close();
		}

		$query = "SELECT * FROM ps_track WHERE name='" . $processname . "' AND start_time >= '" . $dateFrom . "' AND end_time <= '" . $dateTo . "' ORDER BY start_time, end_time;";
		if ($result = $mysqli->query($query)) {
			while ($row = $result->fetch_row()) {
				$start_time = $row[2];
				$end_time = $row[3];
				$latest = new Process($start_time, $end_time);
				$arr_process[] = $latest;
				Process::$current_count++;

				$deleteTheseItems = array();

				for ($i=0; $i<count($arr_process)-1; $i++) {
					if($latest->start_time > $arr_process[$i]->end_time) {
						$deleteTheseItems[] = $i;
					}
				}
				$deleteTheseItems = array_reverse($deleteTheseItems);
				Process::$current_count -= count($deleteTheseItems);
				if(Process::$max_count < Process::$current_count) {
					Process::$max_count = Process::$current_count;
				}
				foreach($deleteTheseItems as $i) {
					array_splice($arr_process, $i, 1);
				}
				unset($deleteTheseItems);
				$totalCount++;
			}

			echo '<br /><h4> Maximum Concurrent Users: <strong>' . Process::$max_count . '</strong>';			
			echo "<br /> Total Usage: <strong>" . $totalCount . "</strong></h4>";
			Process::$max_count = 0;
			Process::$current_count = 0;
			$result->close();
		}
	}
}

?>

