<?php
	//header untuk format xml , jika dihilangkan maka akan terbentuk data string
	header('Content_type : text/xml; charset=ISO-8859-1');
	include "koneksi.php";
	
	//check for the path elements
	/* iki sing salah/error
	$path = $_SERVER['PATH_INFO'];
	if ($path != null){
		$path_params= explode("/", $path);
	}
	*/
	$path_params = array();
	$self = $_SERVER['PHP_SELF'];
	$extension = substr($self, strlen($self)-3);
	$path = ($extension=='php') ? NULL : $_SERVER['PATH_INFO'];

	if ($path != NULL) {
	  $path_params = explode("/", $path);
	}
	//metode request untuk GET
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		if ($path_params != null){
			$query = "select
				nim,
				nama,
				alamat,
				prodi
				from mahasiswa where nim= $path_params[1]";
		}else{
			$query = "select
				nim,
				nama,
				alamat,
				prodi
				from mahasiswa";
		}
		$result = mysql_query($query) or die ('Query failed: '. mysql_error());
		
		echo "<data>";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)){
			echo "<mahasiswa>";
			foreach ($line as $key => $col_value) {
				echo "<$key>$col_value </$key>";
			}
			echo "</mahasiswa><br>";
		}
		echo "</data>";
		mysql_free_result($result);
		}
	//metode request untuk delete	
	mysql_close($link);

?>