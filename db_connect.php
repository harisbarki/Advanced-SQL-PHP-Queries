<?php

/* Connect to database (url, username, password, database) */
$mysqli = new mysqli("mysql.cs.mun.ca", "cs4754_hmk412", "OWFlYTMx", "cs4754_hmk412");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
