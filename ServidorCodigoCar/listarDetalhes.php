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
		
			$consulta = "SELECT * FROM veiculos where codigo='".$cod."' or codprod=".$cod."";
			//echo "sql: ".$consulta;
			//die();
			$sql = sqlsrv_query($servidor, $consulta, $params, $options);

			//3_Se declara un arreglo
			$datos= array();
			
						//SE genera el archivo JSON
			while ($obj = sqlsrv_fetch_object($sql)) {
				//echo 'foi';
				//echo $obj->foto . "<br>";
				if($obj->foto != "" && $obj->foto != NULL){
					$datos[] = array('codprod' => $obj->codprod,
								   'modelo' => strtoupper($obj->modelo1),
								   'marca' => strtoupper($obj->marca),
								   'ano' => $obj->ano,
								   'preco' => $obj->preco,
								   'combustivel' => $obj->combustivel,
								   'motor' => $obj->motor,
								   'foto' => $obj->foto,
								   'foto2' => $obj->foto2,
								   'foto3' => $obj->foto3,
								   'foto4' => $obj->foto4,
								   'cor' => $obj->cor,
								   'cliente' => $obj->nome,
								   'km' => $obj->km,
								   'portas' => $obj->portas,
								   'placa' => $obj->placa,
								   'obs' => $obj->obs,
								   'codigo' => $obj->codigo,
								   'freio' => $obj->freio,
								   'dh' => $obj->dh,
								   'datacad' => $obj->datacad,
								   'cambio' => $obj->cambio,
								   'tipo_pessoa' => $obj->tipo_pessoa,
					);
				}
				else{
					$datos[] = array('codprod' => $obj->codprod,
								   'modelo' => strtoupper($obj->modelo1),
								   'marca' => strtoupper($obj->marca),
								   'ano' => $obj->ano,
								   'preco' => $obj->preco,
								   'combustivel' => $obj->combustivel,
								   'motor' => $obj->motor,
								   'foto' => 'sem-foto.jpg',
								   'cor' => $obj->cor,
								   'cliente' => $obj->nome,
								   'km' => $obj->km,
								   'portas' => $obj->portas,
								   'placa' => $obj->placa,
								   'obs' => $obj->obs,
								   'codigo' => $obj->codigo,
								   'freio' => $obj->freio,
								   'dh' => $obj->dh,
								   'datacad' => $obj->datacad,
								   'cambio' => $obj->cambio,
								   'tipo_pessoa' => $obj->tipo_pessoa,
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