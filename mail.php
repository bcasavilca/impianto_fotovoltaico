<?php
include_once("connection.php");
if (isset($_POST['submit'])) {
    // Obtenha os valores do formulário
    $data_hora = $_POST['data_hora'];
    $id = $_POST['id'];
    $status = $_POST['status'];
    $actual_TL = $_POST['actual_TL'];
    $actual_AZ = $_POST['actual_AZ'];
    $setpoint_TL = $_POST['setpoint_TL'];
    $setpoint_AZ = $_POST['setpoint_AZ'];
    
    if (isset($_POST["problema"]) && is_array($_POST["problema"])) {
        $problemas = $_POST["problema"];
        $problemas_texto = ""; // Inicializa a string vazia

        // Converte os valores dos checkboxes em texto com bullets e quebra de linha
        foreach ($problemas as $problema) {
            $problemas_texto .= "• " . $problema . "\n"; // Use .= para concatenar os valores
        }
    }
    
    $asse = $_POST['asse'];
    $manutenzione = $_POST['manutenzione'];
    $solucao = $_POST['solucao'];
    $risultato_finale = $_POST['risultato_finale'];
    $data_hora_finale = $_POST['data_hora_finale'];
    
    if (isset($_FILES['image']) && !empty($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        if (!$_FILES['image']['size'] == 0) {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'upload/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path); 
        } else {
            $img_upload_path = "";
        }
    }   
    // Insira no banco de dados
    $sql = "INSERT INTO tabela(data_hora, id, status, actual_TL, actual_AZ, setpoint_TL, setpoint_AZ, problema, asse, manutenzione, solucao, image, risultato_finale, data_hora_finale) VALUES ('$data_hora', '$id', '$status',  '$actual_TL', '$actual_AZ', '$setpoint_TL', '$setpoint_AZ', '$problemas_texto', '$asse', '$manutenzione', '$solucao', '$img_upload_path', '$risultato_finale', '$data_hora_finale')";
    if (!mysqli_query($conexao, $sql)) {
        echo("Error description: " . mysqli_error($conexao));
    } else {
        header("Refresh:2; url=index.php");
        echo "<p style='color:green;font-size:50px;'>Registrazione com succeso</p>";
    }
    mysqli_close($conexao);
}
?>
