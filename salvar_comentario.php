<?php
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $novoComentario = $_POST["comentario"];

    $atualizarComentario = "UPDATE diario SET comentario='$novoComentario' WHERE id='$id'";
    $resultado = mysqli_query($conn, $atualizarComentario);

    if ($resultado) {
        echo "Comentário atualizado com sucesso!";
           echo '<meta http-equiv="refresh" content="2; url=trading_history.php">';
    } else {
        echo "Erro ao atualizar o comentário: " . mysqli_error($conn);
    }
}
?>
