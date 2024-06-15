<?php 

include_once("connection.php");
   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

$respostas="SELECT * FROM tabela WHERE DATE(data_hora_finale) = CURDATE()";
$res = mysqli_query($conexao,$respostas);

if (mysqli_num_rows($res) > 0) {
    
 
    
    require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
    
    $mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.office365.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'TLS'; // ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->CharSet = "UTF-8";
    $mail->Username = 'ufficio.manutenzione@outlook.com';                 // SMTP username
    $mail->Password = 'Toro#2020';                           // SMTP password
    $mail->setFrom('ufficio.manutenzione@outlook.com', 'Manutenzione');
    
    $mail->addAddress('bcasavilca@yahoo.com', 'Bruno'); 
    $mail->AddAddress('gb.busi@gmail.com', 'Giamba');
    $mail->Subject = 'Rapporto giornalero';
    
    
    
       
    $datas = array();
    if (mysqli_num_rows($res) > 0) {
        while($row = mysqli_fetch_assoc($res)){
            $datas[] = $row;
        }
    }
    $body = '<p><b>Registro di Intervento</b></p>';
    $body .= '<hr size=1 noshade>';      
    
    
    

/*// Executa a consulta SQL
$sql = "SELECT chave, manutenzione, id, risultato_finale FROM tabela WHERE risultato_finale = 'Non riparato - Servizo aperto'";
$result = $conexao->query($sql);

// Exibe a tabela com os ícones
if ($result->num_rows > 0) {
        $body .= '<table style="width:350px">';
    while($row_res = $result->fetch_assoc()) {
        $body .= '<tr>';
     
        if ($row_res['risultato_finale'] == 'Non riparato - Servizo aperto') {
            // Ícone de atenção amarelo
        $body .= '<td><span class="icon"><i class="fa fa-exclamation-triangle" style="color:red"></i></span></td>';
        } else {
            // Ícone de check verde
        $body .= '<td><span class="icon"><i class="fa fa-check" style="color:green"></i></span></td>';
        }
        
        // Exibe o resultado e o ID
        $body .= '<td>' . $row_res['chave'] . '#row-' . $row_res['chave'] . '"> Servizo Aperto, Girasole ' . $row_res['id'] . ' Tipo ' .$row_res['manutenzione']. ' </td>';
     
        
        
     $body .= '</tr>';
    }
     $body .= '</table>';
} else {
     $body .= '<span class="icon"><i class="fa fa-check" style="color:green"></i></span>';
     $body .= ' Tutti i girasoli seguono il sole</br>';
     $body .= '</br>';
}*/

    
    
    
    foreach ($datas as $data){
    $dataFormatada = date('d-m-Y', strtotime($data['data_hora']));
    $dataFinaleFormatada = date('d-m-Y', strtotime($data['data_hora_finale']));
      $body .= '<tr>'; 
      $body .= '<table style="border:1px solid black;width:300px; white-space: pre-line; align:center;" >';
      $body .= '<tr>'; 
      $body .= '<td style="border:1px solid black"> Girassole:  </td> ';
      $body .= '<td style="border:1px solid black" >'.$data['id'].'</td></br>  '; 
      $body .= '</tr>'; 
      
    $body .= '<tr>';
    $body .= '<td style="border:1px solid black"> Data:  </td> ';
    $body .= '<td style="border:1px solid black">'.$dataFormatada.'</td></br>  '; 
    $body .= '</tr > ';
      
      $body .= '<tr > ';
      $body .= '<td style="border:1px solid black"> Descrizione del problema:  </td> ';
      $body .= '<td style="border:1px solid black" >'.$data['problema'].'</td></br>  '; 
      $body .= '</tr > ';
      
      $body .= '<tr > ';
      $body .= '<td style="border:1px solid black"> tipo manutenzione:  </td> ';
      $body .= '<td style="border:1px solid black" >'.$data['manutenzione'].'</td></br>  '; 
      $body .= '</tr > ';
      
      $body .= '<tr > ';
      $body .= '<td style="border:1px solid black"> Descrizione del lavoro:   </td> ';
      $body .= '<td style="border:1px solid black" >'.$data['solucao'].'</td></br>  '; 
      $body .= '</tr > ';
      
      $body .= '<tr > ';
    $body .= '<td style="border:1px solid black"> Data finale:   </td> ';
    $body .= '<td style="border:1px solid black" >'.$dataFinaleFormatada.'</td></br>  '; 
    $body .= '</tr > ';
      
      $body .= '<tr > ';
      $body .= '<td style="border:1px solid black"> Conclusione:  </td> ';
      $body .= '<td style="border:1px solid black" >'.$data['risultato_finale'].'</td></br>  '; 
      $body .= '</tr > ';
      $body .= '</table > </br>';  
    }
    $body .= '</br></br>';
    $body .= '<hr size=1 noshade>';      
    $body .= '<p style="font-size:11px;"><i>Questo è un riepilogo, altre informazioni sono registrate in <a href="https://spirano-it.000webhostapp.com/historic.php">spirano-it.000webhostapp.com/historic.php</a></i></p>';
    $mail->Body = $body;
    $mail->AltBody = 'HTML messaging not supported';
    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
    
    if ($mail->send()) {
        header("Refresh:2; url=index.php");
        echo"<p style='color:green;font-size:50px;'>Email enviato</p>";
    }  else{ 
    echo " Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}else{
     header("Refresh:2; url=index.php");
    echo"<p style='color:green;font-size:50px;'>Email non enviato</p>";
}


//----------------------------------------------------------



?>
