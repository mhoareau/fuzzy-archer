<?php
#####################################
# Récupération des noms de fichiers #
#####################################

$fichier[1] = REP_GW.$annee[1]."_".$moisch[1]."_NOAA.txt";
$fichier3[1] =  REP_GW.$annee[1]."_NOAA.txt";
$fichier[2] = REP_GW.$annee[2]."_".$moisch[2]."_NOAA.txt";

########################################
#Initialisation des récap mensuelles  ##
########################################
$jour = array(array(""),array(""));
$jourch = array(1=>array(30),2=>array(30));
$meantemp = array(1=>array(30),2=>array(30));
$hightemp = array(1=>array(30),2=>array(30));
$lowtemp = array(1=>array(30),2=>array(30));
$rain = array(1=>array(30),2=>array(30));
$rainc = array(1=>array(30),2=>array(30));
$ventmoyen = array(1=>array(30),2=>array(30));
$rafales = array(1=>array(30),2=>array(30));
$wind_d= array(1=>array(16),2=>array(16));
$dir= array(array(""),array(""));

########################################
#initialisation des récaps mensuelles ##
########################################
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
$jourmaxrain = array(1=>"",2=>"");
$maxrain = array (1=>0,2=>0);
$maxvent = array (1=>0,2=>0);
$venteux = array (1=>0,2=>0);
$venteux_mistral = array (1=>0,2=>0);
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


/*$meantemp_max = array (1=>-100,2=>-100);
$meantemp_min = array (1=>100,2=>100);*/
$lowtemp_max = array (1=>-100,2=>-100);
$hightemp_min = array (1=>100,2=>100);
$lowtemptotal = array (1=>0,2=>0);
$hightemptotal = array (1=>0,2=>0);
$pluietotal = array (1=>0,2=>0);
$amplitude_max = array (1=>0,2=>0);
$amplitude_min = array (1=>100,2=>100);
$uv_index = array (1=>100,2=>100);
$uv_minmax = array (1=>100,2=>100);
$uv_avg = array (1=>100,2=>100);
$maxsoleil = array (1=>0,2=>0);
$jourmaxsoleil = array(1=>"",2=>"");
$soleiltotal = array (1=>0,2=>0);
$meanmax = array(1=>array(12),2=>array(12));
$meanmin = array(1=>array(12),2=>array(12));

  
########################################
#éclatement des data dans les fichiers##
######################################## 
  
for ($index=1; $index<2; $index++) {
  $fp = @fopen ("$fichier[$index]",r);
  $content = fread ($fp,filesize("$fichier[$index]"));
  fclose ($fp);
  $content = str_replace(",",".",$content);
  $content = str_replace("\r","",$content);
  $separ_1[$index] = explode("----------\n",$content); 
  $separ_2[$index] = explode("\n----------",$separ_1[$index][1]); 
  $separ_3[$index] =explode("\n----------",$separ_1[$index][2]); 
  $recap = explode("\n",$separ_3[$index][0]);
  $lrecap=str_replace($spaces,$space,$recap[0] );
  $lrecap1=explode(" ",$lrecap);
  
  
  	$fp = @fopen ("$fichier3[$index]",'r') or die("<BR><Div class='titre'>$lx_no_data1 $annee[$index]<BR>$lx_no_data2</Div>");
	$content = fread ($fp,filesize("$fichier3[$index]"));
	fclose($fp);
 // echo $fichier3[$index];
 	$content = str_replace(",",".",$content);
	$content = str_replace("\r","",$content);
	$separ_1y = explode("----------\n",$content); 
 	$nb1 = substr_count($separ_1y[1], "\n");
	$line = explode("\n",$separ_1y[1]);
	for ($i=0; $i<$nb1; $i++) 
	{ //lecture des données mensuelles dans NOAA annuels
		$line[$i] =" ".$line[$i];
		$line[$i] = str_replace($spaces,$space,$line[$i]);
		$value = explode(" ",$line[$i]);

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

########################################
#récupération de toutes les variables ##
########################################

for ($index=1; $index<2; $index++) {

  $table[$index] =$separ_2[$index][0];
  $nb[$index] = substr_count ($table[$index], "\n");
  $line[$index] = explode("\n",$table[$index]);
  for($j=0;$j<sizeof($line[$index]);$j++){
    $line[$index][$j]=" ".$line[$index][$j];
    $line[$index][$j] = str_replace($spaces,$space,$line[$index][$j]);
	}


########################################
#récupération des les variables/jour  ##
########################################

if (($nb[1])>($nb[2])){$nbx=$nb[1];} else {$nbx=$nb[2];}
for ($i=0; $i<$nbx+1; $i++){
//for ($i=0; $i<31; $i++){
$value = explode(" ",$line[$index][$i]);

$nbjours=count($value);
#séparation et classement des valeurs
if ($nbjours>2) 
{
  $jour[$index][$i] = $value[1]; 
  $meantemp[$index][$i] = $value[2]*1;
  $hightemp[$index][$i] = $value[3]*1;
  $hourhightemp[$index][$i] = $value[4];
  $lowtemp[$index][$i] = $value[5]*1;
// echo $lowtemp[$index][$i].' '.$jour.'<br/>'; 
  $hourlowtemp[$index][$i] = $value[6];
  $rain[$index][$i] = $value[9]*1;
  $ventmoyen[$index][$i] = $value[10]*1;
  $rafales[$index][$i] = $value[11]*1;

  $dir[$index][$i] =   str_replace("W","O",$value[13]);
  
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
  if ($rafales[$index][$i]>=36 ) {	$venteux[$index]++;	}
  if ($rafales[$index][$i]>=50 && ($dir[$index][$i]=='NE' or $dir[$index][$i]=='NNE' or $dir[$index][$i]=='N' or $dir[$index][$i]=='NNO' or $dir[$index][$i]=='NO' )) 
	{
		$venteux_mistral[$index]++;
	}  
	$Xlab[$index][$i] = $xlabel1[$i];
}
else {
  $meantemp[$index][$i] = null;
  $hightemp[$index][$i] = null;
  $lowtemp[$index][$i] = null;
  $rain[$index][$i] = null;
  $ventmoyen[$index][$i] = null;
  $rafales[$index][$i] =  null;
  $Xlab[$index][$i] = null;}
}

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
## lecture de la récap mensuelle ( _m pour messuel
## lecture de la récap mensuelle
	$bilan =" ".$separ_1[$index][2]; //recup ligne recap mensuelle
	$bilan = explode ("\n",$bilan);
	$bilan[0] = str_replace($spaces,$space,$bilan[0]);
	$value = explode(" ",$bilan[0]);
	$meantemp_m[$index] = $value[1];
	$hightemp_m[$index] = $value[2];
	$jourhightemp_m[$index] = $value[3];
	$hourhightemp_m[$index] =$hourhightemp[$index][$value[3]];
	$lowtemp_m[$index] = $value[4];
	$jourlowtemp_m[$index] = $value[5];
	$hourlowtemp_m[$index] = $hourlowtemp[$index][$value[5]];
	$rain_m[$index] = $value[8];
	$ventmoyen_m[$index] = $value[9];
	$rafales_m[$index] = $value[10];
	$jour_rafales_m[$index] = $value[11];
	$domdir_m[$index] =  str_replace("W","O",$value[12]);

################################################################
# Récupératuration des autres maxi/mini et calcul des moyennes #
################################################################


	$lowtemptotal=0;
	$hightemptotal=0;
	$pluietotal=0;
	for ($i=0; $i<$nb[$index]+1; $i++) 
	{
		$value = explode(" ",$line[$index][$i]);
		$jourch[$index] = substr((100+$value[1]),1);
      if (count($value)>3)
	  {
		//*****************************************************************
		
		if ($ventmoyen[$index][$i] > $maxvent[$index] && $ventmoyen[$index][$i]!="") 
		{
			$maxvent[$index]=$ventmoyen[$index][$i]; 
			$jour_vent_max[$index]=$value[1];
		}

		if ($rain[$index]!="") 
		{
			$pluietotal = $pluietotal+$rain[$index][$i];
			$pluie_moy[$index] = round(($pluietotal/$jourch[$index]), 1);
		}
##calcul de l'amplitude des $lx_temp
		if ($lowtemp[$index]!="") 
		{
			$amplitude = $hightemp[$index][$i] - $lowtemp[$index][$i];
			if ($amplitude < $amplitude_min[$index]) 
			{
				$amplitude_min[$index]=$amplitude; $jour_amplitude_min[$index]=$value[1];
			}
			if ($amplitude > $amplitude_max[$index]) 
			{
				$amplitude_max[$index]=$amplitude; $jour_amplitude_max[$index]=$value[1];	
			}
		}





		$ht=array($hightemp[$index]);
		$lt=array($hightemp[$index]);
		
		$hightemp_moy[$index]=round(array_sum($ht)/($jourch[$index]));
		$lowtemp_moy[$index] = round((array_sum($lt)/$jourch[$index]), 1);
		
	}
	}
		$rr=$rain[$index];
		$maxrain[$index]=getmax($rr);
		$jourmaxrain[$index]=getJmax($rr);
		$pluie[$index]=cptmax($rr,0.01,999);
		$pluie_1[$index]=cptmax($rr,0.9,5);
		$pluie_5[$index]=cptmax($rr,5,10);
		$pluie_10[$index]=cptmax($rr,9.9,999);
				 //echo comptejour($rr,0,99).' '.$jourmaxrain[$index].'<br/>' ;
		
		$rr=$hightemp[$index];
		$canicule[$index]=cptmax($rr,35,99);
		$chaleur[$index]=cptmax($rr,30,99);
		$sansdegel[$index]=cptmin($rr,0,-99);
		$rr1=$lowtemp[$index];
		$fortgel[$index]=cptmin($rr1,-5,-99);
		$gel[$index]=cptmin($rr1,0,-99);
		
}
$max_index=2;
include "GetMonthlyData1.php";//Lecture des fichiers xml commun aux compare et rapports
?>


