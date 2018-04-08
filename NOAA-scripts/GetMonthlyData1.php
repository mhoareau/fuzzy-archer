<?php

//include "LectMensNOAA1.inc.php";

$soleil = array(array(0),array(0),);
$rad_tot = array(array(0),array(0),);
$rad_avg = array(array(0),array(0),);
$rad_max = array(array(0),array(0),);
$uv_max = array(array(0),array(0),);
$uv_avg = array(array(0),array(0),);

#####################################
#  lecture des fichiers xml de GW  ##
#####################################
for ($index=1; $index<3; $index++) 
{
  #Récupération de l'$lx_sunny
//if (($nb[1])>($nb[2])) {$nbx=$nb[1];} else {$nbx=$nb[2];}
for ($i=0; $i<$nb[$index]+1; $i++) 
{
$x = substr(100+($i+1),1);
$fichier = REP_GW.$annee[$index]."/".$moisch[$index]."/".$annee[$index]."_".$moisch[$index]."_".$x.".xml";
if (file_exists($fichier) && SONDE_SOL=="TRUE") 
	{

    $fp = fopen ("$fichier","r");
    $content = fread ($fp,filesize("$fichier"));
    fclose ($fp);
	$z=strpos($content, '<total-rainfall>');
	if ($z>1) {$ver='V2';} else{$ver='V3';}
	//echo $z.'zz&'.$ver;
		if ($ver=="V2") 
		{   
			$valeur = strstr($content,"<total-solar-energy>");
			$rad_tot[$index][$i] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,20,6))))*1;
			$valeur = strstr($content,"<uv_index>");
			$val1 = strstr($valeur,"<max>");	
			$uv_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,6))))*1;
			$val1 = strstr($valeur,"<mean>");   
			$uv_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,6,6))))*1;
			$valeur = strstr($content,"<solar_radiation>");
			$val1 = strstr($valeur,"<max>");
			$rad_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
			$val1 = strstr($valeur,"<mean>");
			$rad_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,6,8))))*1;
		}
		else 
		{
			$valeur = strstr($content,"<total-solar-energy");
			$rad_tot[$index][$i] = (strval(mb_ereg_replace ("[^0-9\.]","",substr ($valeur,21,12))))*1;
		    $valeur = strstr($content,"<uv_index");
			$val1 = strstr($valeur," max=");
			$uv_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,6))))*1;
			$val1 = strstr($valeur," mean=");   
			$uv_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,6,6))))*1;
			$valeur = strstr($content,"<solar_radiation");
			$val1 = strstr($valeur," max=");
			$rad_max[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8))))*1;
			$val1 = strstr($valeur," mean=");
			$rad_avg[$index][$i]=(strval(mb_ereg_replace ("[^0-9\.]","",substr ($val1,6,8))))*1;

		
		}
	}
	/*else le fichier n'existe pas
	{
		$soleil[$index][$i]="";
		$rad_tot[$index][$i]="";
		$rad_avg[$index][$i]="";
		$rad_max[$index][$i]="";
		$uv_max[$index][$i]="";
		$uv_avg[$index][$i]="";	
	}*/
}
	//if (($nb[1])>($nb[2])) {$nbx=$nb[1];} else {$nbx=$nb[2];}
for ($i=1;$i<$nb[$index]+1;$i++)
{
		$j=substr((100+$i),1);
		$fichier = REP_GW.$annee[$index]."/".$moisch[$index]."/".$annee[$index]."_".$moisch[$index]."_".$j.".xml";
//echo $fichier.'<br/>';
		if (file_exists($fichier) && SONDE_SOL=="TRUE") 
		{
			$fp = fopen ("$fichier","r");
			$content = fread ($fp,filesize("$fichier"));
			fclose ($fp);
			$z=strpos($content, '<nb-hours-of-sunshine>');
			if ($z>1) {$ver='V2';} else{$ver='V3';}
	//echo $z.'zz'.$ver;
			if ($ver=="V2") 
			{   
				$valeur = strstr($content,"<nb-hours-of-sunshine");
				$soleil = mb_ereg_replace ("[^0-9\.]","",substr ($valeur,22,6));
			}
			else
			{
				$valeur = strstr($content,"<nb-hours-of-sunshine");
				$val1 = strstr($valeur," value=");
				$soleil = mb_ereg_replace ("[^0-9\.]","",substr ($val1,7,6));	
			}
		}
		else 
		{
		$soleil[$index]="";
		}

		if ($soleil > $maxsoleil[$index] && $soleil !="") 
		{
//echo $soleil.'<br/>';				
			$maxsoleil[$index]=$soleil; 
			$jourmaxsoleil[$index]=$i;
		}	
}


} // fin du for pour$lx_onroulement des index
$lt=$lowtemp; $mt=$meantemp; $ht=$hightemp;

for ($index=1; $index<$max_index; $index++) {
if (($nb[1])>($nb[2])) {$nbx=$nb[1];} else {$nbx=$nb[2];}
for ($i=0; $i<$nbx+1; $i++){
  if ($lt[$index][$i]=="") {$lt[$index][$i]="0";}
  if ($mt[$index][$i]=="") {$mt[$index][$i]="0";}
  if ($ht[$index][$i]=="") {$ht[$index][$i]="0";}
}}


$date1 = $moisA[1]." ".$annee[1];
$date2 = $moisA[2]." ".$annee[2];
$Xlab=nothing;
$Xlab = $xlabel; 
?>