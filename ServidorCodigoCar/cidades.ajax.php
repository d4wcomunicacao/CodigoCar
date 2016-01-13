<?php
	$username="codigocar1";
	$password="sao06paulo";
	$database="codigocar1";
	$url = "sqlserver01.codigocar1.hospedagemdesites.ws";
	
	$ordem = $_REQUEST["ordem"];
	$datosUsuario = $_REQUEST["datosUsuario"];
	$status = $_REQUEST["status"];
	
	$conninfo = array("Database" => $database, "UID" => $username, "PWD" => $password, "CharacterSet" => "UTF-8");
	$servidor = sqlsrv_connect($url, $conninfo) or die("Não foi possível a conexão com o servidor!");

	$params = array();
	$options =array("Scrollable" => SQLSRV_CURSOR_KEYSET);

	
	$cod_estados = $_REQUEST['estado'];

	$cidades = array();

	$consulta = "SELECT cod_cidade, cidade FROM cidades WHERE estado='".$cod_estados."' ORDER BY cidade";
	//echo "consulta: " . $consulta . "<br>";
	//echo "servidor: " . $servidor . "<br>";
	//echo "params: " . $params . "<br>";
	//echo "options: " . $options . "<br>";
	$sql = sqlsrv_query($servidor, $consulta, $params, $options);
	//echo "sql: " . $sql . "<br>";
	//die();
	while($obj = sqlsrv_fetch_object($sql)){
		$cidades[] = array(
			'cod_cidades'	=> $obj->cod_cidade,
			'nome'			=> $obj -> cidade,
		);
	}

	echo( json_encode( $cidades ) );