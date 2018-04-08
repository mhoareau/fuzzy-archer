<?php
date_default_timezone_set('Indian/Reunion');
#Version Universelle V2
$annee[1] = (isset ($_GET['annee1'])) ? $_GET['annee1'] : "";
$annee[2] = (isset ($_GET['annee2'])) ? $_GET['annee2'] : "";

if ($annee[1]=="" && $annee[2]=="") {$vide=1;} else {$vide=0;}
if ($annee[1]=="") {$annee[1]=date('Y');}
if ($annee[2]=="") {$annee[2]=date('Y');}

if (TYPE_NOAA == "GW") 
{
	$fichier[1] = "../Statistics1/".$annee[1]."_NOAA.txt";
	$fichier[2] = "../Statistics1/".$annee[2]."_NOAA.txt";
}
if (TYPE_NOAA == "WL") 
{
	if ($annee[1]==date("Y")) 
	{
		$fichier[1]=REP_NOAA."NOAAYR.TXT";
	}
    else 
	{
		$fichier[1] = REP_NOAA.$annee[1].".TXT";
	}
	if ($annee[2]==date("Y")) 
	{
		$fichier[2]=REP_NOAA."NOAAYR.TXT";
	}
    else 
	{
		$fichier[2] = REP_NOAA.$annee[2].".TXT";
	}
}
if (TYPE_NOAA == "AUTRE") 
{
	$fichier[1] = REP_NOAA.$annee[1].".TXT";
	$fichier[2] = REP_NOAA.$annee[2].".TXT";
}

if ($vide==1) 
{
	$titre = "$lx_choice_yrs";
}
else 
{
	$titre = "<HR width=50%>$lx_comp".$annee[1].$lx_with.$annee[2]."<BR><HR width=50%>";
}

if ($vide==1) 
{
	echo"<Font size='5'><b>$titre</b><br></Font>";
}
echo "
<form method='get' action='NOAA.php'>
$lx_comp_r
<select size='1' name='annee1'>
<option value=''>$lx_yr";
for ($i=PREMIERE_ANNEE;$i<=date('Y');$i++) 
{
    echo "<option>$i";
}
echo "
</select> $lx_with
<select size='1' name='annee2'>
  <option value=''>$lx_yr";
for ($i=PREMIERE_ANNEE;$i<=date('Y');$i++) 
{
    echo "<option>$i";
}
echo "
</select>
<input type='hidden' name='period' value='c_annuel'>
<input type='submit' value='Go'>
</form>";
if ($vide==0) 
{
  echo"<Font size='5'><b>$titre</b></Font>";
  //if (FICHE_NORMALES=="TRUE") {echo"<Font size='1'><b>".COMMENT."</b></Font><BR>";  }
}

if ($vide==1) {exit;}

for ($index=1; $index<3; $index++) 
	{

	$fp = @fopen ("$fichier[$index]",'r') or die("<BR><Div class='titre'>$lx_no_data1 $mois[$index] $annee[$index] <BR>$lx_no_data2</Div>");
	$content = fread ($fp,filesize("$fichier[$index]"));
	fclose($fp);
	$content = str_replace(",",".",$content);
	$content = str_replace("\r","",$content);
	$separ_1 = explode("----------\n",$content); 
 
	$bilan =" ".$separ_1[2];
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value2 = explode(" ",$bilan[0]);
	$meanmax_y[$index] = $value2[1];
	$meanmin_y[$index] = $value2[2];
	$meantemp_y[$index] = $value2[3];
	$highttemp_y[$index] = $value2[7];
	$moishightemp_y[$index] = $value2[8];
	$lowtemp_y[$index] = $value2[9];
	$moislowtemp_y[$index] = $value2[10];
	$canicule_y[$index] = $value2[11];

	
	$bilan =" ".$separ_1[4];
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value4 = explode(" ",$bilan[0]);
	$totalrain_y[$index] = $value4[1]*1;
	$maxpluie_y[$index] = $value4[3]*1;
	$moismaxpluie_y[$index] = $value4[4];
    $moismaxpluie_y[$index] = $tabmois[$tabmois3[$moismaxpluie_y[$index]][1]-1];


	
	
	$bilan =" ".$separ_1[6];
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value6 = explode(" ",$bilan[0]);
	$ventmoyen_y[$index] = $value6[1];
	$rafales_y[$index] = $value6[2];
	$moisrafales_y[$index] = $value6[3];
    $moisrafales_y[$index] = $tabmois[$tabmois3[$moisrafales_y[$index]][1]-1];
	//	$dir_y = str_replace($char,$newchar,$value6[4]);


	$domdir_y[$index] =  str_replace("W","O",$value6[4]);

	
	$bilan =" ".$separ_1[5];
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value5 = explode(" ",$bilan[0]);
	$domdir_y[$index] =  str_replace("W","O",$value5[6]);	


	
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
	
	
	
if ($domdir_y[$index] =="N" ) {$compteur_N[$index]++;}
if ($domdir_y[$index] =="NNE" ) {$compteur_NNE[$index]++;}
if ($domdir_y[$index] =="NE" ) {$compteur_NE[$index]++;}
if ($domdir_y[$index] =="ENE" ) {$compteur_ENE[$index]++;}
if ($domdir_y[$index] =="E" ) {$compteur_E[$index]++;}
if ($domdir_y[$index] =="ESE" ) {$compteur_ESE[$index]++;}
if ($domdir_y[$index] =="SE" ) {$compteur_SE[$index]++;}
if ($domdir_y[$index] =="SSE" ) {$compteur_SSE[$index]++;}
if ($domdir_y[$index] =="S" ) {$compteur_S[$index]++;}
if ($domdir_y[$index] =="SSO" ) {$compteur_SSO[$index]++;}
if ($domdir_y[$index] =="SO" ) {$compteur_SO[$index]++;}
if ($domdir_y[$index] =="OSO" ) {$compteur_OSO[$index]++;}
if ($domdir_y[$index] =="O" ) {$compteur_O[$index]++;}
if ($domdir_y[$index] =="ONO" ) {$compteur_ONO[$index]++;}
if ($domdir_y[$index] =="NO" ) {$compteur_NO[$index]++;}
if ($domdir_y[$index] =="NNO" ) {$compteur_NNO[$index]++;}

$nbvalvent[$index]=$compteur_N[$index]+$compteur_NNE[$index]+$compteur_NE[$index]+$compteur_ENE[$index]+$compteur_E[$index]+$compteur_ESE[$index]+$compteur_SE[$index]+$compteur_SSE[$index]+$compteur_S[$index]+$compteur_SSO[$index]+$compteur_SO[$index]+$compteur_OSO[$index]+$compteur_O[$index]+$compteur_ONO[$index]+$compteur_NO[$index]+$compteur_NNO[$index];
$wind_d_N[$index]=number_format($compteur_N[$index]/$nbvalvent[$index], 2);
$wind_d_NNE[$index]=number_format($compteur_NNE[$index]/$nbvalvent[$index], 2);
$wind_d_NE[$index]=number_format($compteur_NE[$index]/$nbvalvent[$index], 2);
$wind_d_ENE[$index]=number_format($compteur_ENE[$index]/$nbvalvent[$index], 2);
$wind_d_E[$index]=number_format($compteur_E[$index]/$nbvalvent[$index], 2);
$wind_d_ESE[$index]=number_format($compteur_ESE[$index]/$nbvalvent[$index], 2);
$wind_d_SE[$index]=number_format($compteur_SE[$index]/$nbvalvent[$index], 2);
$wind_d_SSE[$index]=number_format($compteur_SSE[$index]/$nbvalvent[$index], 2);
$wind_d_S[$index]=number_format($compteur_S[$index]/$nbvalvent[$index], 2);
$wind_d_SSO[$index]=number_format($compteur_SSO[$index]/$nbvalvent[$index], 2);
$wind_d_SO[$index]=number_format($compteur_SO[$index]/$nbvalvent[$index], 2);
$wind_d_OSO[$index]=number_format($compteur_OSO[$index]/$nbvalvent[$index], 2);
$wind_d_O[$index]=number_format($compteur_O[$index]/$nbvalvent[$index], 2);
$wind_d_ONO[$index]=number_format($compteur_ONO[$index]/$nbvalvent[$index], 2);
$wind_d_NO[$index]=number_format($compteur_NO[$index]/$nbvalvent[$index], 2);
$wind_d_NNO[$index]=number_format($compteur_NNO[$index]/$nbvalvent[$index], 2);


    $wind_d[$index][0] = $wind_d_N[$index]*100;
	$wind_d[$index][1] = $wind_d_NNE[$index]*100;
	$wind_d[$index][2] = $wind_d_NE[$index]*100;
	$wind_d[$index][3] = $wind_d_ENE[$index]*100;
	$wind_d[$index][4] = $wind_d_E[$index]*100;
    $wind_d[$index][5] = $wind_d_ESE[$index]*100;
	$wind_d[$index][6] = $wind_d_SE[$index]*100;
	$wind_d[$index][7] = $wind_d_SSE[$index]*100;
	$wind_d[$index][8] = $wind_d_S[$index]*100;
	$wind_d[$index][9] = $wind_d_SSO[$index]*100;
	$wind_d[$index][10] = $wind_d_SO[$index]*100;
	$wind_d[$index][11] = $wind_d_OSO[$index]*100;
	$wind_d[$index][12] = $wind_d_O[$index]*100;
	$wind_d[$index][13] = $wind_d_ONO[$index]*100;
	$wind_d[$index][14] = $wind_d_NO[$index]*100;
	$wind_d[$index][15] = $wind_d_NNO[$index]*100;	

#Récupération de l'$lx_sunny total
	$fichiersun = REP_GW.$annee[$index]."/".$annee[$index].".xml";
	if (file_exists($fichiersun) && SONDE_SOL=="TRUE") 
	{
		$fp2 = fopen ("$fichiersun","r");
		$content2 = fread ($fp2,filesize("$fichiersun"));
		fclose ($fp2);
		$z=strpos($content2, '<nb-hours-of-sunshine>');
		if ($z>1) {$ver='V2';} else{$ver='V3';}
		if ($ver=="V2") 
		{
			$valeur = strstr($content2,"<nb-hours-of-sunshine");
			$soleil_y[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($valeur,20,8));
			$valeur = strstr($content2,"<total-solar-energy");
			$soleilnrj[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($valeur,20,8));
			$valeur = strstr($content2,"<solar_radiation>");
			$val1 = strstr($valeur,"<mean>");
			$soleilrad[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,6,10));
		}
		else
		{
			$valeur = strstr($content2,"<nb-hours-of-sunshine");
			$val1 = strstr($valeur,"value=");
			$soleil_y[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,6));
			$valeur = strstr($content2,"<total-solar-energy");
			$val1 = strstr($valeur,"value=");
			$soleilnrj[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8));
			$valeur = strstr($content2,"<solar_radiation");
			$val1 = strstr($valeur,"mean=");
			$soleilrad[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,10));
		}
	}


	$nb1 = substr_count ($separ_1[1], "\n");
	$nb2 = substr_count ($separ_1[3], "\n");
	$nb3 = substr_count ($separ_1[5], "\n");

#########################################
# Décompte des jours de pluie et de gel #
#########################################
	$gel_y[$index] = 0;
	$sansdegel_y[$index] = 0;
	$fortgel_y[$index] = 0;
	$chaleur_y[$index] = 0;
	$canicule_y[$index] = 0;
	$pluie_y[$index] = 0;
	$pluie_y1[$index] = 0;
	$pluie_y5[$index] = 0;
	$pluie_y10[$index] = 0;
	$venteux[$index] = 0;
	$venteux_mistral[$index] = 0;

	for ($m=1; $m < 13; $m++) 
	{
		$m = substr((100+$m),1);
		if (TYPE_NOAA == "GW") 
		{
			$file = "../Statistics1/".$annee[$index]."_".$m."_NOAA.txt";
		}
		if (TYPE_NOAA == "WL") 
		{
			if ($m==date("m") && $annee[$index]==date("Y")) 
			{
				$file=REP_NOAA."NOAAMO.TXT";
			}
			else 
			{
				$file = REP_NOAA.$tabmois[$m-1]."-".$annee[$index].".TXT";
			}
		}
		if (TYPE_NOAA == "AUTRE") 
		{
			$file = REP_NOAA.$tabmois[$m-1]."-".$annee[$index].".TXT";
		}

		if (file_exists($file)) 
		{
			$fp = fopen ("$file","r");
			$contenu = fread ($fp,filesize("$file"));
			fclose ($fp);
			  $contenu = str_replace(",",".",$contenu);
			$contenu = str_replace("\r","",$contenu);
			$par_1 = explode("----------\n",$contenu); 
			$par_2 = explode("\n----------",$par_1[1]); 
			$nbre = substr_count ($par_2[0], "\n");
			$ligne = explode("\n",$par_2[0]);

			for ($i=0; $i<$nbre+1; $i++) 
			{
				$ligne[$i] =" ".$ligne[$i];
				$ligne[$i] = str_replace($spaces,$space,$ligne[$i]);
				$value = explode(" ",$ligne[$i]);
				if (count($value)>2) 
				{
					$r = $value[9];
					if ($r >'0' && $r !="") {$pluie_y[$index]=$pluie_y[$index]+1;} else {$pluie_y[$index]=$pluie_y[$index];}
					if ($r >='1' && $r !="") {$pluie_y1[$index]=$pluie_y1[$index]+1;} else {$pluie_y1[$index]=$pluie_y1[$index];}
					if ($r >='5' && $r !="") {$pluie_y5[$index]=$pluie_y5[$index]+1;} else {$pluie_y5[$index]=$pluie_y5[$index];}
					if ($r >='10' && $r !="") {$pluie_y10[$index]=$pluie_y10[$index]+1;} else {$pluie_y10[$index]=$pluie_y10[$index];}
					$t = $value[5];
					if ($t <='0'&& $t !="") {$gel_y[$index]=$gel_y[$index]+1;} else {$gel_y[$index]=$gel_y[$index];}
					if ($t <='-5'&& $t !="") {$fortgel_y[$index]=$fortgel_y[$index]+1;} else {$fortgel_y[$index]=$fortgel_y[$index];}
					$th = $value[3];
					if ($th <='0'&& $t !="") {$sansdegel_y[$index]=$sansdegel_y[$index]+1;} else {$sansdegel_y[$index]=$sansdegel_y[$index];}
					if ($th >='30'&& $th !="") {$chaleur_y[$index]=$chaleur_y[$index]+1;} else {$chaleur_y[$index]=$chaleur_y[$index];}
					if ($th >='35'&& $th !="") {$canicule_y[$index]=$canicule_y[$index]+1;} else {$canicule_y[$index]=$canicule_y[$index];}
					$dd =  str_replace("W","O",$value[13]);
					if ($value[11]>36) {$venteux[$index]++;}
					if ($value[11]>=50 && ($dd=='NE' or $dd=='NNE' or $dd=='N' or $dd=='NNO' or $dd=='NO' )) 
					{
						$venteux_mistral[$index]++; 
					}  
				}
			}

		}
	}

###############################
#Recherche des autres extrèmes#
###############################
	$minmeanmin[$index] = 100;
	$maxmeanmin[$index] = -100;
	$maxmeanmax[$index] = -100;
	$minmeanmax[$index] = 100;
	$maxmeantemp[$index] = -100;
	$minmeantemp[$index] = 100;
	$minhighttemp_y[$index] = 100;
	$maxlowtemp_y[$index] = -100;
	$maxsoleil[$index] = 0;
	$maxtotalrain[$index] = 0;
	$maxraindays[$index] = 0;
	$maxventmoyen[$index] = 0;
	$lowtemptotal[$index] = 0;
	$hightemptotal[$index] = 0;
	$soleiltotal[$index] = 0;
	$geltotal[$index] = 0;
	
	$line = explode("\n",$separ_1[1]);
	for ($i=0; $i<$nb1; $i++) 
	{
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);
 
 
		$mois = $value[2]; 
		$moisch = substr((100+$mois),1);
		If (count($value)>3) 
		{
			$meanmax = $value[3];
			$meanmin = $value[4];
			$meantemp = $value[5];
			$highttemp = $value[9];
			$v=$moishightemp_y[$index];
			if (($mois*1)==$tabmois3[$v][1]) 
			{
				$jourhightemp_y[$index] = $value[10];
			}
			$lowtemp = $value[11];
			$v=$moislowtemp_y[$index];
			if ($mois==$tabmois3[$v][1]) 
			{
				$jourlowtemp_y[$index] = $value[12];
			}
			$moislowtemp[$index]=$tabmois[$tabmois3[$moislowtemp_y[$index]][1]-1];
			$moishightemp[$index]=$tabmois[$tabmois3[$moishightemp_y[$index]][1]-1];

			$gel = $value[15];

			if ($meanmin < $minmeanmin[$index] && $meanmin!="") {$minmeanmin[$index]=$meanmin;}
			if ($meanmin > $maxmeanmin[$index] && $meanmin!="") {$maxmeanmin[$index]=$meanmin;}
			if ($meanmax > $maxmeanmax[$index] && $meanmax!="") {$maxmeanmax[$index]=$meanmax;}
			if ($meanmax < $minmeanmax[$index] && $meanmax!="") {$minmeanmax[$index]=$meanmax;}
			if ($meantemp > $maxmeantemp[$index] && $meantemp!="") {$maxmeantemp[$index]=$meantemp;}
			if ($meantemp < $minmeantemp[$index] && $meantemp!="") {$minmeantemp[$index]=$meantemp;}
			if ($highttemp < $minhighttemp_y[$index] && $highttemp!="") {$minhighttemp_y[$index] = $highttemp;}
			if ($lowtemp > $maxlowtemp_y[$index] && $lowtemp!="") {$maxlowtemp_y[$index] = $lowtemp;}

			if ($annee[$index]==PREMIERE_ANNEE && $mois>=PREMIER_MOIS) 
			{
				$lowtemptotal[$index] = $lowtemptotal[$index]+$lowtemp;
				$lowtemp_moy[$index] = round(($lowtemptotal[$index]/($mois-PREMIER_MOIS+1)), 1);}
			else 
			{
				$lowtemptotal[$index] = $lowtemptotal[$index]+$lowtemp;
				$lowtemp_moy[$index] = round(($lowtemptotal[$index]/$mois), 1);
			}
      
			if ($annee[$index]==PREMIERE_ANNEE && $mois>=PREMIER_MOIS) 
			{
				$hightemptotal[$index] = $hightemptotal[$index]+$highttemp;
				$hightemp_moy[$index] = round(($hightemptotal[$index]/($mois-PREMIER_MOIS+1)), 1);
			}
			else 
			{
				$hightemptotal[$index] = $hightemptotal[$index]+$highttemp;
				$hightemp_moy[$index] = round(($hightemptotal[$index]/$mois), 1);
			}
		}
	}


		$premsraf=0;
		$line3 = explode("\n",$separ_1[5]);
		for ($i=0; $i<$nb3; $i++)
		{
			$line3[$i] =" ".$line3[$i];
			$line3[$i] = str_replace($spaces,$space,$line3[$i]);
			$value = explode(" ",$line3[$i]);		
			if (count($value)>3) 
			{
				$ventmoyen = $value[3]*1;
				if ($ventmoyen > $maxventmoyen[$index] && $ventmoyen!="")
				{
					$maxventmoyen[$index]=$ventmoyen;
					$mois_vent_max[$index]=$tabmois[$value[2]-1];
				}
				$rafale = $value[4]*1;
				if ($rafale == $rafales_y[$index] && $rafale!="" && $premsraf=="0")
				{
					$jourrafales_y[$index]=$value[5];
					$premsraf = 1;
				}
				$dir[$index][$i] =   str_replace("W","O",$value[6]);


			}
		}
		
		
		
		
		$premsrain=0; $moispluiemax[$index] = 0;
		$line2 = explode("\n",$separ_1[3]);
		for ($i=0; $i<$nb2; $i++)
		{
			$line2[$i] =" ".$line2[$i];
			$line2[$i] = str_replace($spaces,$space,$line2[$i]);
			$value = explode(" ",$line2[$i]);

			if (count($value)>3) 
			{
					$maxrainmonth = $value[5];
					$rainmonth = $value[3];
					if ($maxrainmonth == $maxpluie_y[$index] && $maxrainmonth!="" && $premsrain=="0")
					{
						$jourmaxpluie_y[$index]=$value[6];
						$premsrain = 1;
					}
					if ($rainmonth > $moispluiemax[$index] && $rainmonth!="") 
					{
						$moispluiemax[$index]=$rainmonth;
						$datemoispluiemax[$index]=$tabmois1[$value[2]-1];
					}
			}
		}
	
}
$xtitre='graphe annuel';
$mensuel=false;
$monstep='1';
$Xlab=$xlabel1;
include "traceH.php";
###################
# Affichage Final #
###################

echo"<Table border=0><TR>";
for ($index=1; $index<3; $index++) {
echo "<TD>
<br>
<Table  class='rap1'  border=1 width=450>
  <TR bgcolor='#aaaaaa'>
    <TD><Font color='black' size='2'>
	<br><center><B><U><I><Font size='4'>$annee[$index]</Font></I></U></B></Center>";
	if ($annee[$index]==PREMIERE_ANNEE) {echo "<Font color='black' size='1'><Center>$lx_start $lx_on". PREMIER_JOUR." ".$tabmois[PREMIER_MOIS-1]." ".PREMIERE_ANNEE."</Center></Font>";}
     else {echo "<Font color='black' size='1'><Center>&nbsp</Center></Font>";}
echo "
  <UL>
	<LI><B>$lx_temp</B>
		<UL class='rap2'>
		<LI>$lx_temp_avg_yr : <span class='stylegrosrouge'>$meantemp_y[$index] °C</span>
		<LI>$lx_tn_mth_avg : <span class='stylegrosrouge'>$meanmin_y[$index] °C</span>
		<LI>$lx_tx_mth_avg : <span class='stylegrosrouge'>$meanmax_y[$index] °C</span>
		<LI>$lx_tn_mth_avg_abs : <span class='stylegrosrouge'>$lowtemp_moy[$index] °C</span>
		<LI>$lx_tx_mth_avg_abs : <span class='stylegrosrouge'>$hightemp_moy[$index] °C</span>
		<LI>$lx_tn_year : <span class='stylegrosrouge'>$lowtemp_y[$index] °C</span>$lx_on<span class='stylegrosrouge'>".$jourlowtemp_y[$index]." ". $moislowtemp[$index]."</span>
		<LI>$lx_tx_year : <span class='stylegrosrouge'>$highttemp_y[$index] °C</span>$lx_on<span class='stylegrosrouge'>".$jourhightemp_y[$index]." ".$moishightemp[$index]."</span>
		</UL>
	</UL>
	<UL>
	<LI><B>$lx_wind</B>
		<UL class='rap2'>
		<LI>$lx_wind_avg_yr : <span class='stylegrosrouge'>$ventmoyen_y[$index] km/h</span> $lx_wind_sect <span class='stylegrosrouge'>$domdir_y[$index] </span>
		<LI><span class='stylegrosrouge'>$mois_vent_max[$index]</span> $lx_windy_most <span class='stylegrosrouge'>$maxventmoyen[$index] km/h</span> 
		<LI>$lx_raf_max : <span class='stylegrosrouge'>$rafales_y[$index] km/h</span>$lx_on<span class='stylegrosrouge'>$jourrafales_y[$index] $moisrafales_y[$index]</span>
		<LI>$lx_windy_days ($lx_raf>36 km/h) : <span class='stylegrosrouge'>$venteux[$index]</span>";
		if (MISTRAL=="TRUE"){echo "<LI>$lx_mistral_days ($lx_raf>50 km/h) : <span class='stylegrosrouge'>$venteux_mistral[$index]</span>";}
		echo "</UL>
	</UL>
	<UL>
	<LI><B>Pluie</B>
		<UL class='rap2'>
		<LI>$lx_rain_yr : <span class='stylegrosrouge'>$totalrain_y[$index] mm</span>
		<LI>$lx_rain_day_max <span class='stylegrosrouge'>$maxpluie_y[$index] mm</span>$lx_on<span class='stylegrosrouge'>$jourmaxpluie_y[$index] $moismaxpluie_y[$index]</span>
		<LI><span class='stylegrosrouge'>$datemoispluiemax[$index]</span> $lx_rainy_most <span class='stylegrosrouge'>$moispluiemax[$index] mm</span>
		</UL>
	</UL>
	<UL>";
	if (SONDE_SOL=="TRUE") {echo "
	<LI><b>$lx_sunny</B>
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
<br>

<table class='rap1' border=1 width=450>
  <tr bgcolor='#aaaaaa' rawspan='2'>
    <td colspan='2'>
	<b><center>$lx_days_nr $annee[$index]</center></b>
    </td>
  </tr>
  <tr bgcolor='#cccccc'>
    <td align='center'>
	<table class='rap2' border='0'>
	<tr><td>$lx_day_freeze_nb:</td><td><span class='stylegrosrouge'>$gel_y[$index]</span></td></tr>
	<tr><td>$lx_day_deep_freeze_nb (<=-5) :</td><td><span class='stylegrosrouge'>$fortgel_y[$index]</span></td></tr>
	<tr><td>$lx_day_icy_nb :</td><td><span class='stylegrosrouge'>$sansdegel_y[$index]</span></td></tr>
	<tr><td>$lx_day_hot (>=30) :</td><td><span class='stylegrosrouge'>$chaleur_y[$index]</span></td></tr>
	<tr><td>$lx_day_heatwave (>=35) :</td><td><span class='stylegrosrouge'>$canicule_y[$index]</span></td></tr>
	</table>
    </td>
    <td align='center' valign='middle'>
	<table class='rap2' border='0'>
	<tr><td>$lx_rainy_day :</td><td><span class='stylegrosrouge'>$pluie_y[$index]</span></td></tr>
	<tr><td>$lx_rain_1to5 :</td><td><span class='stylegrosrouge'>$pluie_y1[$index]</span></td></tr>
	<tr><td>$lx_rain_5to10  :</td><td><span class='stylegrosrouge'>$pluie_y5[$index]</span></td></tr>
	<tr><td>$lx_rain_over10  :</td><td><span class='stylegrosrouge'>$pluie_y10[$index]</span></td></tr>
	</table>
    </td>
  </tr>
</table>
</TD>";
}
echo "</TR></Table></Center>";
?></HEAD>
