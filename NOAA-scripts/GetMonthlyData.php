<?php
#####################################
# Récupération des noms de fichiers #
#####################################

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

for ($index=1; $index<3; $index++) {

  $fp = @fopen ("$fichier[$index]",r);
  $content = fread ($fp,filesize("$fichier[$index]"));
  fclose ($fp);
  
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

########################################
#Récupération des données mensuelles  ##
########################################
$jour = array(1=>array(30),2=>array(30));
$jourch = array(1=>array(30),2=>array(30));
$meantemp = array(1=>array(30),2=>array(30));
$hightemp = array(1=>array(30),2=>array(30));
$lowtemp = array(1=>array(30),2=>array(30));
$rain = array(1=>array(30),2=>array(30));
$rainc = array(1=>array(30),2=>array(30));
$ventmoyen = array(1=>array(30),2=>array(30));
$rafales = array(1=>array(30),2=>array(30));
$soleil = array(1=>array(30),2=>array(30));//
$uv_avg = array(1=>array(30),2=>array(30));
$uv_max = array(1=>array(30),2=>array(30));
$rad_max = array(1=>array(30),2=>array(30));
$rad_avg = array(1=>array(30),2=>array(30));
$rad_tot= array(1=>array(30),2=>array(30));
$wind_d= array(1=>array(16),2=>array(16));


$nb[$index] = substr_count ($table[$index], "\n");
if (is_null($nb[$index])){exit;}
for ($index=1; $index<3; $index++) {
for ($i=0; $i<$nb[$index]+1; $i++){
$value = explode(" ",$line[$index][$i]);

#séparation et classement des valeurs
//$jour[$index][$i] = $value[1]; 
if (count($value)>2) {
  $meantemp[$index][$i] = $value[2]*1;
  $hightemp[$index][$i] = $value[3]*1;
  $lowtemp[$index][$i] = $value[5]*1;
  $rain[$index][$i] = $value[9]*1;
  $ventmoyen[$index][$i] = $value[10]*1;
  $rafales[$index][$i] = $value[11]*1;
   }
else {
  $meantemp[$index][$i] = null;
  $hightemp[$index][$i] = null;
  $lowtemp[$index][$i] = null;
  $rain[$index][$i] = null;
  $ventmoyen[$index][$i] = null;
  $rafales[$index][$i] = null;
}
	}
	
}
$max_index=3;
include ('GetMonthlyData1.php');//Lecture des fichiers xml commun aux compare et rapports


?>