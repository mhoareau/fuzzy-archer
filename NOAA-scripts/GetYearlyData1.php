<?php
include "LectAnnNOAA1.inc.php";
$uv_avg = array(array(0),array(0));
$uv_max =array(array(0),array(0));
$rad_max = array(array(0),array(0));
$rad_avg = array(array(0),array(0));
$rad_tot= array(array(0),array(0));
$wind_d= array(array(0),array(0));
for ($index=1; $index<3; $index++){
// récupération dir vent
$fichiervent = REP_GW.$annee[$index]."/".$annee[$index].".xml";
	if (file_exists($fichiervent)) { 
		$fp = fopen ("$fichiervent","r");
		$content = fread ($fp,filesize("$fichiervent"));
		fclose ($fp);
		$z=strpos($content, '<total-rainfall>');
		if ($z>1) {$ver='V2';} else{$ver='V3';}
	//echo $z.'zttt'.$ver;
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
		#Récupération de l'ensoleillement total
		//$fichier2 = REP_GW.$annee[$index]."/".$annee[$index].".xml";
		if ( SONDE_SOL=="TRUE") 
		{
 	 	if ($ver=="V2")  
			{
				$valeur = strstr($content,"<nb-hours-of-sunshine>");
				$soleil_y[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($valeur,20,6));
				$valeur = strstr($content,"<total-solar-energy");			
				$soleilnrj[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($valeur,20,8));
				$valeur = strstr($content,"<solar_radiation>");
				$val1 = strstr($valeur,"<mean>");
				$soleilrad[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,6,10));
			}
			else
			{
				$valeur = strstr($content,"<nb-hours-of-sunshine");
				$val1 = strstr($valeur,"value=");
				$soleil_y[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,6));
				$valeur = strstr($content,"<total-solar-energy");
				$val1 = strstr($valeur,"value=");
				$soleilnrj[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,8));
//echo $soleilnrj[$index].'gg<br/>';
				$valeur = strstr($content,"<solar_radiation");
				$val1 = strstr($valeur,"mean=");
				$soleilrad[$index] = mb_ereg_replace ("[^0-9\.]","",substr ($val1,5,10));
			}
		}
		else 
		{
			$soleil_y[$index]=""; 
			$soleilnrj[$index]=""; 
			$soleilrad[$index]="";
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
					//echo $fichsol;
				if (file_exists($fichsol) ) 
				{
					$fp2 = fopen ("$fichsol","r");
					$content2 = fread ($fp2,filesize("$fichsol"));
					fclose ($fp2);
					//$z=strpos($content2, '<nb-hours-of-sunshine');
					$valeur = strstr($content2,"<nb-hours-of-sunshine");
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
			if ($x<>0) 
			{	
				$soleil_moy[$index]=round($soleil_moy[$index]/$x)*1;
				$moismaxsoleil[$index]=$mois_max;
				$maxsoleil[$index]=$max_mois;
			}
		} 

	}



	for ($i=0; $i<$nb1[$index]; $i++)
	{
		#Récupération de l'ensoleillement W/m²
		if (SONDE_SOL=="TRUE")
		{
			$x = substr(100+($i+1),1);
			$fichier2 = REP_GW.$annee[$index]."/".$x."/".$annee[$index]."_".$x.".xml";
			if (file_exists($fichier2)) 
			{
				$fp2 = fopen ("$fichier2","r");
				$content2 = fread ($fp2,filesize("$fichier2"));
				fclose ($fp2);
				$z=strpos($content2, '<total-rainfall>');
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

	$line2 = explode("\n",$separ_1[3]);
	for ($i=0; $i<$nb2; $i++)
	{
		$line2[$i] =" ".$line2[$i];
		$line2[$i] = str_replace($spaces,$space,$line2[$i]);
		$value2 = explode(" ",$line2[$i]);
		if (count($value2)>3) 
		{
			$rain[$index][$i] = $value2[3]*1;
			$rainmax[$index][$i] = $value2[5]*1;
			$jourrainmax[$index][$i] = $value2[6]*1;
		} 
		else 
		{		
			$rain[$index][$i] = 0;
		}
	}



}


?>