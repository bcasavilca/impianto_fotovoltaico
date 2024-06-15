<?php
// Inclui o arquivo de configuração do banco de dados
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conta = $_POST['conta'];
    $data = $_POST['Data'];
    $Ativo = $_POST['Ativo'];
    $comentario = $_POST['comentario'];
    
    // Obtenha os valores do formulário
    $img_upload_path = ""; // Inicializa a variável para garantir que ela esteja definida
    $img_upload_path2 = ""; // Inicializa a variável para a imagem "Fim do trade"
     $img_upload_path3 = "";
    $img_upload_path4 = "";


    if (isset($_FILES['image1']) && $_FILES['image1']['size'] > 0) {
        $img_name1 = $_FILES['image1']['name'];
        $tmp_name1 = $_FILES['image1']['tmp_name'];
        $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
        $img_ex_lc1 = strtolower($img_ex1);
        $new_img_name1 = uniqid("IMG-", true).'.'.$img_ex_lc1;
        $img_upload_path1 = 'upload2/'.$new_img_name1;
        move_uploaded_file($tmp_name1, $img_upload_path1); 
    }
      // Processa a imagem "Fim do trade"
    if (isset($_FILES['image2']) && $_FILES['image2']['size'] > 0) {
        $img_name2 = $_FILES['image2']['name'];
        $tmp_name2 = $_FILES['image2']['tmp_name'];
        $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
        $img_ex_lc2 = strtolower($img_ex2);
        $new_img_name2 = uniqid("IMG-", true).'.'.$img_ex_lc2;
        $img_upload_path2 = 'upload2/'.$new_img_name2;
        move_uploaded_file($tmp_name2, $img_upload_path2);
    }
    
    if (isset($_FILES['image3']) && $_FILES['image3']['size'] > 0) {
        $img_name3 = $_FILES['image3']['name'];
        $img_name3 = $_FILES['image3']['tmp_name'];
        $img_ex3 = pathinfo($img_name3, PATHINFO_EXTENSION);
        $img_ex_lc3 = strtolower($img_ex3);
        $new_img_name3 = uniqid("IMG-", true).'.'.$img_ex_lc3;
        $img_upload_path3 = 'upload2/'.$new_img_name3;
        move_uploaded_file($tmp_name3, $img_upload_pat3);
    }
        if (isset($_FILES['image4']) && $_FILES['image4']['size'] > 0) {
        $img_name4 = $_FILES['image4']['name'];
        $img_name4 = $_FILES['image4']['tmp_name'];
        $img_ex4 = pathinfo($img_name4, PATHINFO_EXTENSION);
        $img_ex_lc4 = strtolower($img_ex4);
        $new_img_name4 = uniqid("IMG-", true).'.'.$img_ex_lc4;
        $img_upload_path4 = 'upload2/'.$new_img_name4;
        move_uploaded_file($tmp_name4, $img_upload_pat4);
    }

    // Insira no banco de dados
       $sql = "INSERT INTO diario (conta,data, Ativo, image1, image2, image3, image4, comentario) VALUES ('$conta','$data', '$Ativo', '$img_upload_path1', '$img_upload_path2', '$img_upload_path3', '$img_upload_path4','$comentario')";

    if ($conn->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso!";
    echo '<meta http-equiv="refresh" content="2; url=trading_jornal.php">';
} else {
    echo "Erro ao inserir dados: " . $conn->error;
}

}
?>
