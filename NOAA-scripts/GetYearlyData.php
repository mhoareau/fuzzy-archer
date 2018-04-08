<?php
#####################################
# Récupération des noms de fichiers #
#####################################
if ($annee[1]=="") {$annee[1]=date('Y');}
if ($annee[2]=="") {$annee[2]=date('Y');}
$fichier3= array(3);
if (TYPE_NOAA == "GW") {
  $fichier3[1] = "../Statistics1/".$annee[1]."_NOAA.txt";
  $fichier3[2] = "../Statistics1/".$annee[2]."_NOAA.txt";}

if (TYPE_NOAA == "WL") {
  if ($annee[1]==date("Y")) {$fichier[1]=REP_NOAA."NOAAYR.TXT";}
    else {$fichier[1] = REP_NOAA.$annee[1].".TXT";}
  if ($annee[2]==date("Y")) {$fichier[2]=REP_NOAA."NOAAYR.TXT";}
    else {$fichier[2] = REP_NOAA.$annee[2].".TXT";}}
if (TYPE_NOAA == "AUTRE") {
  $fichier[1] = REP_NOAA.$annee[1].".TXT";
  $fichier[2] = REP_NOAA.$annee[2].".TXT";}

##########################
#Récupération des données#
##########################
$meanmax = array(array(0),array(0));
$meanmin = array(array(0),array(0));
$meantemp =array(array(0),array(0));
$hightemp = array(array(0),array(0));
$lowtemp =array(array(0),array(0));
$rain =array(array(0),array(0));
$soleil =array(array(0),array(0));
$ventmoyen =array(array(0),array(0));
$rafales =array(array(0),array(0));
$uv_avg =array(array(0),array(0));
$uv_max =array(array(0),array(0));
$rad_max =array(array(0),array(0));
$rad_avg =array(array(0),array(0));
$rad_tot=array(array(0),array(0));
$wind_d= array(array(0),array(0));


for ($index=1; $index<3; $index++){
	$fp = fopen ($fichier3[$index],'r');
	$content = fread ($fp,filesize("$fichier3[$index]"));
	fclose ($fp);
	$content = str_replace("\r","",$content);
	$separ_1 = explode("----------\n",$content); 

	$nb1 = substr_count ($separ_1[1], "\n");
	$nb2 = substr_count ($separ_1[3], "\n");
	$nb3 = substr_count ($separ_1[5], "\n");

	$line = explode("\n",$separ_1[1]);
	//$xlabel = array("Jan","Fev","Mar","Avr","Mai","Juin","Juil","Aout","Sep","Oct","Nov","Dec");

// récupération dir $lx_wind
		$fichiervent = REP_GW.$annee[$index]."/".$annee[$index].".xml";

		if (file_exists($fichiervent)) {
			$fp = fopen ("$fichiervent","r");
			$content = fread ($fp,filesize("$fichiervent"));
			fclose ($fp);
			$z=strpos($content, '<total-rainfall>');
			if ($z>1) {$ver='V2';} else{$ver='V3';}
			if ($ver=="V2") 
			{
				$valeur = strstr($content,"<wind-direction-distribution>");
				$valeur = strstr($valeur,"<n>");
				$wind_d[$index][0] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,3,5))))*1;
				$valeur = strstr($valeur,"<nne>");
				$wind_d[$index][1] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
				$valeur = strstr($valeur,"<ne>");
				$wind_d[$index][2] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,4,5))))*1;
				$valeur = strstr($valeur,"<ene>");
				$wind_d[$index][3] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
				$valeur = strstr($valeur,"<e>");
				$wind_d[$index][4] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,3,5))))*1;
				$valeur = strstr($valeur,"<ese>");
				$wind_d[$index][5] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,3,5))))*1;
				$valeur = strstr($valeur,"<se>");
				$wind_d[$index][6] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,3,5))))*1;
				$valeur = strstr($valeur,"<sse>");
				$wind_d[$index][7] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
				$valeur = strstr($valeur,"<s>");
				$wind_d[$index][8] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,3,5))))*1;
				$valeur = strstr($valeur,"<ssw>");
				$wind_d[$index][9] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
				$valeur = strstr($valeur,"<sw>");
				$wind_d[$index][10] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,4,5))))*1;
				$valeur = strstr($valeur,"<wsw>");
				$wind_d[$index][11] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
				$valeur = strstr($valeur,"<w>");
				$wind_d[$index][12] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,3,5))))*1;
				$valeur = strstr($valeur,"<wnw>");
				$wind_d[$index][13] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
				$valeur = strstr($valeur,"<nw>");
				$wind_d[$index][14] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,4,5))))*1;
				$valeur = strstr($valeur,"<nnw>");
				$wind_d[$index][15] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,5,5))))*1;
			}
			else
			{//V3
				$valeur = strstr($content,"<wind-direction-distribution");		
				$val1 = strstr($valeur," n=");
				$wind_d[$index][0] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,3,8))))*1;
				$val1 = strstr($valeur," nne=");
				$wind_d[$index][1] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
				$val1 = strstr($valeur," ne=");
				$wind_d[$index][2] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
				$val1 = strstr($valeur," ene=");
				$wind_d[$index][3] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
				$val1 = strstr($valeur," e=");
				$wind_d[$index][4] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,3,8))))*1;
				$val1 = strstr($valeur," ese>");
				$wind_d[$index][5] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,3,8))))*1;
				$val1 = strstr($valeur," se=");
				$wind_d[$index][6] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,3,8))))*1;
				$val1 = strstr($valeur," sse=");
				$wind_d[$index][7] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
				$val1 = strstr($valeur," s=");
				$wind_d[$index][8] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,3,8))))*1;
				$val1 = strstr($valeur," ssw=");
				$wind_d[$index][9] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
				$val1 = strstr($valeur," sw=");
				$wind_d[$index][10] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
				$val1 = strstr($valeur," wsw=");
				$wind_d[$index][11] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
				$val1 = strstr($valeur," w=");
				$wind_d[$index][12] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,3,8))))*1;
				$val1 = strstr($valeur," wnw=");
				$wind_d[$index][13] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
				$val1 = strstr($valeur," nw=");
				$wind_d[$index][14] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
				$val1 = strstr($valeur," nnw=");
				$wind_d[$index][15] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
			}
	
		}



	for ($i=0; $i<$nb1; $i++)
	{
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);
		$mois = $value[2]; 
		$moisch = substr((100+$mois),1);
		$mois = str_replace(" ","",$mois); $mois = $tabmois[$mois-1];
		if (count($value)>2) {
			$meanmax[$index][$i] = $value[3]*1;
			$meanmin[$index][$i] = $value[4]*1;
			$meantemp[$index][$i] = $value[5]*1;
			$hightemp[$index][$i] = $value[9]*1;
			$lowtemp[$index][$i] = $value[11]*1;
		} 
		else 
		{
			$meanmax[$index][$i] = null;
			$meanmin[$index][$i] = null;
			$meantemp[$index][$i] = null;
			$hightemp[$index][$i] = null;
			$lowtemp[$index][$i] = null;
		}


#Récupération de l'$lx_sunny W/m²
		if (SONDE_SOL=="TRUE")
		{
			$fichier2 = REP_GW.$annee[$index]."/".$moisch."/".$annee[$index]."_".$moisch.".xml";
			if (file_exists($fichier2)) 
			{
				$fp2 = fopen ("$fichier2","r");
				$content2 = fread ($fp2,filesize("$fichier2"));
				fclose ($fp2);
				$z=strpos($content, '<total-rainfall>');
				if ($z>1) {$ver='V2';} else{$ver='V3';}
				if ($ver=="V2") 
				{

					$valeur = strstr($content2,"<total-solar-energy>");
					$rad_tot[$index][$i] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,20,6))))*1;
					$valeur = strstr($content2,"<uv_index>");
					$val1 = strstr($valeur,"<max>");
					$uv_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,6))))*1;
					$val1 = strstr($valeur,"<mean>");   
					$uv_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,6))))*1;
					$valeur = strstr($content2,"<solar_radiation");
					$val1 = strstr($valeur,"<max>");
					$rad_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
					$val1 = strstr($valeur,"<mean>");
					$rad_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
				}
				else
				{ 
					$valeur = strstr($content2,"<total-solar-energy");
					$val1 = strstr($valeur," value=");
					$rad_tot[$index][$i] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,7,6))))*1;
					$valeur = strstr($content2,"<uv_index");
					$val1 = strstr($valeur," max=");
					$uv_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,6))))*1;
					$val1 = strstr($valeur," mean=");   
					$uv_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,6))))*1;
					$valeur = strstr($content2,"<solar_radiation");
					$val1 = strstr($valeur," max=");
					$rad_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
					$val1 = strstr($valeur," mean=");
					$rad_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,4,8))))*1;
				}
			}
			else {$soleil[$index][$i]="";}
		}
	}



			if (SONDE_SOL=="TRUE") 
		{
			$max_mois=0;
			$mois_max=0;
			$x=0;
			for ($i=1; $i<13; $i++)
			{
					$m_xml= substr((100+$i),1);
					$fichsol = REP_GW.$annee[$index]."/".$m_xml."/".$annee[$index]."_".$m_xml.".xml";
				if (file_exists($fichsol) ) 
				{
					$fp2 = fopen ("$fichsol","r");
					$content2 = fread ($fp2,filesize("$fichsol"));
					fclose ($fp2);

					$valeur = strstr($content2,"<nb-hours-of-sunshine");
					if ($valeur == true)
					{ 
						$h_mois=(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,19,17))*1);
						if ($h_mois>0)
						{
							$x++;
							$soleil_moy[$index]+=$h_mois;
							if ($h_mois>$max_mois)
							{
								$max_mois=$h_mois;
									$mois_max=$tabmois[$i-1];
							}
						}	
					}
				}
				
			}
			if ($x<>0) 
			{	
				$soleil_moy[$index]=round($soleil_moy[$index]/$x)*1;
				$moismaxsoleil[$index]=$mois_max;
				$maxsoleil[$index]=$max_mois;
			}
		}

	$line2 = explode("\n",$separ_1[3]);
	for ($i=0; $i<$nb2; $i++)
	{
		$line2[$i] =" ".$line2[$i];
		$line2[$i] = str_replace($spaces,$space,$line2[$i]);
		$value2 = explode(" ",$line2[$i]);
		if (count($value2)>2) 
		{
			$rain[$index][$i] = $value2[3]*1;
		} 
		else 
		{		
			$rain[$index][$i] = null;
		}
	}

	$line3 = explode("\n",$separ_1[5]);
	for ($i=0; $i<$nb3; $i++)
	{
		$line3[$i] =" ".$line3[$i];
		$line3[$i] = str_replace($spaces,$space,$line3[$i]);
		$value3 = explode(" ",$line3[$i]);
		if (count($value3)>3) 
		{
			$ventmoyen[$index][$i] = $value3[3]*1;
			$rafales[$index][$i] = $value3[4]*1;
		} 
		else 
		{
			$ventmoyen[$index][$i] = null;
			$rafales[$index][$i] = null;
			$meantemp[$index][$i] = null;		
			$meanmax[$index][$i] = null;
			$meanmin[$index][$i] = null;
			$meantemp[$index][$i] = null;
			$hightemp[$index][$i] = null;
			$lowtemp[$index][$i] = null;
			$rain[$index][$i] = null;
			$ventmoyen[$index][$i] = null;}
	}

}
###########################
#Récupération des Normales#
###########################

if (FICHE_NORMALES == "TRUE") {
	if (TYPE_NOAA=="GW") {$normale = "../Statistics1/Normales.TXT";} else {$normale = REP_NOAA."Normales.TXT";}

	$index=3;
	$fp = fopen ("$normale",'r');
	$content = fread ($fp,filesize("$normale"));
	fclose($fp);
	$content = str_replace("\r","",$content);
	$separ= explode("----------\n",$content); 

	$line = explode("\n",$separ[1]);
//$raincum[$index][-1]=0;
	for ($i=0; $i<12; $i++)
	{
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);
		$value = str_replace("*","",$value);
		$meanmax[$index][$i] = $value[2]*1;
		$meanmin[$index][$i] = $value[3]*1;
		$meantemp[$index][$i] = $value[4]*1;
		$hightemp[$index][$i] = $value[5]*1;
		$lowtemp[$index][$i] = $value[6]*1;
		$rain[$index][$i] = $value[7]+0;
		//$raincum[$index][$j]=$raincum[$index][$j-1]+$value[7]*1; 
		$ventmoyen[$index][$i] = $value[8]*1;
		$rafales[$index][$i] = $value[9]*1;
		$soleil[$index][$i] = $value[10]*1;
	}
}

if (FICHE_NORMALES == "TRUE") {$indexmax=4;} else {$indexmax=3;}
$lt=$lowtemp; $ht=$hightemp;
for ($index=1; $index<$indexmax; $index++) {
for ($i=0; $i<$nb1; $i++){
  if ($lt[$index][$i]=="") {$lt[$index][$i]="0";}
  if ($ht[$index][$i]=="") {$ht[$index][$i]="0";}
}}
if (FICHE_NORMALES == "TRUE") {
  $ymin = floor(min(min($lt[1]),min($lt[2]),min($lt[3])));
  $ymax = ceil(max(max($ht[1]),max($ht[2]),max($ht[3])));
} else {
  $ymin = floor(min(min($lt[1]),min($lt[2])));
  $ymax = ceil(max(max($ht[1]),max($ht[2])));

$raincum[$index][0] = $rain[$index][0] ;
for ($index=1; $index<$indexmax; $index++) {
  for ($j=1; $j<11; $j++) 
  {$raincum[$index][$j]=strval($raincum[$index][$j-1]+$rain[$index][$j]);}}

}
$ymax = 5*ceil($ymax/5);
$ymin = 5*floor($ymin/5);
$date1 = $annee[1];
$date2 = $annee[2];

$Xlab = $xlabel1;
?>