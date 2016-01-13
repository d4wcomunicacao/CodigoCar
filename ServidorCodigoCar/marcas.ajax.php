<?php
	$username="codigocar1";
	$password="sao06paulo";
	$database="codigocar1";
	$url = "sqlserver01.codigocar1.hospedagemdesites.ws";
	
	$conninfo = array("Database" => $database, "UID" => $username, "PWD" => $password, "CharacterSet" => "UTF-8");
	$servidor = sqlsrv_connect($url, $conninfo) or die("Não foi possível a conexão com o servidor!");

	$params = array();
	$options =array("Scrollable" => SQLSRV_CURSOR_KEYSET);

	$marcas = array();

	$consulta = "SELECT cod, marca FROM marcas ORDER BY marca";
	//echo "consulta: " . $consulta . "<br>";
	//echo "servidor: " . $servidor . "<br>";
	//echo "params: " . $params . "<br>";
	//echo "options: " . $options . "<br>";
	$sql = sqlsrv_query($servidor, $consulta, $params, $options);
	//echo "sql: " . $sql . "<br>";
	//die();
	while($obj = sqlsrv_fetch_object($sql)){
		$marcas[] = array(
			'cod'	=> $obj->cod,
			'marca'	=> $obj -> marca,
		);
	}

	echo( json_encode( $marcas ) );