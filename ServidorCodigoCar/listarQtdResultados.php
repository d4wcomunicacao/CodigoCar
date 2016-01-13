<?php
header("Access-Control-Allow-Origin: *");
//Generar Respuesta JSON con PHP y MySQL

	//Se genera la Conexion a la base de datos MysQL
 
		
		$username="codigocar1";
		$password="sao06paulo";
		$database="codigocar1";
		$url = "sqlserver01.codigocar1.hospedagemdesites.ws";

		$cod = $_REQUEST["cod"];
	
		$marca 			= $_GET['marca'];
		$modelo 		= $_GET['modelo'];
		$ano_de 		= $_GET['ano_de'];
		$ano_ate 		= $_GET['ano_ate'];
		$preco_de 		= $_GET['preco_de'];
		$preco_ate 		= $_GET['preco_ate'];
		$cidade_estado 	= $_GET['cidade_estado'];
		
		$conninfo = array("Database" => $database, "UID" => $username, "PWD" => $password, "CharacterSet" => "UTF-8");
		$servidor = sqlsrv_connect($url, $conninfo) or die("Não foi possível a conexão com o servidor!");

		
		//1_Se elige el formato de datos para lla conexion UTF8
			//Se prepara la peticion

			//2_Se establece la consulta a la BD
			$params = array();
			$options =array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		
			$consulta = "SELECT count(codprod) as total FROM veiculos WHERE 1 = 1";
			if($marca != ""){
				$consulta .= " and marca = '".$marca."'";
			}
			if($modelo != "" && $modelo != "null"){
				$consulta .= " and modelo1 = '".$modelo."'";
			}
			if($ano_de != ""){
				$consulta .= " and ano >= '".$ano_de."'";
			}
			if($ano_ate != ""){
				$consulta .= " and ano <= '".$ano_ate."'";
			}
			if($preco_de != ""){
				$consulta .= " and preco >= ".$preco_de."";
			}
			if($preco_ate != ""){
				$consulta .= " and preco <= ".$preco_ate."";
			}
			if($estado != ""){
				$consulta .= " and estado = '".$estado."'";
			}
			if($cidade != ""){
				$consulta .= " and cidade = '".$cidade."'";
			}
			//echo "sql: ".$consulta;
			//die();
			$sql = sqlsrv_query($servidor, $consulta, $params, $options);

			//3_Se declara un arreglo
			$datos= array();
			
						//SE genera el archivo JSON
			while ($obj = sqlsrv_fetch_object($sql)) {
				//echo 'foi';
				$datos[] = array('total' => $obj->total,
					);
			}
			
			echo '' . json_encode($datos) . '';
			
			sqlsrv_close($servidor);//Se cierra la conexion
			
			//Se declara que esta es una aplicacion que genera un JSON
//			header('Content-type: application/json');
//			//Se abre el acceso a las conexiones que requieran de esta aplicacion
//			header("Access-Control-Allow-Origin: *");


?>