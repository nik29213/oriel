<?php
	$dbh = "sql112.unaux.com";
	$dbu = "unaux_20873583";
	$dbp = "nvhd4djcn3t3n";
	$con = @mysqli_connect( $dbh, $dbu, $dbp ) or die("Unable to connect");
	@mysqli_select_db( $con, "unaux_20873583_orieldb" );
	@mysqli_query( $con, "set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';" );
?>
