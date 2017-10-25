<!doctype html>
<html>
<title>CS4754 - Project</title>
<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
	}

	.center {
		text-align:center;
	}

	#search {
		margin-top: 20px;
		margin-left: 5px;
		font-weight: bold;
	}

	.heading {
		/*text-shadow: 1px 1px black 25%;*/
		padding-right: 80px;
		color: black;
		text-shadow: 2px 1px 0px #fff, 2px 3px 0px rgba(0,0,0,0.15);
	}

	html {
		position: relative;
		min-height: 100%;
	}
	body {
		/* Margin bottom by footer height */
		margin-bottom: 60px;
	}

	.footer {
		position: absolute;
		bottom: 10px;
		width: 100%;
		/* Set the fixed height of the footer here */
		height: 20px;
		text-align: center;
		background-color: #f5f5f5;
	}


</style> 

<?php  
// include('helperdb_connect.php'); 
?>

</head>
<body>

	<!-- Loading image div start -->
	<div id='loading' style='background-color:rgba(211, 211, 211, 0.5); position: absolute; width: 100%; height: 100%; z-index: 10000;' hidden>
		<img src="assets/loading.gif" alt="Loading" style="width:300px; height:300px; position: absolute; top: 20%; left:40%;">
	</div>
	<!-- Loading image div end -->

	<!-- Header Start -->
	<div class="container-fluid">
		<div class="jumbotron" align='center'>
			<h2><strong>COMP 4754 - Project</strong></h2>
			<h4>Fall 2017</h4>
			<h5><strong>Haris Khan</strong></h5>
		</div>
	</div>
	<!-- Header End -->

	<div class="container">
		<h4>Database Schema</h4>
		<strong>Suppliers </strong>(<u>sid: integer</u>, sname: string, address: string)
		<br>
		<strong>Parts </strong>(<u>pid: integer</u>, pname: string, color: string)
		<br>
		<strong>Catalog </strong>(<u>sid: integer</u>, <u>pid: integer</u>, <u>cost: real</u>)
		<br>
	</div>

	<br>

	<!-- Q2 Part A ____ Start -->
	<div class="container">
		<form role="form" id='aSearchForm' action="aResult.php" method="get" class="form-horizontal">
			<h3>Q2 a)</h3>
			<p>Please enter the part name that you would like to search for, also select the checkboxes of things you would like to know about that part.</p>
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
					<div class="input-group" style="margin-top: 18px">
						<span class="input-group-addon">Part Name</span>
						<input type="text" class="form-control" placeholder="Part Name" name="pname" tabindex="1">
					</div>
				</div>
				<div class="col-xs-8 col-sm-6 col-md-4 col-lg-3">
					<strong>Supplier Information Required</strong>
					<br>
					<label class="checkbox-inline">
						<input type="checkbox" name="sid" checked tabindex="2"> ID
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" name="sname" checked tabindex="3"> Name
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" name="address" checked tabindex="4"> Address
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" name="cost" checked tabindex="5"> Cost
					</label>
				</div>
				<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1" style="margin-top: 18px">
					<button id="aSearch" class="btn btn-success" tabindex="6">Search</button>
				</div>
			</div>
		</form>
		<br>
		<div class="row">
			<!-- <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6"> -->
				<div id="aResultContainer"></div>
			<!-- </div> -->
		</div>
	</div>
	<!-- Q2 Part A ____ End -->

	<!-- Q2 Part B ____ Start -->
	<div class="container">
		<form role="form" id='bSearchForm' action="bResult.php" method="get" class="form-horizontal">
			<h3>Q2 b)</h3>
			<p>Please enter the cost and all the suppliers who supply at this cost or more names will pop up.</p>
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
					<div class="input-group" style="margin-top: 18px">
						<span class="input-group-addon">Cost</span>
						<input type="number" class="form-control" placeholder="Cost" name="cost" tabindex="7">
					</div>
				</div>
				<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1" style="margin-top: 18px">
					<button id="bSearch" class="btn btn-success" tabindex="8">Search</button>
				</div>
			</div>
		</form>
		<br>
		<div class="row">
			 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"> 
				<div id="bResultContainer"></div>
			 </div> 
		</div>
	</div>
	<!-- Q2 Part B ____ End -->

	<!-- Q2 Part C ____ Start -->
	<div class="container">
		<form role="form" id='cSearchForm' action="cResult.php" method="get" class="form-horizontal">
			<h3>Q2 c)</h3>
			<p>Please enter the part ID you are searching for, and the names and the addresses for the suppliers who charge the most that part will pop up.</p>
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
					<div class="input-group" style="margin-top: 18px">
						<span class="input-group-addon">Part ID</span>
						<input type="text" class="form-control" placeholder="Part ID" name="pid" tabindex="9">
					</div>
				</div>
				<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1" style="margin-top: 18px">
					<button id="cSearch" class="btn btn-success" tabindex="10">Search</button>
				</div>
			</div>
		</form>
		<br>
		<div class="row">
			 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-5"> 
				<div id="cResultContainer"></div>
			 </div> 
		</div>
	</div>
	<!-- Q2 Part C ____ End -->

	<!-- Q2 Part D ____ Start -->
	<div class="container">
		<form role="form" id='dSearchForm' action="dResult.php" method="get" class="form-horizontal">
			<h3>Q2 d)</h3>
			<p>Please enter the color and the address that you are searching for, and the names of the parts with that color which were supplied by all the suppliers in the entered address will pop up.</p>
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
					<div class="input-group" style="margin-top: 18px">
						<span class="input-group-addon">Color</span>
						<input type="text" class="form-control" placeholder="Color" name="color" tabindex="11">
					</div>
				</div>
				<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
					<div class="input-group" style="margin-top: 18px">
						<span class="input-group-addon">Address</span>
						<input type="text" class="form-control" placeholder="Address" name="address" tabindex="12">
					</div>
				</div>
				<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1" style="margin-top: 18px">
					<button id="dSearch" class="btn btn-success" tabindex="13">Search</button>
				</div>
			</div>
		</form>
		<br>
		<div class="row">
			 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"> 
				<div id="dResultContainer"></div>
			 </div> 
		</div>
	</div>
	<!-- Q2 Part D ____ End -->

	<!-- Q2 Part E ____ Start -->
	<div class="container">
		<form role="form" id='eSearchForm' action="eResult.php" method="get" class="form-horizontal">
			<h3>Q2 e)</h3>
			<p>Please enter the address that you are searching for, and the ids and the names of suppliers with that address who do not supply any parts will pop up.</p>
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4 col-lg-3">
					<div class="input-group" style="margin-top: 18px">
						<span class="input-group-addon">Address</span>
						<input type="text" class="form-control" placeholder="Address" name="address" tabindex="14">
					</div>
				</div>
				<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1" style="margin-top: 18px">
					<button id="eSearch" class="btn btn-success" tabindex="15">Search</button>
				</div>
			</div>
		</form>
		<br>
		<div class="row">
			 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"> 
				<div id="eResultContainer"></div>
			 </div> 
		</div>
	</div>
	<!-- Q2 Part E ____ End -->

	<!-- Footer Start -->
	<footer class="footer">
		<div class="container">
			<span class="text-muted pull-left">Website by <a href='https://www.linkedin.com/in/harisbarki' style='text-decoration: none'>Haris Barki</a></span>
			<span class='text-muted pull-right'>COMP 4754 - Fall 2017</span>
		</div>
	</footer>
	<!-- Footer End -->


	<script type="text/javascript">

		// 2a search function
		$("#aSearch").click(function(event) {
			event.preventDefault();
			getResults("aResultContainer", "aSearchForm", "aResult");
		});

		// 2b search function
		$("#bSearch").click(function(event) {
			event.preventDefault();
			getResults("bResultContainer", "bSearchForm", "bResult");
		});

		// 2c search function
		$("#cSearch").click(function(event) {
			event.preventDefault();
			getResults("cResultContainer", "cSearchForm", "cResult");
		});

		// 2d search function
		$("#dSearch").click(function(event) {
			event.preventDefault();
			getResults("dResultContainer", "dSearchForm", "dResult");
		});

		// 2e search function
		$("#eSearch").click(function(event) {
			event.preventDefault();
			getResults("eResultContainer", "eSearchForm", "eResult");			
		});
		
		// Function to retreive the data from the query
		var getResults = function(containerName, formName, fileName) {
			$("#" + containerName).hide();
			$("#loading").show();
			var data = $('#' + formName).serialize();
			console.log('data', data);
			$.get("helper-files/" + fileName + ".php", data).done(function(resp){
				$("#loading").hide();
				$("#" + containerName).html(resp).fadeIn();
			});
		}

</script>

</body>
</html>