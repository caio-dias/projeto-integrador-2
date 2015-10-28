<?php
	
	$dbhost = "i9yueekhr9.database.windows.net";
	$db = "lotus";
	$user = "TSI@i9yueekhr9.database.windows.net";
	$password = "SistemasInternet123";
	$dsn = "Driver={SQL Server};Server=$dbhost;Port=1433;Database=$db;";
	               
	$connect = odbc_connect($dsn,$user,$password);

?>
