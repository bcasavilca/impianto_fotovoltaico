<?php
// Conexão com o banco de dados
$Servidor="localhost";
$Usuario="id20124781_tabela";
$Senha="$8Mariaebruno";
$banco="id20124781_cadastro";

$conexao=mysqli_connect($Servidor,$Usuario,$Senha,$banco);

// Verificar a conexão
if (!$conexao) {
	die("Falha na conexão: " . mysqli_connect_error());
}

// Obter informações do formulário
$solucao = POST['solucao'];

// Inserir as informações no banco de dados
$sql = "UPDATE tabela SET solucao='$solucao' WHERE chave=$chave";
if (mysqli_query($conexao, $sql)) {
	echo "Item adicionado com sucesso.";
} else {
	echo "Erro ao adicionar item: " . mysqli_error($conexao);
}

// Fechar conexão com o banco de dados
mysqli_close($conexao);
?>
