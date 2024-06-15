<?php include_once("connection.php");
$sql = "SELECT girasole, Stringbox FROM girasole";
$resultado = mysqli_query($conexao, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <script src="./removebanner.js"></script>
    <title>manutenzione degli impianti</title>
    <meta charset="utf-8">
    <!–– site responsivo ––>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!–– jquery ––>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!–– css––>
    <link rel="stylesheet" href="public_html/style.css" >
    <!–– bootstrap ––>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
    <!––  ––>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!–– and the comment closes with ––>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!–– and the comment closes with ––>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!–– and the comment closes with ––>
    <script src="js/jquery-1.8.2.min.js" type="text/javascript" ></script>
    <!–– and the comment closes with ––>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!–– and the comment closes with ––>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="meteo.js"></script>
 
 <style type="text/css">
 form{
  
  padding-left: 15px;
 }
.meteo{
    background-color:white;
}
textarea{
    white-space: pre-line;
}     
.cabecalho{
     width:150px!important;
   }
.preencher{ 
    width:150px!important;} 
label{
    display: inline-block; margin-right: 10px;
    }
input {
    width: 150px;
}
select {
    width: 100%;
}

 </style>

  </head>

<body >  



<header class="text-left p-1" style="background-color: yellow;">
  <nav class="menu">
             <a class="" href="index.php"> Intervento </a>
          <!--<a class="" href="sicurezza.php"> Gobat </a>-->
           <a class="" href="historic.php"> Storico </a>
           <a class="" href="deposito.php"> Deposito </a>
  </nav>
</header>


    <div id="weather-results" class="meteo" defer></div>
    


   
  <h6>Descrizione del errrore:</h6>
  
<form class="form" id="form" action="mail.php" method="post" enctype="multipart/form-data">
<script type="text/javascript">

   
$(function(){
    var $select = $(".0-92");
    for (i=1;i<=92;i++){
        $select.append($('<option></option>').val(i).html(i))
    } 
});
$(function(){
    var $select = $(".100-241");
    for (i=100;i<=241;i++){
        $select.append($('<option></option>').val(i).html(i))
    } 
});
$(function(){
    var $select = $(".43-90");
    for (i=43;i<=90;i++){
        $select.append($('<option></option>').val(i).html(i))
    } 
});


</script>


<table >
   <tr>
   <td class="cabecalho">Girassole:</td>
   <td class="preencher"> <select name="id" id="id" style="width:150px">
  <option value="selezione">Selezione</option>

  <?php
  
  while ($linha = mysqli_fetch_assoc($resultado)): 
     
  
  ?>
    <option value="<?php echo $linha['girasole']; ?>"><?php echo $linha['girasole']; ?></option>
    
    
<?php endwhile; ?>
  
</select></td>
   </tr> 
    
<tr>
   <td class="cabecalho">Stringbox:</td>
   <td class="preencher">  </td> 
</tr>  
<tr>
   <td class="cabecalho">Inverter:</td>
   <td class="preencher">
     
       
       
   </td>
</tr>
<tr>
   <td class="cabecalho">Linea:</td>
   <td class="preencher"></td>
</tr>
   <td class="cabecalho">Fase:</td>
   <td class="preencher">
       
       
   </td>
</tr>
<tr>
   <td class="cabecalho">Data:</td>
   <td class="preencher"><input type="date" name="data" id="data" class="date" style="width:150px">
       <script>
               var date = new Date();
               var currentDate = date.toISOString().substring(0 , 10);
               document.querySelector('.date').value = currentDate;
       </script>
   </td>
</tr> 
<tr>
   <td class="cabecalho">Ore:</td>
   <td class="preencher"><input type="time" name="hora" id="hora" class="time" style="width:150px">
       <script>  
               var date = new Date();
               var currentTime = date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
               document.querySelector('.time').value = currentTime;
       </script>
   </td>
</tr> 

    
<tr>
   <td class="cabecalho">Codice Status :</td>
    <td class="preencher">
    <select type="text" name="status" id="status" class="status"style="width:150px">
    <option value=""> Selezione </option>
    <option value="0"> Spento </option>
    <option value="8 - HOMING OK" >8 - HOMING OK</option>
    <option value="9 - AZ TIMEOUT" >9 - AZ TIMEOUT</option>
    <option value="10 - TL TIMEOUT ">10 - TL TIMEOUT </option>
    <option value="16">16 - </option>  
    <option value="521 - AZ TIMEOUT + FINECORSA ">521 - AZ TIMEOUT + FINECORSA </option>
    <option value="523">523 - </option>
    <option value="1032">1032 - </option>
    <option value="2056 - BYPASS">2056 - BYPASS</option>
    </select>
    </td>
</tr>
    
<tr>
   <td class="cabecalho">Colore :</td>
   <td class="preencher"><select type="text" name="cor" id="cor" style="width:150px">
   <option value=""> Selezione </option>
   <option value="Spento" >Spento</option>
    <option value="Verde">Verde</option>
    <option value="Rosso">Rosso</option>
    <option value="Grigia">Grigia</option></td>
</tr>
 
<tr>
   <td class="cabecalho">Comunicazione :</td>
   <td class="preencher">
   <select type="text" name="comunicazione" id="comunicazione" style="width:150px">
   <option value=""> Selezione </option>
   <option value="Spento" >Spento</option>
   <option value="Online" >Online</option>
   <option value="Offline" >Offline</option>
   </select>
   </td>
</tr>

<tr>
   <td class="cabecalho">Comando :</td>
   <td class="preencher">
   <select type="text" name="comando" id="comando" style="width:150px">
   <option value=""> Selezione </option>
   <option value="Spento" >Spento</option>
   <option value="Started">Start</option>
   <option value="Stoped">Stop</option>
   </select>
   </td>
</tr>


<tr>
    <td class="cabecalho">Actual Position AZ:</td>
    <td class="preencher"><select class="100-241" type="number" name="actual_AZ" id="actual_AZ" value="selezione" style="width:150px"><option>Selezione</option><option>0</option></select>
    </td>
</tr>

<tr>
    <td  class="cabecalho">Actual Position TL</td>
    <td class="preencher"><select class="43-90" type="number" name="actual_TL" id="actual_TL" value="selezione" style="width:150px"><option>Selezione</option><option>0</option></select>
    </td>
</tr>


<tr>
    <td class="cabecalho">Setpoint AZ:</td>
     <td class="preencher"><select class="100-241" type="number" name="setpoint_AZ" id="setpoint_AZ" value="selezione" style="width:150px"><option>Selezione</option><option>0</option></select>
    </td>
</tr>
<tr>
    <td class="cabecalho">Setpoint TL:</td>
     <td class="preencher"><select class="43-90" type="number" name="setpoint_TL" id="setpoint_TL" value="selezione" style="width:150px"><option>Selezione</option><option>0</option></select>
    </td>
</tr> 
<tr>
   <td class="cabecalho">Asse :</td>
    <td class="preencher">
    <select type="text" name="asse" id="asse" class="asse"style="width:150px">
    <option value=""> Selezione </option>
    <option value="Tilt" >Tilt</option>
    <option value="Azimut" >Azimut</option>
    </select>
    </td>
</tr>
<tr>
   <td class="cabecalho">Segui il sole? :</td>
    <td class="preencher">
       <select type="text" id="opcoes" name="seguimento">
      <option value="sim segue o sol">sim segue o sol</option>
      <option value="nao segue o sol ">nao segue o sol </option>
    </select>
    </td>
</tr>
<tr>
   <td class="cabecalho">Manutenzione :</td>
    <td class="preencher"><span id="resultado"></span>
    </td>
</tr>
<tr>
    <td colspan="2"><textarea id="problema" name="problema" rows="2" cols="36" placeholder="Commenti">
</textarea></td>
</tr>

<tr>
 <td colspan="2" ><div><input type="file" name="image"></div> </td> 
</tr>
</table><hr>
<table>

<tr>
    <td colspan="2" class="preencher"  > <h6>Descrizione del lavoro: </h6> </td>
</tr>

<tr>
    <td colspan="2"><textarea id="solucao" name="solucao" rows="2" cols="36" >
</textarea></td>
</tr>
</table><hr>
<table>
 
<tr>
    <td colspan="2" class="preencher"  > <h6>Conclusione: </h6> </td>
</tr>
<tr>
   <td class="cabecalho">Risultato :</td>
   <td class="preencher">
   <select type="text" name="risultato_finale" id="comando" style="width:150px">
   <option value=""> Selezione </option>
   <option value="Riparato - Servizo chiuso" >Riparato - Servizo chiuso</option>
   <option value="Non riparato - Servizo aperto">Non riparato - Servizo aperto</option>
   </select>
   </td>
</tr>
<tr>
   <td class="cabecalho">Data finale:</td>
   <td class="preencher"><input type="date" name="data_finale" id="data" class="date" style="width:150px">
       <script>
               var date = new Date();
               var currentDate = date.toISOString().substring(0 , 10);
               document.querySelector('.date').value = currentDate;
       </script>
   </td>
</tr> 
<tr>
   <td class="cabecalho">Ore finale:</td>
   <td class="preencher"><input type="time" name="hora_finale" id="hora" class="time" style="width:150px">
       <script>  
               var date = new Date();
               var currentTime = date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
               document.querySelector('.time').value = currentTime;
       </script>
   </td>
</tr> 



<tr>
    <td colspan="2"><input type="submit" name="submit" id="submit" class="btn btn-info"> </td>
</tr>


</table>
</form>
</body>
</html>
 

<script type="text/javascript">
 
 const opcoes = document.getElementById('opcoes');
      const resultado = document.getElementById('resultado');
      const submit = document.getElementById('submit');

      opcoes.addEventListener('change', function() {
        const selecionado = this.value;
        if (selecionado === 'sim segue o sol') {
          resultado.textContent = 'Ordinaria';
        } else if (selecionado === 'nao segue o sol ') {
          resultado.textContent = 'Straordinaria';
        }
      });

      submit.addEventListener('click', function() {
        const resultadoValor = resultado.textContent;
        salvarNoBancoDeDados(resultadoValor);
      });

      function salvarNoBancoDeDados(valor) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
          }
        };
        xhttp.open("POST", `mail.php?valor=${valor}`, true);
        xhttp.send();
      }
</script>
