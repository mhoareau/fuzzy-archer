<?php

#######################################
# Récupération du formulaire et tests #
#######################################

date_default_timezone_set('Indian/Reunion');


$fichier= array(3);
$mois[1] = (isset ($_GET['mois1'])) ? $_GET['mois1'] : $tabmois[date("m")-1];
$annee[1] = (isset ($_GET['annee1'])) ? $_GET['annee1'] :date("Y");
for ($j=1;$j<3;$j++)
{ gtmois($mois[$j]);
$moisA[$j]=gtmois($mois[$j]);
}


if ($annee[1]=="") 
{
	$annee[1]=date("Y");
}
if ($mois[1]=="") 
{
	$moisch[1]=date("m"); $mois[1]=$tabmois1[$moisch[1]-1];
} 
else 
{
	$moisch[1] = array_search($mois[1], $tabmois)+1;
}

if ($vide==1) 
{
	$titre = "$lx_choice_mth";
}
else 
{
	//$titre = "<HR width=50% > ".$mois[1]." ".$annee[1]."<BR><HR width=50% >";
}

$moisch[1] = substr((100+$moisch[1]),1);
$fichier[1] = REP_NOAA.$annee[1]."_".$moisch[1]."_NOAA.txt";

if ($vide==1) 
{
	echo"<Font size='5'><b>$titre</b><br></Font>";
}
echo"
<form method='get' action='NOAA.php'>
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
for ($i=PREMIERE_ANNEE;$i<=date('Y');$i++) 
{
    echo "<option>$i";
}
echo "
</select>
<input type='hidden' name='period' value='r_mensuel'>
";
echo "<input type='submit' value='Go'></form>";
if ($vide==0) 
{
	echo "<Font size='5'><b>$titre</b></Font>";
}
 
if ($vide==1) {exit;}

$spaces = array("     ","    ","   ","  ");
$space = array(" "," "," "," ");

include ('LectMensNOAA1.inc.php');



###################
# Affichage Final #
###################




echo "<Table class='rap1'  border=1><TR><td width=900>";
include "rapport_m1.php";



echo '</td>';
$xtitre=$lexday;
$Xlab=$xlabel;
$mensuel=true;
$monstep='2';
include "traceH1.php";

for ($index=1; $index<2; $index++) 
{
echo "</TD></tr><tr><td>
<br>
<Table border=1 width=900>
  <TR bgcolor='#aaaaaa'>
    <TD width=443>
	<UL>
	<LI><B>$lx_temp</B>
		<UL class='rap2' >
		<LI>$lx_temp_avg_mth : <span class='stylegrosrouge'>$meantemp_m[$index] °C</span>
		<LI>$lx_temp_avg_min: <span class='stylegrosrouge'>$meantemp_min[$index] °C</span>
		<LI>$lx_temp_avg_max: <span class='stylegrosrouge'>$meantemp_max[$index] °C</span>
		<LI>$lx_tn_mth : <span class='stylegrosrouge'>$lowtemp_m[$index] °C</span>$lx_on<span class='stylegrosrouge'>$jourlowtemp_m[$index]</span>
		<LI>$lx_tx_mth : <span class='stylegrosrouge'>$hightemp_m[$index] °C</span>$lx_on<span class='stylegrosrouge'>$jourhightemp_m[$index]</span>
		<LI>$lx_amp_min : <span class='stylegrosrouge'>$amplitude_min[$index] °C</span>$lx_on<span class='stylegrosrouge'>$jour_amplitude_min[$index]</span>
		<LI>$lx_amp_max : <span class='stylegrosrouge'>$amplitude_max[$index] °C</span>$lx_on<span class='stylegrosrouge'>$jour_amplitude_max[$index]</span><BR>
		</UL>
	</UL>

	</td><td width=443>
	<UL>
	<LI><B>$lx_rain</B>
		<UL class='rap2' >
		<LI>$lx_rain_mth : <span class='stylegrosrouge'>$rain_m[$index] mm</span>
		<LI>$lx_rain_day_max <span class='stylegrosrouge'>$maxrain[$index] mm</span>$lx_on<span class='stylegrosrouge'>$jourmaxrain[$index]</span>
		</UL>
	</UL>
		<UL>
	<LI><B>$lx_wind</B>
		<UL class='rap2' >
		<LI>$lx_wind_avg_mth :&nbsp<span class='stylegrosrouge'>$ventmoyen_m[$index] km/h </span>de secteur <span class='stylegrosrouge'>$domdir_m[$index] </span>
		<LI>$lx_wind_max : <span class='stylegrosrouge'>$maxvent[$index] km/h</span>$lx_on<span class='stylegrosrouge'>$jour_vent_max[$index]</span>
		<LI>$lx_raf_max : <span class='stylegrosrouge'>$rafales_m[$index] km/h</span>$lx_on<span class='stylegrosrouge'>$jour_rafales_m[$index]</span>
		<LI>$lx_windy_days ($lx_raf>36 km/h) : <span class='stylegrosrouge'>$venteux[$index]</span>";
		if (MISTRAL=="TRUE"){echo "<LI>$lx_mistral_days ($lx_raf>50 km/h) : <span class='stylegrosrouge'>$venteux_mistral[$index]</span>";}
		echo "</UL>
	</UL>";

	echo "
    </td>
  </tr>
</table>
<br>

<table class='rap2'  border=1 width=900>
  <tr bgcolor='#aaaaaa' rawspan='2'>
    <td colspan='2'>
	<span class='stylegros'><center>$lx_days_nr $moisA[$index] $annee[$index]</center></span>
    </td>
  </tr>
  <tr bgcolor='#cccccc'>
    <td width=442 align='center'>
	<table border='0'>
	<tr><td>$lx_day_freeze_nb :</td><td><span class='stylegrosrouge'>$gel[$index]</span></td></tr>
	<tr><td>$lx_day_deep_freeze_nb (<=-5) :</td><td><span class='stylegrosrouge'>$fortgel[$index]</span></td></tr>
	<tr><td>$lx_day_icy_nb :</td><td><span class='stylegrosrouge'>$sansdegel[$index]</span></td></tr>
	<tr><td>$lx_day_hot (>=30) :</td><td><span class='stylegrosrouge'>$chaleur[$index]</span></td></tr>
	<tr><td>$lx_day_heatwave (>=35) :</td><td><span class='stylegrosrouge'>$canicule[$index]</span></td></tr>
	</table>
    </td><td align='center' valign='middle'>
	<table border='0'>
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