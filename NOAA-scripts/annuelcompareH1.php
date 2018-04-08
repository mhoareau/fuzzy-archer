<?php 
date_default_timezone_set('Indian/Reunion');
#Version Universelle V2
$annee[1] = (isset ($_GET['annee1'])) ? $_GET['annee1'] : date("Y");
$annee[2]=$annee[1];
if ($annee[1]!="" ) 
{$vide=0;}
else 
{$vide=1;}


if ($vide==1) 
{
	$titre = "$lx_choice_yr";
}
else 
{
	/*$titre = "<HR width=50%>".$annee[1]."<BR><HR width=50%>";*/
}

if ($vide==1) 
{
	echo"<Font size='5'><b>$titre</b><br></Font>";
}
echo "
<form method='get' action='NOAA.php'>
<select size='1' name='annee1'>
<option value=''>$lx_yr";
for ($i=PREMIERE_ANNEE;$i<=date('Y');$i++) 
{
    echo "<option>$i";
}
echo "
</select>
<input type='hidden' name='period' value='r_annuel'>
<input type='submit' value='Go'>
</form>";

if ($vide==0) 
{
  echo"<Font size='5'><b>$titre</b></Font>";
  //if (FICHE_NORMALES=="TRUE") {echo"<Font size='1'><b>".COMMENT."</b></Font><BR>";  }
}
if ($vide==1) {exit;}




include ('GetYearlyData1.php');




###################
# Affichage Final #
###################


include "rapport_a1.php";

$xtitre='graphe annuel';
$mensuel=false;
$monstep='1';
$Xlab=$xlabel1;
$ecart=number_format($meantemp_y[$index]-22.65,1);
if ($ecart>=0) {$signe='+';} else {$signe='-';}
include "traceH1.php";
echo "</td>";
for ($index=1; $index<2; $index++) {

echo "<TD valign='top' >

<Table border=1  valign='top' width=900 class='rap1' >
<TR bgcolor='#aaaaaa'><td width=445>
  <UL>
	<LI><B>$lx_temp</B>
		<UL class='rap2'>
		<LI>$lx_temp_avg_yr : <span class='stylegrosrouge'>$meantemp_y[$index] °C</span>
		<LI>Ecart à la normale moyenne annuelle : <span class='stylegrosrouge'>$signe$ecart °C</span>
		<LI>$lx_tn_mth_avg : <span class='stylegrosrouge'>$meanmin_y[$index] °C</span>
		<LI>$lx_tx_mth_avg : <span class='stylegrosrouge'>$meanmax_y[$index] °C</span>
		<LI>$lx_tn_mth_avg_abs : <span class='stylegrosrouge'>$lowtemp_moy[$index] °C</span>
		<LI>$lx_tx_mth_avg_abs : <span class='stylegrosrouge'>$hightemp_moy[$index] °C</span>
		<LI>$lx_tn_year : <span class='stylegrosrouge'>$lowtemp_y[$index] °C</span>$lx_on<span class='stylegrosrouge'>".$jourlowtemp[$index][$moislowtemp_y[$index]-1]." ". $tabmois1[$moislowtemp_y[$index]-1]."</span>
		<LI>$lx_tx_year : <span class='stylegrosrouge'>$hightemp_y[$index] °C</span>$lx_on<span class='stylegrosrouge'>".$jourhightemp[$index][$moishightemp_y[$index]-1]." ".$tabmois1[$moishightemp_y[$index]-1]."</span>
		</UL>
	</UL>

	</td><td colspan=1  width=445 >
	<UL>
	<LI><B>$lx_rain</B>
		<UL class='rap2'>
		<LI>$lx_rain_yr : <span class='stylegrosrouge'>$totalrain_y[$index] mm</span>
		<LI>$lx_rain_day_max <span class='stylegrosrouge'>$maxpluie_y[$index] mm</span>$lx_on<span class='stylegrosrouge'>$jourmaxpluie_y[$index] $moismaxpluie_y[$index]</span>
		<LI><span class='stylegrosrouge'>$datemoispluiemax[$index]</span> $lx_rainy_most <span class='stylegrosrouge'>$moispluiemax[$index] mm</span>
		</UL>
	</UL>
		<UL>
	<LI><B>$lx_wind</B>
		<UL class='rap2'>		<LI>$lx_wind_avg_yr : <span class='stylegrosrouge'>$ventmoyen_y[$index] km/h</span> $lx_wind_sect <span class='stylegrosrouge'>$domdir_y[$index] </span>
		<LI><span class='stylegrosrouge'>$mois_vent_max[$index]</span> $lx_windy_most <span class='stylegrosrouge'>$maxventmoyen[$index] km/h</span> 
		<LI>$lx_raf_max : <span class='stylegrosrouge'>$rafales_y[$index] km/h</span>$lx_on<span class='stylegrosrouge'>$jourrafales_y[$index] $moisrafales_y[$index]</span>
		<LI>$lx_windy_days ($lx_raf>36 km/h) : <span class='stylegrosrouge'>$venteux[$index]</span>";
		if (MISTRAL=="TRUE"){echo "<LI>$lx_mistral_days (rafales>50 km/h) : <span class='stylegrosrouge'>$venteux_mistral[$index]</span>";}
		echo "</UL>
	</UL>"
;
	if (SONDE_SOL=="TRUE") {echo "
	<UL>	
		<LI><B>$lx_sunny</B>
		<UL class='rap2'>
		<LI>$lx_nrj_yr <span class='stylegrosrouge'>$soleilnrj[$index] kWh</span>
		<LI>$lx_rad_day_avg <span class='stylegrosrouge'>$soleilrad[$index] W/m²</span>
		<LI>$lx_sunny_yr <span class='stylegrosrouge'>$soleil_y[$index] h</span> ($lx_watt_m2)
		<LI>$lx_sunny_mth_avg <span class='stylegrosrouge'>$soleil_moy[$index] h</span> ($lx_watt_m2)
		<LI><span class='stylegrosrouge'>$moismaxsoleil[$index]</span>$lx_sunny_most<span class='stylegrosrouge'>$maxsoleil[$index] h</span>
		</UL>
	</UL>";}
	echo "
    </td>
  </tr>
  </table>
  <br/>
  <Table border=1  valign='top' width=900 class='rap1' style='border:1px'>
  <tr>

  <tr bgcolor='#aaaaaa' rawspan='2'>
    <td colspan='2'><Font color='black' size='2'>
	<b><center>$lx_days_nr $annee[$index]</center></b>
    </td>
  </tr>
  <tr class='rap2' width=445 bgcolor='#cccccc'>
    <td colspan=1 align='center'>
	<table border='0'>
	<tr><td>$lx_day_freeze_nb:</td><td><span class='stylegrosrouge'>$gel_y[$index]</span></td></tr>
	<tr><td>$lx_day_deep_freeze_nb (<=-5) :</td><td><span class='stylegrosrouge'>$fortgel_y[$index]</span></td></tr>
	<tr><td>$lx_day_icy_nb :</td><td><span class='stylegrosrouge'>$sansdegel_y[$index]</span></td></tr>
	<tr><td>$lx_day_hot (>=30) :</td><td><span class='stylegrosrouge'>$chaleur_y[$index]</span></td></tr>
	<tr><td>$lx_day_heatwave (>=35) :</td><td><span class='stylegrosrouge'>$canicule_y[$index]</span></td></tr>
	</table>
    </td>
    <td  width=445 align='center' valign='middle' colspan=1>
	<table border='0'>
	<tr><td>$lx_rainy_day :</td><td><span class='stylegrosrouge'>$pluie_y[$index]</span></td></tr>
	<tr><td>$lx_rain_1to5 :</td><td><span class='stylegrosrouge'>$pluie_y1[$index]</span></td></tr>
	<tr><td>$lx_rain_5to10 :</td><td><span class='stylegrosrouge'>$pluie_y5[$index]</span></td></tr>
	<tr><td>$lx_rain_over10 :</td><td><span class='stylegrosrouge'>$pluie_y10[$index]</span></td></tr>
	</table>
    </td>
  </tr>
</table>
</TD>";
}
echo "</TR></Table></Center>";
?></HEAD>
