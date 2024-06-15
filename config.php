<?php
$servername = "localhost";
$username = "id20124781_tabela";
$password = "$8Mariaebruno";
$dbname = "id20124781_cadastro";


// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);




// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

