<?php include_once("connection.php");?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="meteo.js"></script>

	<title>manutenzione degli impiante</title>
</head>
<body>
   
<div class="menu">
<a href="https://spirano-it.000webhostapp.com/index.php"><button class="intervento active" >Intervento</button></a>
<a href="https://spirano-it.000webhostapp.com/historic.php"><button class="storico">Storico</button></a>
<!--<a href="https://spirano-it.000webhostapp.com/deposito.php"><button class="deposito">Deposito</button></a>-->
</div>

<div class="blue-div">
    <div id="weather-results" class="meteo" defer></div>
    
    </div>


<div class="conteudo_intervento">

<form class="form" id="form" action="mail.php" method="post" enctype="multipart/form-data">



<fieldset><table><tr>
   <td class="cabecalho">Girassole:</td>
   <td class="preencher"><select class="select" name="id" id="id">
  <option value="selezione">Selezione</option>

  <?php
  $sql = "SELECT girasole, Stringbox FROM girasole";
  $resultado = mysqli_query($conexao, $sql);
  
  while ($linha = mysqli_fetch_assoc($resultado)): 
     
  
  ?>
    <option value="<?php echo $linha['girasole']; ?>"><?php echo $linha['girasole']; ?></option>
    
    
<?php endwhile; ?>
  
</select></td>
   </tr> 


<tr>
   <td class="cabecalho">Data/Ora:</td>
   <td class="preencher"><input type="datetime-local" name="data_hora" id="data_hora" class="input" value="<?php echo date('Y-m-d\TH:i', strtotime('+1 hour')); ?>">
   </td>
</tr>
<tr>
   <td class="cabecalho">Manutenzione Tipo:</td>
    <td class="preencher">
        <select type="text" id="manutenzione" name="manutenzione" class="select">
            <option value="">Selezione</option>
      <option value="Preventiva">Preventiva</option>
      <option value="Corretiva">Corretiva </option>
    </select>
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
   <td class="cabecalho">Codice Status:</td>
    <td class="preencher">
    <select type="text" name="status" id="status" class="select"style="width:150px">
    <option value="0"> Selezione </option>
    <option value="8 - HOMING OK" >8 - HOMING OK</option>
    <option value="9 - AZ TIMEOUT + HOMING OK" >9 - AZ TIMEOUT + HOMING OK</option>
    <option value="10 - TL TIMEOUT + HOMING OK ">10 - TL TIMEOUT + HOMING OK</option>
    <option value="11 - AZ TIMEOUT + TL TIMEOUT + HOMING OK">11 - AZ TIMEOUT + TL TIMEOUT + HOMING OK </option>
    <option value="16 - HOMING KO">16 - HOMING KO </option>  
    <option value="521 - AZ TIMEOUT + HOMING OK + FINECORSA ">521 - AZ TIMEOUT + HOMING OK + FINECORSA </option>
    <option value="522 - TL TIMEOUT + HOMING OK + FINECORSA ">522 - TL TIMEOUT + HOMING OK + FINECORSA </option>
    <option value="523 - AZ TIMEOUT + TL TIMEOUT + HOMING OK + FINECORSA ">523 - AZ TIMEOUT + TL TIMEOUT + HOMING OK + FINECORSA </option>
    <option value="529 - AZ TIMEOUT + HOMING KO + FINACORSA ">529 - AZ TIMEOUT + HOMING KO + FINACORSA </option>
    <option value="530 - TL TIMEOUT + HOMING KO + FINACORSA ">530 - TL TIMEOUT + HOMING KO + FINACORSA  </option>
    <option value="531 - AZ TIMEOUT + TL TIMEOUT + HOMING KO + FINACORSA ">531 - AZ TIMEOUT + TL TIMEOUT + HOMING KO + FINACORSA </option>

   <!-- <option value="1032">1032 - </option>-->
    <option value="2056 - BYPASS">2056 - BYPASS</option>
    <option value="8200.0 - HOMING OK + POWER ON">8200.0 - HOMING OK + POWER ON</option>
    <option value="9224.0 - HOMING OK + OUTRANGE + POWER ON">9224.0 - HOMING OK + OUTRANGE + POWER ON</option>
    

    </select>
    </td>
</tr></table></fieldset>

<fieldset> <legend>Posizione</legend>
<table>
<tr>
    <td class="cabecalho">Actual AZ:</td>
    <td class="preencher"><select class="0-360" type="number" name="actual_AZ" id="actual_AZ" value="selezione" style="width:150px"><option value="0"> Selezione </option>
    <?php
        for ($i=30; $i<=280; $i++) {
          echo "<option value='$i'>$i</option>";
        }?>
        </select>
    </td>
</tr>

<tr>
    <td  class="cabecalho">Actual TL:</td>
    <td class="preencher"><select class="43-70" type="number" name="actual_TL" id="actual_TL" value="selezione" style="width:150px"><option value="0"> Selezione </option>
    <?php
        for ($i=43; $i<=70; $i++) {
          echo "<option value='$i'>$i</option>";
        }?>
        </select>
    </td>
</tr>


<tr>
    <td class="cabecalho">Setpoint AZ:</td>
     <td class="preencher">
         <select class="0-360" type="number" name="setpoint_AZ" id="setpoint_AZ" value="selezione" style="width:150px">
             <option value="0"> Selezione </option>
     <?php
        for ($i=30; $i<=280; $i++) {
          echo "<option value='$i'>$i</option>";
        }?></select>
    </td>
</tr>
<tr>
    <td class="cabecalho">Setpoint TL:</td>
     <td class="preencher"><select class="43-70" type="number" name="setpoint_TL" id="setpoint_TL" value="selezione" style="width:150px"><option value="0"> Selezione </option>
        <?php
        for ($i=43; $i<=70; $i++) {
          echo "<option value='$i'>$i</option>";
        }?>
        </select>
    </td>
</tr></table></fieldset> 
<fieldset> <legend>Lista dei problemi</legend>
<table>
<tr>
      <label><input type="checkbox" name="problema[]" value="Non sale in modo di sicurezza"> Non sale in modo di sicurezza</label><br>
      <label><input type="checkbox" name="problema[]" value="Motore AZ blocca di modo intermittente"> Motore AZ blocca di modo intermittente</label><br>
      <label><input type="checkbox" name="problema[]" value="Motore AZ fai troppo rumore"> Motore AZ fai troppo rumore</label><br>
      <label><input type="checkbox" name="problema[]" value="Tilt scende sotto homing"> Tilt scende sotto homing</label><br>
      <label><input type="checkbox" name="problema[]" value="AZ attiva finacorsa"> AZ attiva finacorsa di homing</label><br>
      <label><input type="checkbox" name="problema[]" value="AZ attiva finacorsa"> AZ attiva finacorsa di folowing</label><br>
      <label><input type="checkbox" name="problema[]" value="Tilt attiva finacorsa"> Tilt attiva finacorsa</label><br>
      <label><input type="checkbox" name="problema[]" value="TL o AZ non ferma sul setpoint"> TL o AZ non ferma sul setpoint</label><br>
      <label><input type="checkbox" name="problema[]" value="Flxmod err - non esce di homing"> Flxmod err - non esce di homing</label><br>
      <label><input type="checkbox" name="problema[]" value="Flmod err - setpoint position diverso di efemeride"> Flxmod err - setpoint position diverso di efemeride</label><br>
      <label><input type="checkbox" name="problema[]" value="Ingranaggio di plastica rotto"> Ingranaggio di plastica rotto</label><br>
      <label><input type="checkbox" name="problema[]" value="Ingranaggio di bronzo rotto"> Ingranaggio di bronzo rotto</label><br>
      <label><input type="checkbox" name="problema[]" value="Nessun valore nella schermata"> Nessun valore nella schermata</label><br>
      <label><input type="checkbox" name="problema[]" value="Girasole spegne interrutore 12QF1"> Girasole spegne interrutore 12QF1</label><br>
      <label><input type="checkbox" name="problema[]" value="Cavo di alimentazione invertido"> Cavo di alimentazione invertido</label><br>
      <label><input type="checkbox" name="problema[]" value="Tutti girasoli si fermano"> Tutti girasoli si fermano</label><br>
      <label><input type="checkbox" name="problema[]" value="Salta la corrente"> Salta la corrente</label><br>
      <label><input type="checkbox" name="problema[]" value="PW1 o PW2 o lampeggia"> PW1 o PW2 o lampeggia</label><br>
      <label><input type="checkbox" name="problema[]" value="Interruttore accende spie boost quando tilt sale"> Interruttore accende spie boost quando tilt sale</label><br>
</table>  
</tr></fieldset>

<fieldset> <legend>Allegare image</legend><tr>
 <td colspan="2" ><div><input type="file" name="image"  ></div> </td> 
</tr></fieldset>

<fieldset> <legend>Riassunto del lavoro</legend><table>

<tr>
<textarea style="width:100%; height:200px;" id="solucao" name="solucao" rows="2" cols="36"  placeholder="Descrizione">
</textarea>

</tr>
<tr>
   <td><select type="text" name="risultato_finale" id="comando" class="select" style="width:80px">
        <option value="">Risultato</option>
        <option value="Riparato - Servizo chiuso">Riparato - Servizo chiuso</option>
        <option value="Non riparato - Servizo aperto">Non riparato - Servizo aperto</option>
    </select></td>
   <td class="preencher"><input type="datetime-local" name="data_hora_finale" id="data_hora_finale" class="input" value="<?php echo date('Y-m-d\TH:i', strtotime('+1 hour')); ?>">
   </td>
</tr></table></fieldset>

<fieldset><table><tr>
<tr>
    <td colspan="2"><input type="submit" name="submit" id="submit" class="btn btn-info"> </td>
</tr></table></fieldset>
</form>
 </div>
 <footer>
  </br></br>
</footer>
</body>
</html>
