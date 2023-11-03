<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbn  = 'adsi1323395';
	$conn = mysqli_connect($host, $user, $pass, $dbn);

	if (mysqli_connect_errno()) {
		//echo "Error al conectar a MYSQL:".mysqli_connect_error();
		$statusConn = false;
	} else {
		//echo "Se ha conectado a MYSQL";
		$statusConn = true;
	}

?>