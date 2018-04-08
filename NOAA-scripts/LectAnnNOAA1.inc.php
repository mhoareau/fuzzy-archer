<?php
#####################################
# Récupération des noms de fichiers #
#####################################
if ($annee[1]=="") {$annee[1]=date('Y');}
//if ($annee[2]=="") {$annee[2]=date('Y');}
$fichier3= array(3);
if (TYPE_NOAA == "GW") {
  $fichier3[1] = "../Statistics1/".$annee[1]."_NOAA.txt";}
  $fichier3[2] = "../Statistics1/".$annee[2]."_NOAA.txt";

if (TYPE_NOAA == "WL") {
  if ($annee[1]==date("Y")) {$fichier3[1]=REP_NOAA."NOAAYR.TXT";}
    else {$fichier[1] = REP_NOAA.$annee[1].".TXT";}
  if ($annee[2]==date("Y")) {$fichier3[2]=REP_NOAA."NOAAYR.TXT";}
    else {$fichier3[2] = REP_NOAA.$annee[2].".TXT";}}
if (TYPE_NOAA == "AUTRE") {
  $fichier3[1] = REP_NOAA.$annee[1].".TXT";
  $fichier3[2] = REP_NOAA.$annee[2].".TXT";}

########################################
#Initialisation des récap annuelles   ##
########################################
$char = array (" ","W");
$newchar = array ("","O");
$spaces = array("     ","    ","   ","  ");
$space = array(" "," "," "," ");

##########################
#Récupération des données#
##########################
$meanmax = array(array(0),array(0));
$meanmin =  array(array(0),array(0));
$meantemp =  array(array(0),array(0));
$hightemp =  array(array(0),array(0));
$lowtemp =  array(array(0),array(0));
$rain = array(array(0),array(0));
$soleil =  array(array(0),array(0));
$ventmoyen =  array(array(0),array(0));
$rafales =  array(array(0),array(0));
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


########################################
#Initialisation des récap mensuelles  ##
########################################
$soleil_moy=array(3);
$minmeanmin = array(100);
$maxmeanmin =  array(-100);
$maxmeanmax =  array(-100);
$minmeanmax =  array(100);
$maxmeantemp =  array(-100);
$minmeantemp =  array(100);
$minhighttemp_y =  array(100);
$maxlowtemp_y =  array(-100);
$domdir_y =  array(0);
$maxsoleil =  array(0);
$maxtotalrain =  array(0);
$maxraindays =  array(0);
$maxventmoyen =  array(0);
$lowtemptotal =  array(0);
$hightemptotal =  array(0);
$soleiltotal =  array(0);
$geltotal =  array(0);
$venteux_mistral = array (0);
for ($index=1; $index<3; $index++) 
{

	$fp = @fopen ("$fichier3[$index]",'r') or die("<BR><Div class='titre'>$lx_no_data1 $annee[$index]<BR>$lx_no_data2</Div>");
	$content = fread ($fp,filesize("$fichier3[$index]"));
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
	$hightemp_y[$index] = $value2[7];
	$moishigh_y = $value2[8];
	$moishightemp_y[$index] = $tabmois3[$moishigh_y][1];
	//echo $moishightemp_y[$index]."ttt";
	$lowtemp_y[$index] = $value2[9];
	$moislow_y = $value2[10];
	$canicule_y[$index] = $value2[11];
	$moislowtemp_y[$index] = $tabmois3[$moislow_y][1];
	//echo $moislowtemp_y[$index] .'yyy';
	$bilan =" ".$separ_1[4];
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value4 = explode(" ",$bilan[0]);
	$totalrain_y[$index] = $value4[1];
	$maxpluie_y[$index] = $value4[3];
	$moismaxpluie_y[$index] = $value4[4];
    $moismaxpluie_y[$index] = $tabmois1[$tabmois3[$moismaxpluie_y[$index]][1]-1];

	$bilan =" ".$separ_1[6];
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value6 = explode(" ",$bilan[0]);
	$ventmoyen_y[$index] = $value6[1];
	$rafales_y[$index] = $value6[2];
	$moisrafales_y[$index] = $value6[3];
    $moisrafales_y[$index] = $tabmois1[$tabmois3[$moisrafales_y[$index]][1]-1];
	//$domdir_y[$index] = str_replace($char,$newchar,$value6[4]);
	$domdir_y[$index] =  str_replace("W","O",$value6[4]);
	$nb1[$index] = substr_count ($separ_1[1], "\n");
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
					if ($r >='1' && $r !="" && $r <5) {$pluie_y1[$index]=$pluie_y1[$index]+1;} else {$pluie_y1[$index]=$pluie_y1[$index];}
					if ($r >='5' && $r !="" && $r <10) {$pluie_y5[$index]=$pluie_y5[$index]+1;} else {$pluie_y5[$index]=$pluie_y5[$index];}
					if ($r >='10' && $r !="") {$pluie_y10[$index]=$pluie_y10[$index]+1;} else {$pluie_y10[$index]=$pluie_y10[$index];}
					$t = $value[5];
					if ($t <='0'&& $t !="") {$gel_y[$index]=$gel_y[$index]+1;} else {$gel_y[$index]=$gel_y[$index];}
					if ($t <='-5'&& $t !="") {$fortgel_y[$index]=$fortgel_y[$index]+1;} else {$fortgel_y[$index]=$fortgel_y[$index];}
					$th = $value[3];
					if ($th <='0'&& $t !="") {$sansdegel_y[$index]=$sansdegel_y[$index]+1;} else {$sansdegel_y[$index]=$sansdegel_y[$index];}
					if ($th >='30'&& $th !="") {$chaleur_y[$index]=$chaleur_y[$index]+1;} else {$chaleur_y[$index]=$chaleur_y[$index];}
					if ($th >='35'&& $th !="") {$canicule_y[$index]=$canicule_y[$index]+1;} else {$canicule_y[$index]=$canicule_y[$index];}
					if ($value[11]>36) {$venteux[$index]++;}
					$dd =  str_replace("W","O",$value[13]);
					if (($value[11]>50) && ($dd=='NE' or $dd=='NNE' or $dd=='N' or $dd=='NNO' or $dd=='NO' )) 
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
			$domdir[$index][$i] = $value3[6];
			
		} 
		else 
		{
			$ventmoyen[$index][$i] = null;
			$rafales[$index][$i] = null;
			$domdir[$index][$i] = null;
		}
	}

	$line = explode("\n",$separ_1[1]);
	for ($i=0; $i<$nb1[$index]; $i++) 
	{ //lecture des données mensuelles dans NOAA annuels
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);
//echo $value[1]." ".$value[2]." ".$value[3]." ".$value[4]." ".$value[5]." ".$value[6]." ".$value[7]." ".$value[8]." ".$value[9]." ".$value[10]." ".$value[11]." ".$value[12]."<br/>";
		$mois[$index][$i] = $value[2]; 
		$moisch = substr((100+$mois[$index][$i] ),1);
		If (count($value)>3) 
		{
			$meanmax[$index][$i] = $value[3];
			$meanmin[$index][$i] = $value[4];
			$meantemp[$index][$i] = $value[5];
			$hightemp[$index][$i] = $value[9];
			$jourhightemp[$index][$i] = $value[10];
			$lowtemp[$index][$i] = $value[11];
			$jourlowtemp[$index][$i] = $value[12];
			//echo $index.' '.$i.' '.$jourlowtemp[$index][$i].'<br/>';

			$gel = $value[15];

			if ($meanmin[$index][$i] < $minmeanmin[$index] && $meanmin[$index][$i]!="") {$minmeanmin[$index]=$meanmin[$index][$i];}
			if ($meanmin[$index][$i] > $maxmeanmin[$index] && $meanmin[$index][$i]!="") {$maxmeanmin[$index]=$meanmin[$index][$i];}
			if ($meanmax[$index][$i] > $maxmeanmax[$index] && $meanmax[$index][$i]!="") {$maxmeanmax[$index]=$meanmax[$index][$i];}
			if ($meanmax[$index][$i] < $minmeanmax[$index] && $meanmax[$index][$i]!="") {$minmeanmax[$index]=$meanmax[$index][$i];}
			if ($meantemp[$index][$i] > $maxmeantemp[$index] && $meantemp[$index][$i]!="") {$maxmeantemp[$index]=$meantemp[$index][$i];}
			if ($meantemp[$index][$i] < $minmeantemp[$index] && $meantemp[$index][$i]!="") {$minmeantemp[$index]=$meantemp[$index][$i];}
			if ($hightemp[$index][$i] < $minhighttemp_y[$index] && $hightemp[$index][$i]!="") {$minhighttemp_y[$index] = $hightemp[$index][$i];}
			if ($lowtemp[$index][$i] > $maxlowtemp_y[$index] && $lowtemp[$index][$i]!="") {$maxlowtemp_y[$index] = $lowtemp;}
	
			if ($annee[$index]==PREMIERE_ANNEE && $mois[$index][$i]>=PREMIER_MOIS) 
			{
				$lowtemptotal[$index] = $lowtemptotal[$index]+$lowtemp[$index][$i];
				$lowtemp_moy[$index] = round(($lowtemptotal[$index]/($mois[$index][$i] -PREMIER_MOIS+1)), 1);}
			else 
			{
				$lowtemptotal[$index] = $lowtemptotal[$index]+$lowtemp[$index][$i];
				$lowtemp_moy[$index] = round(($lowtemptotal[$index]/$mois[$index][$i] ), 1);
			}
      
			if ($annee[$index]==PREMIERE_ANNEE && $mois[$index][$i]>=PREMIER_MOIS) 
			{
				$hightemptotal[$index] = $hightemptotal[$index]+$hightemp[$index][$i];
				$hightemp_moy[$index] = round(($hightemptotal[$index]/($mois[$index][$i]-PREMIER_MOIS+1)), 1);
			}
			else 
			{
				$hightemptotal[$index] = $hightemptotal[$index]+$hightemp[$index][$i];
				$hightemp_moy[$index] = round(($hightemptotal[$index]/$mois[$index][$i] ), 1);
			}
		}
		else 
		{
			$meanmax[$index][$i] = null;
			$meanmin[$index][$i] = null;
			$meantemp[$index][$i] = null;
			$hightemp[$index][$i] = null;
			$lowtemp[$index][$i] = null;
			$Xlab[$index][$i] = 0;
		}		
	}
		//echo 	$jourlowtemp[$index][$moislowtemp_y[$index]]." ".$moislowtemp_y[$index]."rrr<br/>";

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

	$premsraf=0;
	$line3 = explode("\n",$separ_1[5]);
	for ($i=0; $i<$nb3; $i++)
	{
		$line3[$i] =" ".$line3[$i];
		$line3[$i] = str_replace($spaces,$space,$line3[$i]);
		$value = explode(" ",$line3[$i]);

		if (count($value)>3) 
		{
			$ventmoyen[$index][$i] = $value[3]*1;
			if ($ventmoyen[$index][$i] > $maxventmoyen[$index] && $ventmoyen!="")
			{
				$maxventmoyen[$index]=$ventmoyen[$index][$i];
				$mois_vent_max[$index]=$tabmois1[$value[2]-1];
			}
			$rafale = $value[4]*1;
			if ($rafale == $rafales_y[$index] && $rafale!="" && $premsraf=="0")
			{
				$jourrafales_y[$index]=$value[5];
				$premsraf = 1;
			}

 


		}
	}
}


for ($index=1; $index<2; $index++){	
	$fp = fopen ($fichier3[$index],'r');
	$content = fread ($fp,filesize("$fichier3[$index]"));
	fclose ($fp);
	$content = str_replace(",",".",$content);
	$content = str_replace("\r","",$content);
	$separ_1 = explode("----------\n",$content); 

	$nb1[$index] = substr_count ($separ_1[1], "\n");
	$nb2 = substr_count ($separ_1[3], "\n");
	$nb3 = substr_count ($separ_1[5], "\n");

	$line = explode("\n",$separ_1[1]);
	
	for ($i=0; $i<$nb1[$index]; $i++)
	{
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);
		$mois[$index][$i] = $value[2]; 
		$moisch = substr((100+$mois[$index][$i]),1);
		$mois[$index][$i] = str_replace(" ","",$mois[$index][$i]); $mois[$index][$i] = $tabmois[$mois[$index][$i]-1];
		if (count($value)>3) 
		{
			$meanmax[$index][$i] = $value[3]*1;
			$meanmin[$index][$i] = $value[4]*1;
			$meantemp[$index][$i] = $value[5]*1;
			$hightemp[$index][$i] = $value[9]*1;
			$lowtemp[$index][$i] = $value[11]*1;
			$Xlab[$index][$i] = $xlabel1[$i];
		} 
		else 
		{
			$meanmax[$index][$i] = null;
			$meanmin[$index][$i] = null;
			$meantemp[$index][$i] = null;
			$hightemp[$index][$i] = null;
			$lowtemp[$index][$i] = null;
			$Xlab[$index][$i] = 0;
		}
	}
	$line3 = explode("\n",$separ_1[4]);
		$line3[0] =" ".$line3[0];
		$line3[0] = str_replace($spaces,$space,$line3[0]);
		$value = explode(" ",$line3[0]);
		$pluiecumul_y[$index]=$value[1];
		$pluiemax_y[$index]=$value[3];
		$pluiemoismax_y[$index]=$value[4];
}


for ($index=1; $index<2; $index++) {

  
  
  	$fp = @fopen ("$fichier3[$index]",'r') or die("<BR><Div class='titre'>$lx_no_data1 $annee[$index]<BR>$lx_no_data2</Div>");
	$content = fread ($fp,filesize("$fichier3[$index]"));
	fclose($fp);
 // echo $fichier3[$index];
 	$content = str_replace(",",".",$content);
	$content = str_replace("\r","",$content);
	$separ_1y = explode("----------\n",$content); 
 	$nb1 = substr_count($separ_1y[5], "\n");
	$line = explode("\n",$separ_1y[5]);
	
	for ($i=0; $i<$nb1; $i++) 
	{ //lecture des données mensuelles dans NOAA annuels
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);
		
		$dir[$index][$i] =   str_replace("W","O",$value[6]);
if ($dir[$index][$i]=="N" ) {$compteur_N[$index]++;}
if ($dir[$index][$i]=="NNE" ) {$compteur_NNE[$index]++;}
if ($dir[$index][$i]=="NE" ) {$compteur_NE[$index]++;}
if ($dir[$index][$i]=="ENE" ) {$compteur_ENE[$index]++;}
if ($dir[$index][$i]=="E" ) {$compteur_E[$index]++;}
if ($dir[$index][$i]=="ESE" ) {$compteur_ESE[$index]++;}
if ($dir[$index][$i]=="SE" ) {$compteur_SE[$index]++;}
if ($dir[$index][$i]=="SSE" ) {$compteur_SSE[$index]++;}
if ($dir[$index][$i]=="S" ) {$compteur_S[$index]++;}
if ($dir[$index][$i]=="SSO" ) {$compteur_SSO[$index]++;}
if ($dir[$index][$i]=="SO" ) {$compteur_SO[$index]++;}
if ($dir[$index][$i]=="OSO" ) {$compteur_OSO[$index]++;}
if ($dir[$index][$i]=="O" ) {$compteur_O[$index]++;}
if ($dir[$index][$i]=="ONO" ) {$compteur_ONO[$index]++;}
if ($dir[$index][$i]=="NO" ) {$compteur_NO[$index]++;}
if ($dir[$index][$i]=="NNO" ) {$compteur_NNO[$index]++;}

//echo $value[1]." ".$value[2]." ".$value[3]." ".$value[4]." ".$value[5]." ".$value[6]." ".$value[7]." ".$value[8]." ".$value[9]." ".$value[10]." ".$value[11]." ".$value[12]."<br/>";

		if ($moisch[$index]==substr((100+$value[2]),1))
		{ 
			If (count($value)>3) 
			{
				$meantemp_max[$index] = $value[3];
				$meantemp_min[$index] = $value[4];
			}
		}
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
	$content = str_replace(",",".",$content);
	$content = str_replace("\r","",$content);
	$separ= explode("----------\n",$content); 

	$line = explode("\n",$separ[1]);

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

	$line1 = explode("\n",$separ[2]);



if (FICHE_NORMALES == "TRUE") {$indexmax=4;} else {$indexmax=3;}
$lt=$lowtemp; $ht=$hightemp;
for ($index=1; $index<$indexmax; $index++) {
	for ($i=0; $i<$nb1[$index]; $i++)
	{
		if ($lt[$index][$i]=="") {$lt[$index][$i]="0";}
		if ($ht[$index][$i]=="") {$ht[$index][$i]="0";}
	}
}
if (FICHE_NORMALES == "TRUE") 
{
	$ymin = floor(min(min($lt[1]),min($lt[2]),min($lt[3])));
	$ymax = ceil(max(max($ht[1]),max($ht[2]),max($ht[3])));
} 
else 
{
	$ymin = floor(min(min($lt[1]),min($lt[2])));
	$ymax = ceil(max(max($ht[1]),max($ht[2])));
	$raincum[$index][0] = $rain[$index][0] ;
	for ($index=1; $index<$indexmax; $index++) {
		for ($j=1; $j<11; $j++) 
		{
			$raincum[$index][$j]=strval($raincum[$index][$j-1]+$rain[$index][$j]);
		}
	}

}
$ymax = 5*ceil($ymax/5);
$ymin = 5*floor($ymin/5);
$date1 = $annee[1];
$date2 = $annee[2];

$Xlab1 = $xlabel;
?>