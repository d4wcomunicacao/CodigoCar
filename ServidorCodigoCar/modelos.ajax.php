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
	$marca = $_REQUEST['marca'];

	$consulta = "SELECT A.cod, A.modelo FROM modelos A inner join marcas B on B.cod = A.marca where B.marca='".$marca."' ORDER BY modelo";
	//echo "consulta: " . $consulta . "<br>";
	//echo "servidor: " . $servidor . "<br>";
	//echo "params: " . $params . "<br>";
	//echo "options: " . $options . "<br>";
	$sql = sqlsrv_query($servidor, $consulta, $params, $options);
	//echo "consulta: " . $consulta . "<br>";
	//die();
	while($obj = sqlsrv_fetch_object($sql)){
		$marcas[] = array(
			'cod'	=> $obj->cod,
			'modelo'	=> $obj -> modelo,
		);
	}

	echo( json_encode( $marcas ) );