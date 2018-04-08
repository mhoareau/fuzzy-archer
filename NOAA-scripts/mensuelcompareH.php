<?php
date_default_timezone_set('Indian/Reunion');
#Version Universelle V2

#######################################
# Récupération du formulaire et tests #
#######################################
$mois[1] = (isset ($_GET['mois1'])) ? $_GET['mois1'] : "";
$annee[1] = (isset ($_GET['annee1'])) ? $_GET['annee1'] : "";
$mois[2] = (isset ($_GET['mois2'])) ? $_GET['mois2'] : "";
$annee[2] = (isset ($_GET['annee2'])) ? $_GET['annee2'] : "";

for ($j=1;$j<3;$j++){$moisA[$j]= gtmois($mois[$j]);}

if ($annee[1]=="" && $annee[2]=="" && $mois[1]=="" && $mois[2]=="") {$vide=1;} else {$vide=0;}
//echo $mois[1]." ".$tabmois[$moisch[1]-1]." ".array_search($mois[1], $tabmois1)+1;;
if ($annee[1]=="") {$annee[1]=date("Y");}
if ($mois[1]=="") {$moisch[1]=date("m"); $mois[1]=$tabmois[$moisch[1]-1];} else {$moisch[1] = array_search($mois[1], $tabmois)+1;}
if ($annee[2]=="") {$annee[2]=date("Y");}
if ($mois[2]=="") {$moisch[2]=date("m"); $mois[2]=$tabmois[$moisch[2]-1];} else {$moisch[2] = array_search($mois[2], $tabmois)+1;}
//echo $mois[1];
//echo $mois[2];
for ($j=1;$j<3;$j++){$moisA[$j]= gtmois($mois[$j]);}
//echo $moisA[1];
//echo $moisA[2];
if ($vide==1) {$titre = "$lx_choice_mths";}
   else {$titre = "<HR width=50%>$lx_comp".$moisA[1]." ".$annee[1].$lx_with.$moisA[2]." ".$annee[2]."<BR><HR width=50%>";}

$moisch[1] = substr((100+$moisch[1]),1);
$moisch[2] = substr((100+$moisch[2]),1);
if (TYPE_NOAA == "GW") {
  $fichier[1] = "../Statistics1/".$annee[1]."_".$moisch[1]."_NOAA.txt";
  $fichier[2] = "../Statistics1/".$annee[2]."_".$moisch[2]."_NOAA.txt";
  }

if (TYPE_NOAA == "WL") {
  if ($moisch[1]==date("m") && $annee[1]==date("Y")) {$fichier[1]=REP_NOAA."NOAAMO.TXT";}
    else {$fichier[1] = REP_NOAA.$mois[1]."-".$annee[1].".TXT";}
  if ($moisch[2]==date("m") && $annee[2]==date("Y")) {$fichier[2]=REP_NOAA."NOAAMO.TXT";}
    else {$fichier[2] = REP_NOAA.$mois[2]."-".$annee[2].".TXT";}}
if (TYPE_NOAA == "AUTRE") {
  $fichier[1] = REP_NOAA.$mois[1]."-".$annee[1].".TXT";
  $fichier[2] = REP_NOAA.$mois[2]."-".$annee[2].".TXT";}
  
  

if ($vide==1) {echo"<Font size='5'><b>$titre</b><br></Font>";}
echo"
<form method='get' action='NOAA.php'>
$lx_comp_r
<select size='1' name='mois1'>
  <option value=''>$lx_mth
  <option>$tabmois[0]</option>
  <option>$tabmois[1]</option>
  <option>$tabmois[2]</option>
  <option>$tabmois[3]</option>
  <option>$tabmois[4]</option>
  <option>$tabmois[5]</option>
  <option>$tabmois[6]</option>
  <option>$tabmois[7]</option>
  <option>$tabmois[8]</option>
  <option>$tabmois[9]</option>
  <option>$tabmois[10]</option>
  <option>$tabmois[11]</option>
</select>
<select size='1' name='annee1'>
  <option value=''>$lx_yr";
  for ($i=PREMIERE_ANNEE;$i<=date('Y');$i++) {
    echo "<option>$i";}
echo "
</select>
 $lx_with 
<select size='1' name='mois2'>
  <option value=''>$lx_mth
  <option>$tabmois[0]</option>
  <option>$tabmois[1]</option>
  <option>$tabmois[2]</option>
  <option>$tabmois[3]</option>
  <option>$tabmois[4]</option>
  <option>$tabmois[5]</option>
  <option>$tabmois[6]</option>
  <option>$tabmois[7]</option>
  <option>$tabmois[8]</option>
  <option>$tabmois[9]</option>
  <option>$tabmois[10]</option>
  <option>$tabmois[11]</option>
</select>
<select size='1' name='annee2'>
  <option value=''>$lx_yr";
  for ($i=PREMIERE_ANNEE;$i<=date('Y');$i++) {
    echo "<option>$i";}
echo "
</select>
<input type='hidden' name='period' value='c_mensuel'>
<input type='submit' value='Go'></form>";
if ($vide==0) {echo"<Font size='5'><b>$titre</b></Font>";}
 
if ($vide==1) {exit;}

$spaces = array("     ","    ","   ","  ");
$space = array(" "," "," "," ");
for ($j=1;$j<3;$j++){$moisA[$j]= gtmois($mois[$j]);}

for ($index=1; $index<3; $index++) {
  $fp = @fopen ("$fichier[$index]",r) or die("<BR><Div class='titre'>Les données n'existent pas pour ".$mois[$index]." ".$annee[$index].".<BR>Choisissez une autre période.</Div>");
  $content = fread ($fp,filesize("$fichier[$index]"));
  fclose ($fp);
  $content = str_replace(",",".",$content);
  $content = str_replace("\r","",$content);
  $separ_1[$index] = explode("----------\n",$content); 
  $separ_2[$index] = explode("\n----------",$separ_1[$index][1]); 
  $table[$index] =$separ_2[$index][0];
  $nb[$index] = substr_count ($table[$index], "\n");
  $line[$index] = explode("\n",$table[$index]);
  for($j=0;$j<sizeof($line[$index]);$j++){
    $line[$index][$j]=" ".$line[$index][$j];
    $line[$index][$j] = str_replace($spaces,$space,$line[$index][$j]);}
}

$char = array (" ","W");
$newchar = array ("","O");

	$gel = array (1=>0,2=>0);
	$fortgel = array (1=>0,2=>0);
	$sansdegel = array (1=>0,2=>0);
	$chaleur = array (1=>0,2=>0);
	$canicule = array (1=>0,2=>0);
	$pluie = array (1=>0,2=>0);
	$pluie_1 = array (1=>0,2=>0);
	$pluie_5 = array (1=>0,2=>0);
	$pluie_10 = array (1=>0,2=>0);
	$maxsoleil = array (1=>0,2=>0);
	$jourmaxsoleil = array(1=>"",2=>"");
	$maxrain = array (1=>0,2=>0);
	$maxvent = array (1=>0,2=>0);
	$venteux = array (1=>0,2=>0);
	$meantemp_max = array (1=>-100,2=>-100);
	$meantemp_min = array (1=>100,2=>100);
	$lowtemp_max = array (1=>-100,2=>-100);
	$hightemp_min = array (1=>100,2=>100);
	$lowtemptotal = array (1=>0,2=>0);
	$hightemptotal = array (1=>0,2=>0);
	$soleiltotal = array (1=>0,2=>0);
	$pluietotal = array (1=>0,2=>0);
	$amplitude_max = array (1=>0,2=>0);
	$amplitude_min = array (1=>100,2=>100);
	$uv_index = array (1=>100,2=>100);
	$uv_minmax = array (1=>100,2=>100);
	$uv_avg = array (1=>100,2=>100);
	$compteur_N = array (1=>0,2=>0);
$compteur_NNE = array (1=>0,2=>0);
$compteur_NE = array (1=>0,2=>0);
$compteur_ENE = array (1=>0,2=>0);
$compteur_E = array (1=>0,2=>0);
$compteur_ESE = array (1=>0,2=>0);
$compteur_SE = array (1=>0,2=>0);
$compteur_SSE = array (1=>0,2=>0);
$compteur_S = array (1=>0,2=>0);
$compteur_SSO = array (1=>0,2=>0);
$compteur_SO = array (1=>0,2=>0);
$compteur_OSO = array (1=>0,2=>0);
$compteur_O = array (1=>0,2=>0);
$compteur_ONO = array (1=>0,2=>0);
$compteur_NO = array (1=>0,2=>0);
$compteur_NNO = array (1=>0,2=>0);

##############################################
# Récupération des moyennes et maxi mensuels #
##############################################
for ($index=1; $index<3; $index++) {
  $bilan =" ".$separ_1[$index][2];
  $bilan = explode ("\n",$bilan);
  $bilan[0] = str_replace($spaces,$space,$bilan[0]);
  $value = explode(" ",$bilan[0]);
  $meantemp_m[$index] = $value[1];
  $hightemp_max[$index] = $value[2];
  $hourhightemp_max[$index] = $value[3];
  $lowtemp_min[$index] = $value[4];
  $hourlowtemp_min[$index] = $value[5];
  $rain_m[$index] = $value[8];
  $ventmoyen_m[$index] = $value[9];
  $rafales_m[$index] = $value[10];
  $jour_rafales_m[$index] = $value[11];
  $domdir_m[$index] = $value[12];


  
  
}

################################################################
# Récupératuration des autres maxi/mini et calcul des moyennes #
################################################################
for ($index=1; $index<3; $index++) {
   $lowtemptotal=0;
   $hightemptotal=0;
   $soleiltotal=0;
   $pluietotal=0;
for ($i=0; $i<$nb[$index]+1; $i++) {
  $value = explode(" ",$line[$index][$i]);
  $jourch[$index] = substr((100+$value[1]),1);
  if (count($value)>2) {
    $rain[$index] = $value[9]*1;
    $ventmoyen[$index] =  $value[10];
    if ($value[11]>=36) {$venteux[$index]++;}
	$dd =  str_replace("W","O",$value[12]);
	if ($value[11]>=50 && ($dd='NE' or $dd=='NNE' or $dd=='N' or $ddd=='NNO' or $dd=='NO' )) 
	{
		$venteux_mistral[$index]++;
	}  
    $meantemp[$index] = $value[2];
    $lowtemp_day[$index] = $value[6];
    $lowtemp[$index] = $value[5];
    $hightemp[$index] = $value[3];}
  else {   
    $rain[$index] = "";
    $ventmoyen[$index] =  "";
    $meantemp[$index] = "";
    $lowtemp[$index] = "";
    $hightemp[$index] = "";}



  if ($soleil[$index] > $maxsoleil[$index] && $soleil[$index]!="") {
    $maxsoleil[$index]=$soleil[$index]; $jourmaxsoleil[$index]=$value[1];}
  if ($rain[$index] > $maxrain[$index] && $rain[$index]!="") {
    $maxrain[$index]=$rain[$index]; $jourmaxrain[$index]=$value[1];}
  if ($ventmoyen[$index] > $maxvent[$index] && $ventmoyen[$index]!="") {
    $maxvent[$index]=$ventmoyen[$index]; $jour_vent_max[$index]=$value[1];}
  if ($meantemp[$index] > $meantemp_max[$index] && $meantemp[$index]!="") {$meantemp_max[$index]=$meantemp[$index];}
  if ($meantemp[$index] < $meantemp_min[$index] && $meantemp[$index]!="") {$meantemp_min[$index]=$meantemp[$index];}
  if ($lowtemp[$index] > $lowtemp_max[$index] && $lowtemp[$index]!="") {$lowtemp_max[$index]=$lowtemp[$index];}
  if ($hightemp[$index] < $hightemp_min[$index] && $hightemp[$index]!="") {$hightemp_min[$index]=$hightemp[$index];}

  if ($lowtemp[$index]!="") {$lowtemptotal = $lowtemptotal+$lowtemp[$index];
    $lowtemp_moy[$index] = round(($lowtemptotal/$jourch[$index]), 1);}
  if ($hightemp[$index]!="") {$hightemptotal = $hightemptotal+$hightemp[$index];
    $hightemp_moy[$index] = round(($hightemptotal/$jourch[$index]), 1);}
  if ($soleil[$index]!="") {$soleiltotal = $soleiltotal+$soleil[$index];
    $soleil_moy[$index] = round(($soleiltotal/$jourch[$index]), 1);}
  if ($rain[$index]!="") {$pluietotal = $pluietotal+$rain[$index];
    $pluie_moy[$index] = round(($pluietotal/$jourch[$index]), 1);}

  if ($lowtemp[$index]!="") {
    $amplitude = $hightemp[$index] - $lowtemp[$index];
    if ($amplitude < $amplitude_min[$index]) {$amplitude_min[$index]=$amplitude; $jour_amplitude_min[$index]=$value[1];}
    if ($amplitude > $amplitude_max[$index]) {$amplitude_max[$index]=$amplitude; $jour_amplitude_max[$index]=$value[1];}}

  if ($lowtemp[$index]<='0' && $lowtemp[$index]!="") {$gel[$index]=$gel[$index]+1;}
  if ($lowtemp[$index] <='-5'&& $lowtemp[$index]!="") {$fortgel[$index]=$fortgel[$index]+1;}
  if ($lowtemp[$index]<='0' && $hightemp[$index]<='0' && $lowtemp[$index]!="") {$sansdegel[$index]=$sansdegel[$index]+1;} 
  if ($hightemp[$index] >='30' /*&& $hightemp[$index] <'35'*/) {$chaleur[$index]++;}
  //echo $hightemp[1].'cc'.$chaleur[$index].'<br/>';
  if ($hightemp[$index] >='35') {$canicule[$index]=$canicule[$index]+1;}
  if ($rain[$index]>'0' && $rain[$index]!="") {$pluie[$index]=$pluie[$index] + 1;} 
  if ($rain[$index]>='1' && $rain[$index]<'5' && $rain[$index]!="") {$pluie_1[$index]=$pluie_1[$index]+1;}
  if ($rain[$index]>='5'  && $rain[$index]<'10' && $rain[$index]!="") {$pluie_5[$index]=$pluie_5[$index]+1;}
  if ($rain[$index]>='10' && $rain[$index]!="") {$pluie_10[$index]=$pluie_10[$index]+1;}

  }
}



###################
# Affichage Final #
###################

$xtitre='Jours';
$mensuel=true;
$Xlab=$xlabel;
$monstep='2';
include "traceH.php";
echo"<Table border=0><TR>";

for ($j=1;$j<3;$j++){$moisA[$j]= gtmois($mois[$j]);}

for ($index=1; $index<3; $index++) {
echo "<TD>
<br>
<Table class='rap1'  border=1 width=450>
  <TR bgcolor='#9bbad7'>
    <TD><Font color='black' size='2'>
	<br><center><B><U><I><Font size='4'>$moisA[$index] $annee[$index]</Font></I></U></B></Center><BR>
	<UL>
	<LI><B>$lx_temp</B>
		<UL class='rap2' >
		<LI>$lx_temp_avg_mth : <span class='stylegrosrouge'>$meantemp_m[$index] °C</span>
		<LI>$lx_temp_avg_min: <span class='stylegrosrouge'>$lowtemp_moy[$index] °C</span>
		<LI>$lx_temp_avg_max: <span class='stylegrosrouge'>$hightemp_moy[$index] °C</span>
		<LI>$lx_tn_mth : <span class='stylegrosrouge'>$lowtemp_min[$index] °C </span>$lx_on<span class='stylegrosrouge'>$hourlowtemp_min[$index]</span>
		<LI>$lx_tx_mth : <span class='stylegrosrouge'>$hightemp_max[$index] °C</span>$lx_on<span class='stylegrosrouge'>$hourhightemp_max[$index]</span>
		<LI>$lx_amp_min : <span class='stylegrosrouge'>$amplitude_min[$index] °C</span>$lx_on<span class='stylegrosrouge'>$jour_amplitude_min[$index]</span>
		<LI>$lx_amp_max : <span class='stylegrosrouge'>$amplitude_max[$index] °C</span>$lx_on<span class='stylegrosrouge'>$jour_amplitude_max[$index]</span><BR>
		</UL>
	</UL>
	<UL>
	<LI><B>$lx_wind</B>
		<UL class='rap2' >
		<LI>$lx_wind_avg_mth :<BR>&nbsp&nbsp&nbsp<span class='stylegrosrouge'>$ventmoyen_m[$index] km/h</span> $lx_wind_sect <span class='stylegrosrouge'>$domdir_m[$index] </span>
		<LI>$lx_wind_max : <span class='stylegrosrouge'>$maxvent[$index] km/h</span>$lx_on<span class='stylegrosrouge'>$jour_vent_max[$index]</span>
		<LI>$lx_raf_max : <span class='stylegrosrouge'>$rafales_m[$index] km/h</span>$lx_on<span class='stylegrosrouge'>$jour_rafales_m[$index]</span>
		<LI>$lx_windy_days ($lx_raf>36 km/h) : <span class='stylegrosrouge'>$venteux[$index]</span>";
		if (MISTRAL=="TRUE"){echo "<LI>$lx_mistral_days ($lx_raf>50 km/h) : <span class='stylegrosrouge'>$venteux_mistral[$index]</span>";}
		echo "</UL></UL>
	<UL>
	<LI><B>$lx_rain</b>
		<UL class='rap2' >
		<LI>$lx_rain_mth : <span class='stylegrosrouge'>$rain_m[$index] mm</span>
		<LI>$lx_rain_day_max <span class='stylegrosrouge'>$maxrain[$index] mm</span>$lx_on<span class='stylegrosrouge'>$jourmaxrain[$index]</span>
		</UL>
	</UL>
	<UL>";
	if (SONDE_SOL=="TRUE") {echo "
	<LI><B>$lx_sunny</B>
		<UL class='rap2' >
		<LI>$lx_nrj_mth <span class='stylegrosrouge'>$soleilnrj[$index] kWh</span>
		<LI>$lx_rad_day_avg <span class='stylegrosrouge'>$soleilrad[$index] W/m²</span>
		<LI>$lx_sunny_mth <span class='stylegrosrouge'>$soleil_m[$index] h</span> ($lx_watt_m2)
		<LI>$lx_rain_day_max <span class='stylegrosrouge'>$maxsoleil[$index] h</span>$lx_on<span class='stylegrosrouge'>$jourmaxsoleil[$index]</span>
		</UL>
	</UL>"
	;}
	echo "
    </td>
  </tr>
</table>
<br>

<table  class='rap2' border=1 width=450>
  <tr bgcolor='#6699cc' rawspan='2'>
    <td colspan='2'><Font color='black' size='2'>
	<b><center>$lx_days_nr $moisA[$index] $annee[$index]</center></b>
    </td>
  </tr>
  <tr bgcolor='#9bbad7'>
    <td  align='center'>
	<table class='rap2;tableval' border='0'>
	<tr><td>$lx_day_freeze_nb : </td><td><span class='stylegrosrouge'>$gel[$index]</span></td></tr>
	<tr><td>$lx_day_deep_freeze_nb (<=-5) :</td><td><span class='stylegrosrouge'>$fortgel[$index]</span></td></tr>
	<tr><td>$lx_day_icy_nb : </td><td><span class='stylegrosrouge'>$sansdegel[$index]</span></td></tr>
	<tr><td>$lx_day_hot (>=30) :</td><td><span class='stylegrosrouge'>$chaleur[$index]</span></td></tr>
	<tr><td>$lx_day_heatwave (>=35) :</td><td><span class='stylegrosrouge'>$canicule[$index]</span></td></tr>
	</table>
    </td>
    <td  align='center' valign='middle'>
	<table class='rap2'  border='0'>
	<tr><td>$lx_rainy_day :</td><td><span class='stylegrosrouge'>$pluie[$index]</span></td></tr>
	<tr><td>$lx_rain_1to5 :</td><td><span class='stylegrosrouge'>$pluie_1[$index]</span></td></tr>
	<tr><td>$lx_rain_5to10 :</td><td><span class='stylegrosrouge'>$pluie_5[$index]</span></td></tr>
	<tr><td>$lx_rain_over10 :</td><td><span class='stylegrosrouge'>$pluie_10[$index]</span></td></tr>
	</table>
    </td>
  </tr>
</table>
</TD>";
}
echo "</TR></Table>";
?>
</HEAD>