<?php
$Servidor="localhost";
$Usuario="id20124781_tabela";
$Senha="$8Mariaebruno";
$banco="id20124781_cadastro";

$conexao=mysqli_connect($Servidor,$Usuario,$Senha,$banco);
if(!$conexao){
die("not connected a database");

}

?>
