<?php
header("Access-Control-Allow-Origin: *");
//Generar Respuesta JSON con PHP y MySQL

	//Se genera la Conexion a la base de datos MysQL
 
		
		$username="codigocar1";
		$password="sao06paulo";
		$database="codigocar1";
		$url = "sqlserver01.codigocar1.hospedagemdesites.ws";

		$cod = $_REQUEST["cod"];
		
		$conninfo = array("Database" => $database, "UID" => $username, "PWD" => $password, "CharacterSet" => "UTF-8");
		$servidor = sqlsrv_connect($url, $conninfo) or die("Não foi possível a conexão com o servidor!");

		
		//1_Se elige el formato de datos para lla conexion UTF8
			//Se prepara la peticion

			//2_Se establece la consulta a la BD
			$params = array();
			$options =array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		
			$consulta = "SELECT * FROM opcionaisXdescricao where codigo='".$cod."' or codprod=".$cod."";
			//echo "sql: ".$consulta;
			//die();
			$sql = sqlsrv_query($servidor, $consulta, $params, $options);
			
			$row_count = sqlsrv_num_rows( $sql );

			//3_Se declara un arreglo
			$datos = array();
			
						//SE genera el archivo JSON
			$i = 0;
			while ($obj = sqlsrv_fetch_object($sql)) {
				//echo 'foi';
				$i = $i + 1;
				if($i != $row_count){
					$datos[] = array(
						'opcional' => $obj->opcional.",&nbsp;",
					);
				}
				else{
					$datos[] = array(
						'opcional' => $obj->opcional.".",
					);
				}
			}
			
			echo '' . json_encode($datos) . '';
			
			sqlsrv_close($servidor);//Se cierra la conexion
			
			//Se declara que esta es una aplicacion que genera un JSON
			header('Content-type: application/json');
			//Se abre el acceso a las conexiones que requieran de esta aplicacion
			header("Access-Control-Allow-Origin: *");


?>