<?php 

include_once("connection.php");
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
$mail->Username = 'ufficio.manutenzione@outlook.com';                 // SMTP username
$mail->Password = 'Toro#2020';                           // SMTP password
$mail->setFrom('ufficio.manutenzione@outlook.com', 'Manutenzione');
$mail->addAddress('bcasavilca@yahoo.com', 'Bruno'); 
//$mail->AddAddress('gb.busi@gmail.com', 'Giamba');
if (isset($_POST['submit_temporale']))
{
//var do 
 $Azione=$_POST['Azione'];
 $data=$_POST['data'];
 $hora=$_POST['hora'];
 $commenti=$_POST['commenti'];
 
 $re = $_POST['data'];
 $timestamp = strtotime($re);
 $new_date = date("d-m-Y", $timestamp);
 
 

if (isset($_FILES['image']) && empty(!$_FILES['image'])) 
{
 $img_name = $_FILES['image']['name'];
 $tmp_name = $_FILES['image']['tmp_name'];
 $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
 $img_ex_lc = strtolower($img_ex);
  if (!$_FILES['image']['size'] == 0 )
    {
         $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
         $img_upload_path = 'upload/'.$new_img_name;
		 move_uploaded_file($tmp_name, $img_upload_path); 
    
    }else{
          $img_upload_path = "";
         }
}    


 // Insert into Database
 $sql="INSERT INTO gobat(Azione,data,hora,commenti,image) VALUES ('$Azione','$data','$hora','$commenti', '$img_upload_path' )";
		 		            
		    	
if (!mysqli_query($conexao,"INSERT INTO gobat(Azione,data,hora,commenti,image) VALUES ('$Azione','$data','$hora','$commenti', '$img_upload_path' )"))
 
  {
  echo("Error description: ". mysqli_error($conexao));
  }else{ 
  
      echo"<p style='color:green;font-size:50px;'>Registrazione com succeso</p>";
  }


mysqli_close($conexao);
 
 

    
}

$mail->Subject = 'allerta di vento';
    
    
    $body = '<p><b>Spento gobat</b></p>';
    $body .= '<table style="border:1px solid black;width:300px;" > ';
    $body .= '<tr > '; 
    $body .= '<td style="border:1px solid black"> Comando:  </td> ';
    $body .= '<td style="border:1px solid black" >'.$Azione.'</td></br>  '; 
    $body .= '</tr > '; 
      
      $body .= '<tr > ';
    $body .= '<td style="border:1px solid black"> Data:  </td> ';
    $body .= '<td style="border:1px solid black" >'.$data.'</td></br>  '; 
    $body .= '</tr > ';
      
      $body .= '<tr > ';
      $body .= '<td style="border:1px solid black"> Hora:  </td> ';
      $body .= '<td style="border:1px solid black" >'.$hora.'</td></br>  '; 
      $body .= '</tr > ';
      
      $body .= '<tr > ';
      $body .= '<td style="border:1px solid black"> Image:   </td> ';
      $body .= '<td style="border:1px solid black" >'.$img_upload_path.'</td></br>  '; 
      $body .= '</tr > ';
      
       
      $body .= '</table > </br>';  

$mail->Body = $body; 
$mail->AltBody = 'HTML messaging not supported';
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );


 if ($mail->send())
 { 
   echo"<p style='color:green;font-size:50px;'>Email enviato</p>";
   header("Refresh:2; url=index.php"); 
} else{ 
    echo " Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}





 
