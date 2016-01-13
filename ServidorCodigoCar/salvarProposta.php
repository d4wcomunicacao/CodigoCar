<?php
/*$username="design4web3";
$password="cobol1122";
$database="design4web3";
$url = "mysql04.d4w.com.br";
*/
$username="codigocar1";
$password="sao06paulo";
$database="codigocar1";
$url = "sqlserver01.codigocar1.hospedagemdesites.ws";
 
$nome 				= $_REQUEST['nome'];
$email 				= $_REQUEST['email'];
$celular 			= $_REQUEST['celular'];
$mensagem 			= $_REQUEST['mensagem'];
$quero_financiar 	= $_REQUEST['quero_financiar'];
$quero_veiculo 		= $_REQUEST['quero_veiculo'];
$codprod	 		= $_REQUEST['codprod'];
 
/*mysql_connect($url,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");*/
$options = array("Database" => $database, "UID" => $username, "PWD" => $password);
$sqlsrv_conn = sqlsrv_connect($url, $options) or die("Não foi possível a conexão com o servidor!");

//$data = date('Y-m-d');
$data = date('m-d-Y h:i:s');
 
$query = "insert into geral_proposta (nome, email, telefone, proposta, quero_financiar, quero_veiculo, veiculo) values ('$nome','$email','$celular','$mensagem','$quero_financiar', '$quero_veiculo', '$codprod')"; 
echo "sql: ".$query."<br>";
/*mysql_query($query);*/
sqlsrv_query($sqlsrv_conn, $query);

// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "From: contato@codigocar.com.br\r\n"; // remetente

$conteudo = "";
$conteudo .= "Olá ".$nome.",";
$conteudo .= "\r\n \r\n";
$conteudo .= "Este é um e-mail de 'PROPOSTA' enviado através do site.";
$conteudo .= "\r\n \r\n";
$conteudo .= "O seguinte visitante \r\n";
$conteudo .= "--------------------";
$conteudo .= "\r\nNome        :";
$conteudo .= $nome;
$conteudo .= "\r\nEmail       :" ;
$conteudo .= $email;
$conteudo .= "\r\nTelefone    :" ;
$conteudo .= $celular;
if($financiar <> ""){
	$conteudo .= "\r\nO visitante deseja financiar o ve&iacute;culo";
}
if($trocar <> ""){
	$conteudo .= "\r\nO visitante deseja realizar uma troca";
}
$conteudo .= "\r\nMensagem    :" ;
$conteudo .= $mensagem;

$envio = mail("alexandre@d4w.com.br", "PROPOSTA - CÓDIGO CAR", $conteudo, $headers);
 
if($envio)
 echo "Mensagem enviada com sucesso";
else
 echo "A mensagem não pode ser enviada";

//die();
 
/*mysql_close();*/
//sqlsrv_close();

//echo "You successfully added your Coupon";  
?>