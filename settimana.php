<?php

include_once("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$respostas="SELECT * FROM tabela WHERE WEEK(data_hora_finale) = WEEK(CURDATE())";
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
    //$mail->AddAddress('gb.busi@gmail.com', 'Giamba');
    $mail->Subject = 'Rapporto giornalero';
    $datas = array();
    if (mysqli_num_rows($res) > 0) {
        while($row = mysqli_fetch_assoc($res)){
            $datas[] = $row;
        }
    }

    // Build email body
    $body = '<p>Registro di Intervento</p>';
    $body .= '<hr size="1" noshade>';
    foreach ($datas as $data) {
    $dataFormatada = date('d-m-Y', strtotime($data['data_hora']));
    $dataFinaleFormatada = date('d-m-Y', strtotime($data['data_hora_finale']));
    $body .= '<table style="border: 1px solid black; width: 100%;">';
    $body .= '<tr>'; 
    $body .= '<td class="cabecalho">Girassole:</td>';
    $body .= '<td class="preencher">'.$data['id'].'</td>';
    $body .= '</tr>'; 
    $body .= '<tr>';
    $body .= '<td class="cabecalho">Data:</td>';
    $body .= '<td class="preencher">'.$dataFormatada.'</td>';
    $body .= '</tr>';
    $body .= '<tr > ';
    $body .= '<td> tipo manutenzione:  </td> ';
    $body .= '<td>'.$data['manutenzione'].'</td></br>  '; 
    $body .= '</tr > ';
    $body .= '<tr > ';
    $body .= '<td> Descrizione del problema:  </td> ';
    $body .= '<td>'.$data['problema'].'</td></br>  '; 
    $body .= '</tr > ';
    $body .= '<tr > ';
    $body .= '<td> Conclusione:  </td> ';
    $body .= '<td>'.$data['risultato_finale'].'</td></br>  '; 
    $body .= '</tr > ';
    $body .= '</table>';
    $body .= '<br>';
}


    $body .= '</br></br>';
    $body .= '<hr size=1 noshade>';      
    $body .= '<p style="font-size:11px;"><i>Riepilogo generato automaticamente per <a href="https://spirano-it.000webhostapp.com/historic.php">spirano-it.000webhostapp.com/historic.php</a></i></p>';
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

?>
