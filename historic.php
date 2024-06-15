
<?php
include_once("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
    <!-- External libraries -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="path/to/jquery.tabledit.min.js"></script>
</head>
<body>
	<title>manutenzione degli impianto</title>
	
</head>
<body>
   
  <div class="menu" id="topo">
<a href="https://spirano-it.000webhostapp.com/index.php"><button class="intervento" >Intervento</button></a>
<a href="https://spirano-it.000webhostapp.com/historic.php"><button class="storico active">Storico</button></a>
<!--<a href="https://spirano-it.000webhostapp.com/deposito.php"><button class="deposito">Deposito</button></a>-->
  </div>
 <!-- <div class="blue-div">
<form action="" method="get">
    <input type="text" name="query" placeholder="">
    <input type="submit" value="Cerca"><a href="apagar_consulta.php" class="botao-apagar"> cancella</a>
</form>

</div>-->

<div class="conteudo_intervento">
    <div id="modal" style="display:none;">
    <form id="form" method="post">
        <label for="texto">Texto:</label>
        <input type="text" name="texto" id="texto">
        <input type="submit" value="Salvar">
    </form>
</div>
<?php

// Executa a consulta SQL
$sql = "SELECT chave, manutenzione, id, risultato_finale FROM tabela WHERE risultato_finale = 'Non riparato - Servizo aperto'";
$result = $conexao->query($sql);

// Exibe a tabela com os ícones
if ($result->num_rows > 0) {
    echo "<table style='width:350px'>";
    while($row_res = $result->fetch_assoc()) {
        echo "<tr>";
     
        if ($row_res['risultato_finale'] == 'Non riparato - Servizo aperto') {
            // Ícone de atenção amarelo
            echo '<td><span class="icon"><i class="fa fa-exclamation-triangle" style="color:red"></i></span></td>';
        } else {
            // Ícone de check verde
            echo '<td><span class="icon"><i class="fa fa-check" style="color:green"></i></span></td>';
        }
        
        // Exibe o resultado e o ID
       echo '<td><a href="historic.php?id=' . $row_res['chave'] . '#row-' . $row_res['chave'] . '"> Aperto, Girasole: ' . $row_res['id'] . ' Tipo: ' .$row_res['manutenzione']. ' </a></td>';
     
        
        
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo'<span class="icon"><i class="fa fa-check" style="color:green"></i></span>';
    echo " Tutti i girasoli seguono il sole</br>";
    echo "</br>";
}
?>
  
<?php // Crie uma consulta SQL para recuperar os resultados da pesquisa
$query = isset($_GET['query'])? $_GET['query'] : "";
$sql = "SELECT * FROM tabela WHERE id LIKE '$query' ORDER BY chave DESC";
$hide = NULL; 
// Execute a consulta COUNT() para obter o número de resultados
$count_query = "SELECT COUNT(*) as count FROM tabela WHERE id LIKE '$query'";
$count_result = $conexao->query($count_query);
$count_row = $count_result->fetch_assoc();
$num_results = $count_row['count'];

// Exiba o número de resultados e os dados da pesquisa

$result = $conexao->query($sql);
if ($result->num_rows > 0) {
    while($row_res = $result->fetch_assoc()) {
       
echo "<fieldset style='width:300px;'>";  
echo "<table>";       
echo "<tr>";
echo "<td class='cabecalho'>ID</td>";
echo "<td class='preencher'><a href='historic.php?id=" . $row_res['chave'] . "'>" . $row_res['chave'] . "</a></td>";
echo "</tr>";
//--------------------------------------------------
echo "<tr>";
echo "<td class='cabecalho'>Girassole:  </td>";
echo "<td class='preencher'>".$row_res['id']."</td>";
echo "</tr>";
//------------------------------------------------
$re = $row_res['data_hora'];
$timestamp = strtotime($re);
$new_datetime = date("d-m-Y H:i", $timestamp);
echo "<tr>";
echo "<td class='cabecalho'>Data/Ora:  </td>";
echo "<td class='preencher'>".$new_datetime."</td>";
echo "</tr>";
//--------------------------------------------------
    $hide_status = $row_res['status'];
    if($hide_status == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Status:  </td>";
    echo "<td class=preencher>".$hide."</td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho >Status:  </td>";
    echo "<td class=preencher>".$row_res['status']." </td>";
    echo "</tr>";
    }
    
    //----------------------------------------------------
    $hide_comunicazione = $row_res['status'];
    if($hide_comunicazione == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Comunicazione:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho  >Comunicazione: </td>";
    echo "<td class=preencher  >".$row_res['comunicazione']." </td>"; 
    echo "</tr>";
    }
    
    //---------------------------------------------------
    $hide_comando = $row_res['status'];
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Comando:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho >Comando:  </td>";
    echo "<td class=preencher>".$row_res['comando']." </td>";
    echo "</tr>";  
    }
     //----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Comando:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{echo "<tr>";
    echo "<td class=cabecalho>Actual position AZ</td>";
    echo "<td class=preencher>".$row_res['actual_AZ']."</td>";
    echo "</tr>";}
    //----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Comando:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho>Actual position TL</td>";
    echo "<td class=preencher>".$row_res['actual_TL']."</td>";
    echo "</tr>";}
    //----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Comando:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho>Setpoint AZ</td>";
    echo "<td class=preencher>".$row_res['setpoint_AZ']."</td>";
    echo "</tr>";}
    //-----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Comando:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho>Setpoint TL</td>";
    echo "<td class=preencher>".$row_res['setpoint_TL']."</td>";
    echo "</tr>";}
    //-----------------------------------------------------
    echo "<tr>";
    echo "<td colspan=\"2\" class=cabecalho >Problemi:  </td>";
    echo "</tr>";
    //---------------------------------------------------
    echo "<tr>";
    echo "<td class=preencher colspan=\"2\">".$row_res['problema']." </td>";
    echo "</tr>";
    //----------------------------------------------------
    echo "<tr>";
    echo "<td colspan=\"2\" class=cabecalho > Allegato:  </td>";
    echo "</tr>";
    //----------------------------------------------------
     if(empty($row_res['image']))
    {
    echo "<tr>";
    echo "<td class=preencher colspan=\"2\" ></td>";
    echo "</tr>"; 
    }else{
    echo "<tr>";
    echo "<td class=preencher colspan=\"2\" ><a href=".$row_res['image'].">".$row_res['image']."</a></td>";
    echo "</tr>"; 
    }
    //----------------------------------------------------
    echo "<tr>";
    echo "<td colspan=\"2\" class=cabecalho >Descrizione del lavoro: </td>";
    echo "</tr>";
    //----------------------------------------------------
    echo "<tr>";
    echo "<td class=preencher colspan=\"2\" contenteditable >".$row_res['solucao']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "</tr>";

    //---------------------------------------------------
      echo "<tr>";
    echo "<td colspan=\"2\" class=cabecalho >Conclusione:  </td>";
    echo "</tr>";
    //----------------------------------------------------
    echo "<tr>";
echo "<td class=cabecalho >Risultato:  </td>";
echo "<td class=preencher colspan=\"2\">";

if ($row_res['risultato_finale'] == 'Riparato - Servizo chiuso') {
    // Ícone de visto
    echo '<span class="icon"><i class="fa fa-check"></i></span>';
} else if ($row_res['risultato_finale'] == 'Non riparato - Servizo aperto') {
    // Ícone de atenção
    }

echo "<td class=preencher colspan=\"2\">";

if ($row_res['risultato_finale'] == 'Riparato - Servizo chiuso') {
    $re = $row_res['data_hora'];
    $timestamp = strtotime($re);
    $new_date_finale = date("d-m-Y", $timestamp);
    $hora = $row_res['data_hora_finale'];
    $time = strtotime($hora);
    $new_time_finale = date("H:i", $time);
    
    
    // Ícone de visto
    echo '<span class="icon"><i class="fa fa-check"></i></span>';
    echo $row_res['risultato_finale'];
    
    echo "<tr>";
    echo "<td class=cabecalho >Data finale:  </td>";
    echo "<td class=preencher colspan=\"2\" >".$new_date_finale."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class=cabecalho >Hora finale:  </td>";
    echo "<td class=preencher colspan=\"2\" >".$new_time_finale."</td>";
    echo "</tr>";
} else {
    // Exibe o valor de $row_res['risultato_finale']
    echo " ";
}

// Fecha a tabela e o campo de conjunto
echo "</table >";
echo "</fieldset >";
echo "</br></br>";


        
        
   }
} 



$respostas = "SELECT * FROM tabela ORDER BY chave DESC" ;
$res = mysqli_query($conexao,$respostas);
//--------------------------------------------------------------------------------


while($row_res = mysqli_fetch_assoc($res))
{  
  
    echo "<fieldset style='width:300px;'>";  
    echo "<table>";
    echo "<form action='gerar_pdf.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $row_res['chave'] . "'>";
    echo "<input type='submit' value=' Generare pdf'>";
    echo "</form>";
    
        
        
   

	echo "<tr class='cor1' >";
    echo "<td class='cabecalho'>ID</td>";
    echo "<td class='preencher' id='row-". $row_res['chave'] . "'><a href='historic.php?id=" . $row_res['chave'] . "#row-" . $row_res['chave'] . "' style='text-decoration:none; color:black'>" . $row_res['chave'] . "</a></td>";
    echo "</tr>";
    
	//--------------------------------------------------
	echo "<tr >";
    echo "<td class=cabecalho>Girassole:  </td>";
    echo "<td class=preencher >".$row_res['id']."</td>";
    echo "</tr>";
    //------------------------------------------------
$re = $row_res['data_hora'];
$timestamp = strtotime($re);
$new_datetime = date("d-m-Y H:i", $timestamp);
$hora = $row_res['data_hora_finale'];
$time = strtotime($hora);
$new_time_finale = date("d-m-Y H:i", $time);
 //------------------------------------------------
echo "<tr class='cor1' >";
echo "<td class='cabecalho'>inizio riparo data/ora:  </td>";
echo "<td class='preencher'>".$new_datetime."</td>";
echo "</tr>";
    //--------------------------------------------------
    echo "<tr>";
    echo "<td class=cabecalho>Asse:</td>";
    echo "<td class=preencher>".$row_res['asse']."</td>";
    echo "</tr>";
    //----------------------------------------------------
echo "<tr class='cor1' >";
    echo "<td colspan=\"2\" class=cabecalho >Problemi:  </td>";
    echo "</tr>";
    //---------------------------------------------------
echo "<tr class='cor1' >";
    echo "<td class=preencher colspan=\"2\">".$row_res['problema']." </td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan=\"2\" class=cabecalho > Allegato:  </td>";
    echo "</tr>";
    //----------------------------------------------------
    
    if(empty($row_res['image']))
    {
    echo "<tr>";
    echo "<td class=preencher colspan=\"2\" ></br></td>";
    echo "</tr>"; 
    }else{
    echo "<tr>";
    echo "<td class=preencher colspan=\"2\" ><a href=".$row_res['image'].">".$row_res['image']."</a></td>";
    echo "</tr>"; 
    } 
   
    
    $hide_status = $row_res['status'];
    if($hide_status == 0)
    {
    echo "<tr class='cor1' >";
    echo "<td class=cabecalho >Status:  </td>";
    echo "<td class=preencher>".$hide."</td>";
    echo "</tr>";
    }else{
    echo "<tr class='cor1' >";
    echo "<td class=cabecalho >Status:  </td>";
    echo "<td class=preencher>".$row_res['status']." </td>";
    echo "</tr>";
    }
    //----------------------------------------------------
    $hide_comunicazione = $row_res['status'];

    
    //---------------------------------------------------
    $hide_comando = $row_res['status'];

     //----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Actual AZ:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{echo "<tr>";
    echo "<td class=cabecalho>Actual AZ</td>";
    echo "<td class=preencher>".$row_res['actual_AZ']."</td>";
    echo "</tr>";}
    //----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr class='cor1' >";
    echo "<td class=cabecalho >Actual TL:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr class='cor1' >";
    echo "<td class=cabecalho>Actual TL</td>";
    echo "<td class=preencher>".$row_res['actual_TL']."</td>";
    echo "</tr>";}
    //----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr>";
    echo "<td class=cabecalho >Setpoint AZ:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td class=cabecalho>Setpoint AZ</td>";
    echo "<td class=preencher>".$row_res['setpoint_AZ']."</td>";
    echo "</tr>";}
    //-----------------------------------------------------
    if($hide_comando == 0)
    {
    echo "<tr class='cor1' >";
    echo "<td class=cabecalho >Setpoint TL:  </td>";
    echo "<td class=preencher>".$hide." </td>";
    echo "</tr>";
    }else{
    echo "<tr class='cor1' >";
    echo "<td class=cabecalho>Setpoint TL</td>";
    echo "<td class=preencher>".$row_res['setpoint_TL']."</td>";
    echo "</tr>";}
    
    //----------------------------------------------------


echo "</table >";
echo "</fieldset >";
echo "<fieldset style='width:300px;'><legend>Descrizione del lavoro: </legend>";

echo "<table id='myTable' style='width:100%'>";
echo "<tr class='cor1' >";
echo "<td id='myTextbox' class='preencher' colspan='2' contenteditable>".$row_res['solucao']."</td>";
echo "</tr>";


echo "</table>";



echo "<table>";
echo "<tr>";
echo "<td>";

if ($row_res['risultato_finale'] == 'Riparato - Servizo chiuso') {
    echo "<form method='POST' action='gerar_pdf.php'>";
    echo "<span class='icon'><i class='fa fa-check' style='color: green;'></i></span> Riparato";
    echo "<td class='preencher'>" . $new_time_finale . "</td>";
    echo "</form>";
} elseif ($row_res['risultato_finale'] == 'Non riparato - Servizo aperto') {
    echo "<form method='POST' action='gerar_pdf.php'>";
    echo "<span class='icon'><i class='fa fa-exclamation-triangle' style='color: red;'></i></span> Servizo aperto";
    echo "</form>";
}

echo "</td>";

echo "</tr>";
echo "</table>";

echo "</table>";

echo "</fieldset>";

// Converter as strings de data/hora para objetos DateTime
$data_hora = new DateTime($row_res['data_hora']);
$data_hora_finale = new DateTime($row_res['data_hora_finale']);

// Calcular a diferença entre as datas/horas
$diferenca = $data_hora_finale->diff($data_hora);

// Formatar a diferença em um formato legível para o usuário
$downtime = $diferenca->format('%a giorni, %h ore, %i minuti');

// Exibir o resultado na tabela

echo "<fieldset style='width:300px;'><legend>Indicatori</legend>";  
echo "<table>";
echo "<tr class='cor1' >";
echo "<td class='cabecalho'>Numero di Incidenti:  </td>";
echo "<td class='preencher'>";
$sql = "SELECT COUNT(*) as Numero_Incidentes FROM tabela WHERE id = " . $row_res['id'];
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    while($linha = $resultado->fetch_assoc()) {
        echo $linha["Numero_Incidentes"];
        echo " incidenti";
    }
} else {
    echo "0";
}
echo "</td>";
echo "<tr>";
echo "<td class='cabecalho'>Tempo per riparare(TR):  </td>";
echo "<td class='preencher'>".$downtime."</td>";
echo "</tr>";
echo "</tr>";
echo "<tr class='cor1' >";
echo "<td>Tempo medio tra riparazione(TMTR) :  </td>";
echo "<td>";
	$query = "SELECT ABS(ROUND(AVG(TIMEDIFF(data_hora, lag_data_hora)) / 86400)) AS diff_em_dias, chave, id, data_hora FROM ( SELECT id, data_hora, data_hora_finale, chave, LAG(data_hora) OVER (ORDER BY chave DESC) AS lag_data_hora FROM tabela WHERE id = ". $row_res['id']." ) t ORDER BY chave DESC";

$resultado = $conexao->query($query);

if ($resultado->num_rows > 0) {
    while($linha = $resultado->fetch_assoc()) {
        echo $linha["diff_em_dias"] ;
        echo " giorni";
        
    }
} else {
    echo "0";
}
echo "</td>";
echo "</tr>";

echo "</table>"; 

echo "</fieldset>";
echo "</br></br>";
 
}

?>


 <script>
 
 function exportarPDF() {
  // Redirecionar para um script PHP responsável pela geração do PDF
  window.location.href = 'gerar_pdf.php';
}

 

 

 
// Abrir janela modal quando o botão "Editar" for clicado
document.getElementById('open-modal').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'block';
});

// adiciona um ouvinte de eventos aos botões do menu
    const botoes = document.querySelectorAll('.menu button');
    botoes.forEach(botao => {
      botao.addEventListener('click', () => {
        // remove a classe 'ativo' de todos os botões
        botoes.forEach(botao => {
          botao.classList.remove('active');
        });
        // adiciona a classe 'ativo' ao botão clicado
        botao.classList.add('active');

        // mostra o conteúdo da aba correspondente e esconde os outros
        const aba = botao.classList[0];
        const conteudos = document.querySelectorAll('.conteudo');
        conteudos.forEach(conteudo => {
          conteudo.classList.remove('ativo');
          if (conteudo.classList.contains(aba)) {
            conteudo.classList.add('ativo');
          }
        });
      });
    });




  </script>

 <footer>
  </br></br>
</footer>
</body>
</html>
