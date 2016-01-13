<?php	

/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */

/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

$marca 			= $_GET['marca'];
$modelo 		= $_GET['modelo'];
$ano_de 		= $_GET['ano_de'];
$ano_ate 		= $_GET['ano_ate'];
$preco_de 		= $_GET['preco_de'];
$preco_ate 		= $_GET['preco_ate'];
$cidade_estado 	= $_GET['cidade_estado'];

/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$resultados = array();
$resultados["hora"] = date("F j, Y, g:i a"); 
$resultados["generador"] = "Enviado desde revolucion.mobi" ;

$username="codigocar1";
$password="sao06paulo";
$database="codigocar1";
$url = "sqlserver01.codigocar1.hospedagemdesites.ws";

$conninfo = array("Database" => $database, "UID" => $username, "PWD" => $password);
$sqlsrv_conn = sqlsrv_connect($url, $conninfo) or die("Não foi possível a conexão com o servidor!");

$sql = "SELECT * FROM veiculos WHERE 1 = 1";
if($marca != ""){
	$sql .= " and marca = '".$marca."'";
}
if($modelo != "" && $modelo != "null"){
	$sql .= " and modelo1 = '".$modelo."'";
}
if($ano_de != ""){
	$sql .= " and ano >= '".$ano_de."'";
}
if($ano_ate != ""){
	$sql .= " and ano <= '".$ano_ate."'";
}
if($preco_de != ""){
	$sql .= " and preco >= ".$preco_de."";
}
if($preco_ate != ""){
	$sql .= " and preco <= ".$preco_ate."";
}
if($estado != ""){
	$sql .= " and estado = '".$estado."'";
}
if($cidade != ""){
	$sql .= " and cidade = '".$cidade."'";
}
//echo $sql . "<br>";
$params = array();
$options =array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$result = sqlsrv_query($sqlsrv_conn, $sql, $params, $options);
$numRegistros = sqlsrv_num_rows($result);
$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

/* verifica que el usuario y password concuerden correctamente */
if($numRegistros != 0){
	/*esta informacion se envia solo si la validacion es correcta */
	$resultados["mensaje"] = "Validacion Correcta";
	$resultados["validacion"] = "ok";

}else{
	/*esta informacion se envia si la validacion falla */
	$resultados["mensaje"] = "Usuario y password incorrectos";
	$resultados["validacion"] = "error";
}


/*convierte los resultados a formato json*/
$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
die();
?>