<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=UFT-8">
<script type="text/javascript">
function blinker(id,c1,c2)
{
        elm = document.getElementById(id);
        setTimeout(function() {setInterval(function () {elm.style.color=c1;},1000);},500);
        setInterval(function () {elm.style.color=c2;},1000);
}
</script>
<style>
@keyframes blink {
0% { opacity:1; }
75% { opacity:1; }
76% { opacity:0; }
100% { opacity:0; }
}

blink {
text-decoration: inherit;
animation: blink 0.50s ease-in infinite alternate;
}
</style>
<script type="text/javascript">
if ( document.all )
{
function blink_show()
{
blink_tags = document.all.tags('blink');
blink_count = blink_tags.length;
for ( i = 0; i < blink_count; i++ )
{
blink_tags[i].style.visibility = 'visible';
}
window.setTimeout( 'blink_hide()', 700 );
}
function blink_hide()
{
blink_tags = document.all.tags('blink');
blink_count = blink_tags.length;
for ( i = 0; i < blink_count; i++ )
{
blink_tags[i].style.visibility = 'hidden';
}
window.setTimeout( 'blink_show()', 250 );
}
window.onload = blink_show;
}
</script>
</head>
<?php
## contraste color ty bgcolor
function convertColor($color){
	    $r=hexdec(substr($color,1,2))*0.30;
	    $v=hexdec(substr($color,3,2))*0.54;
	    $b=hexdec(substr($color,5,2))*0.2;
	    if(($r+$v+$b) < 127.5){ $col1="#ffffff";} else { $col1="#000000";}

		$style="$color;color:$col1";
		
	    return $style;
	}
	
## couleur en fonction de la temp
function gettempcolor($temp){
if($temp <= '10')  {$color='#F3E600'; }
elseif($temp >= '10' && $temp < '15')  {$color='#F1C903';} 
elseif($temp >= '15' && $temp < '20')  {$color='#EEA819';} 
elseif($temp >= '20' && $temp < '25')  {$color='#EB8320'; }
elseif($temp >= '25' && $temp < '30')  {$color='#E85922'; }
elseif($temp >= '30' && $temp < '35')  {$color='#FF0000'; }
elseif($temp >= '35')  {$color='#BC1542';} 
else {$color='';}
$ret=convertColor($color);
return $ret;
}

## couleur en fonction de la direction du vent
function getdircolor($dir)
{
$dircolors = array(
"N"=>"185,185,185",
"NNE"=>"185,185,185",
"NE"=>"185,185,185",
"ENE"=>"185,185,185",
"E"=>"185,185,185",
"ESE"=>"185,185,185",
"SE"=>"185,185,185",
"SSE"=>"185,185,185",
"S"=>"185,185,185",
"SSO"=>"185,185,185",
"SO"=>"185,185,185",
"OSO"=>"185,185,185",
"O"=>"185,185,185",
"ONO"=>"185,185,185",
"NO"=>"185,185,185",
"NNO"=>"185,185,185"
);
return $dircolors[$dir];
}

## couleur en fonction de la quantité de pluie
function getpluiecolor($rain){
if($rain >= '0.2' && $rain <= '1')  {$color='#A6DBF3';} 
elseif($rain > '1' && $rain <= '5')  {$color='#91D3F0';} 
elseif($rain > '5' && $rain <= '10')  {$color='#7ACCED';} 
elseif($rain > '10' && $rain <= '50')  {$color='#5DC5EA'; }
elseif($rain > '50' && $rain <= '100')  {$color='#35BDE7'; }
elseif($rain > '100' && $rain <= '200')  {$color='#30AADC'; }
elseif($rain > '200' && $rain <= '300')  {$color='#2F96D0';} 
elseif($rain > '300')  {$color='#395CA3';} 
else {$color='';}
$ret=convertColor($color);
return $ret;
}


## couleur en fonction de la vitesse du vent
function getventcolor($rafales){
#colorisation vent
if($rafales < '37' )  {$color='#B5E655';} 
elseif($rafales >= '37' && $rafales < '58')  {$color='#F4E500';} 
elseif($rafales >= '58' && $rafales < '100')  {$color='#EC981B';} 
elseif($rafales >= '100' && $rafales < '130')  {$color='#E42321'; }
elseif($rafales >= '130' && $rafales < '150')  {$color='#C23A5C'; }
elseif($rafales >= '150' )  {$color='#994791'; }
else {$color='#222222';}
$ret=convertColor($color);
return $color;
}

##Récupération du minimum d'un tableau
function getmin($arrayvar){
$set="";
$min="";
for($i=0;$i<sizeof($arrayvar);$i++){
if($arrayvar[$i]!="" && $set!=1){$min= $arrayvar[$i]; $set=1;}
if($arrayvar[$i]<$min && $arrayvar[$i]!=""){$min=$arrayvar[$i];}
}
return $min;
}

##Récupération du maxiimum d'un tableau
function getmax($arrayvar){
$max="";
$arrayvar[0]=$max;
for($i=0;$i<sizeof($arrayvar);$i++){
if($arrayvar[$i]>$max && $arrayvar[$i]!=""){$max=$arrayvar[$i];}
}
return $max;
}


##*****************************
function comptemax($arrayvar,$trigger,$trigger2){
$max=0;
for($i=0;$i<sizeof($arrayvar);$i++){
if($arrayvar[$i]>$trigger && $arrayvar[$i]<=$trigger2 && $arrayvar[$i]!=""){$max++;}
}
return $max;
}
##*****************************

function comptemin($arrayvar,$trigger,$trigger2){
$max=0;
for($i=0;$i<sizeof($arrayvar);$i++){
if($arrayvar[$i]<$trigger && $arrayvar[$i]!=""){$min++;}
}
return $min;
}

##récupération de l'indice du jour correspondant au maxi d'un tableau
function getJmax($arrayvar){
$max="";
$imax="";
for($i=0;$i<sizeof($arrayvar);$i++)
{
if($arrayvar[$i]>$max){$max=$arrayvar[$i]; $imax=$i+1;}
}
$imx = substr((100+$imax),1,2);
return $imx;
}


##*****************************
function cptmin($arrayvar,$trig1,$trig2){
	$min=0;
	for($i=0;$i<sizeof($arrayvar);$i++){
		if($arrayvar[$i]<=$trig1 && $arrayvar[$i]>$trig2){$min++;}
		}
	return $min;
}
##*****************************

##*****************************
function cptmax($arrayvar,$trig1,$trig2){
	$max=0;
	for($i=0;$i<sizeof($arrayvar);$i++){
		if($arrayvar[$i]>=$trig1 && $arrayvar[$i]<$trig2){$max++;}
		}
	return $max;
}


##Coloration de la ligne correspondant au maxi
function ismaxa($arr,$val){
$gras="";

if (max($arr)==$val){


$gras=" ;font-weight:900;color:blue;font-style: italic;";}
return $gras;
}
##*****************************#
##*********color black*********
function ismaxa1($arr,$val){
$gras="";
if (max($arr)==$val){$gras=" ;font-weight:900;font-style: italic;";}
return $gras;
}
##*****************************#
##colorisation de la cellule correspondant à la valeur mini d'un tableau
##les valeurs à 0 integer, pour être comparables doivent être formatées 
##avec un 0 décimal !!!
function ismina($arr,$val){
$mini=100;
$gras="";
for ($z=1;$z<=count($arr)-1;$z++)
{
if ($arr[$z]<=$mini){$mini=$arr[$z];}
}
if ($val==$mini){$gras=" ;font-weight:900;color:navy;font-style: italic;";}
return $gras;
}

####test**********************
####test**********************
####test**********************
####test**********************
####test**********************
function myminmax($arr,$val){
$mini=100;
$maxi=-100;
$gras="";
for ($z=0;$z<=count($arr)-1;$z++)
{
if (($arr[$z]!="")  && ($arr[$z]<=$mini)){$mini=$arr[$z];}
if (($arr[$z]!="")  && ($arr[$z]>=$maxi)){$maxi=$arr[$z];}
}
if ($val==$mini){$gras="<span style='font-weight:bold;font-style: italic;'><blink>".$val."</blink></span> ";}
elseif  ($val==$maxi){$gras="<span style='font-weight:bold;font-style: italic;'><blink>$val</blink></span>  ";}
else $gras=$val;
return $gras;
}

####test**********************
function mymin($arr,$val){
$mini=100;
$gras="";
for ($z=0;$z<=count($arr)-1;$z++)
{
if (($arr[$z]!="")  && ($arr[$z]<=$mini)){$mini=$arr[$z];}
}
if ($val==$mini){$gras="<span style='font-weight:bold;font-style: italic;'><blink>".$val."</blink></span> ";}
else $gras=$val;
return $gras;
}

####test**********************
function mymax($arr,$val){
$maxi=-100;
$gras="";
for ($z=0;$z<=count($arr)-1;$z++)
{
if (($arr[$z]!="")  && ($arr[$z]>=$maxi)){$maxi=$arr[$z];}
}
if  ($val==$maxi){$gras="<span style='font-weight:bold;font-style: italic;'><blink>$val</blink></span>  ";}
else $gras=$val;
return $gras;
}

####test**********************
####test**********************
####test**********************
####test**********************
####test**********************

##*****************************
function gtmois($m)
{
global $tabmois;
global $tabmois1;

switch ($m) {
    case $tabmois[0]:
        $mA=$tabmois1[0];
        break;
    case $tabmois[1]:
        $mA=$tabmois1[1];
        break;
    case $tabmois[2]:
        $mA=$tabmois1[2];
        break;
    case $tabmois[3]:
        $mA=$tabmois1[3];
        break;
    case $tabmois[4]:
        $mA=$tabmois1[4];
        break;
    case $tabmois[5]:
        $mA=$tabmois1[5];
        break;
    case $tabmois[6]:
        $mA=$tabmois1[6];
        break;
    case $tabmois[7]:
        $mA=$tabmois1[7];
        break;
    case $tabmois[8]:
        $mA=$tabmois1[8];
        break;
    case $tabmois[9]:
        $mA=$tabmois1[9];
        break;
    case $tabmois[10]:
        $mA=$tabmois1[10];
        break;
    case $tabmois[11]:
        $mA=$tabmois1[11];
        break;
	}
	return $mA;
}
##*****************************

function getmoy($arrayvar){
$moy=0;
for($i=0;$i<sizeof($arrayvar);$i++){
if($arrayvar[$i]!=""){$cnt++;}
}
$moy = round(array_sum($arrayvar) / $cnt,1);
return $moy;
}

function getStats($file){
$typefile = searchFile($file);
if($typefile=="month"){
list($jour,$meantemp,$hightemp,$hourhighttemp,$lowtemp,$hourlowtemp,$rain,$ventmoyen,$rafales,$hourrafales,$domdir) = parseFile($file);
$tn = getmin($lowtemp);
$tx = getmax($hightemp);
$wx = getmax($rafales);
$rx = getmax($rain);
$rs = array_sum($rain);
$tm = getmoy($meantemp);
$wm = getmoy($ventmoyen);
$dr = getrec($domdir);
$tmx = getmax($meantemp);
$tmn = getmin($meantemp);
return array($tn,$tx,$wx,$rx,$rs,$tm,$wm,$dr,$tmx,$tmn);
}
if($typefile=="year"){
global $moistxt;
list($annee,$mois,$meanmax,$meanmin,$meantemp,$hightemp,$datehighttemp,$lowtemp,$datelowtemp,$gel,$rain,$maxrain,$ventmoyen,$rafales,$domdir)=parseFile($file);
$tn = getmin($lowtemp);
$tx = getmax($hightemp);
$tnm = getmoy($meanmin);
$txm = getmoy($meanmax);
$tnmn = getmin($meanmin);
$txmx = getmax($meanmax);
$tmx = getmax($meantemp);
$tmn = getmin($meantemp);
$wx = getmax($rafales);
$rx = getmax($rain);
$rxj = getmax($maxrain);
$rs = array_sum($rain);
$tm = getmoy($meantemp);
$wm = getmoy($ventmoyen);
$dr = getrec($domdir);
return array($tn,$tx,$tnm,$txm,$tnmn,$txmx,$tmx,$tmn,$wx,$rx,$rxj,$rs,$tm,$wm,$dr);
}
}


function afficheTable($file){
if($file==""){echo "selectionnez un rapport à afficher"; return;}
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$sep = explode("/",$url);
for($i=0;$i<sizeof($sep)-1;$i++){
$lien .=$sep[$i]."/" ;
}
$typefile = searchFile($file,$data);
if($typefile=="year"){
global $moistxt;
list($annee,$mois,$meanmax,$meanmin,$meantemp,$hightemp,$datehighttemp,$lowtemp,$datelowtemp,$gel,$rain,$maxrain,$ventmoyen,$rafales,$domdir)=parseFile($file);
$legx = array_values($moistxt);
array_shift($legx);
$tn = getmin($lowtemp);
$tx = getmax($hightemp);
$tnm = getmoy($meanmin);
$txm = getmoy($meanmax);
$tnmn = getmin($meanmin);
$txmx = getmax($meanmax);
$tmx = getmax($meantemp);
$tmn = getmin($meantemp);
$wx = getmax($rafales);
$rx = getmax($rain);
$rxj = getmax($maxrain);
$rs = array_sum($rain);
$tm = getmoy($meantemp);
$wm = getmoy($ventmoyen);
$dr = getrec($domdir);
echo "
<table style=\"border:1px solid #ccd3e0\">
<caption style=\"color:#303D58\">Tableau récapitulatif pour ".gettitre($file)."</caption>
<tr style='background:#ccd3e0;'>
<td colspan='6' style='text-align:center;'><b>TEMPERATURES</b></td>
<td colspan='3' style='text-align:center;'><b>VENT</b></td>
<td colspan='3' style='text-align:center;'><b>PRECIPITATIONS</b></td></tr>
<tr style='background:#ccd3e0;'>
<td rowspan='2'><b>Mois</b></td>
<td colspan='2'><b>Températures min</b></td>
<td colspan='2'><b>Températures max</b></td>
<td rowspan='2'><b>Moyenne <br/>mensuelle</b></td>
<td rowspan='2'><b>Vent<br/>moyen</b></td>
<td rowspan='2'><b>Rafales max</b></td>
<td rowspan='2'><b>Secteur<br/> dominant</b></td>
<td rowspan='2'><b>Cumul</b></td>
<td rowspan='2'><b>Max en<br/>un jour</b></td>
</tr>
<tr style='background:#ccd3e0;'>
<td>Tn absolue</td>
<td>Tn moyenne</td>
<td>Tx absolue</td>
<td>Tx moyenne</td>
</tr>\n";
for ($i=0;$i<sizeof($legx);$i++){
echo"<tr>\n";
echo "<td style=\"background:#ccd3e0\">$legx[$i]</td>\n";
if($lowtemp[$i]!=""){echo "<td style=\"background:".gettempcolor($lowtemp[$i]).""; if($lowtemp[$i]==$tn){echo"; font-weight:bold";} echo"\">$lowtemp[$i] °C</td>\n";}else{echo "<td>---</td>\n";}
if($meanmin[$i]!=""){echo "<td style=\"background:".gettempcolor($meanmin[$i]).""; if($meanmin[$i]==$tnmn){echo"; font-weight:bold";} echo"\">$meanmin[$i] °C</td>\n";}else{echo "<td>---</td>\n";}
if($hightemp[$i]!=""){echo "<td style=\"background:".gettempcolor($hightemp[$i]).""; if($hightemp[$i]==$tx){echo"; font-weight:bold";} echo"\">$hightemp[$i] °C</td>\n";}else{echo "<td>---</td>\n";}
if($meanmax[$i]!=""){echo "<td style=\"background:".gettempcolor($meanmax[$i]).""; if($meanmax[$i]==$txmx){echo"; font-weight:bold";} echo"\">$meanmax[$i] °C</td>\n";}else{echo "<td>---</td>\n";}
if($meantemp[$i]!=""){echo "<td style=\"background:".gettempcolor($meantemp[$i]).""; if($meantemp[$i]==$tmn or $meantemp[$i]==$tmx){echo"; font-weight:bold";} echo"\">$meantemp[$i] °C</td>\n";}else{echo "<td>---</td>\n";}
if($ventmoyen[$i]!=""){echo "<td style=\"background:".getventcolor($ventmoyen[$i]*10).""; if($ventmoyen[$i]==$hw){echo"; font-weight:bold";} echo"\">$ventmoyen[$i] km/h </td>\n";}else{echo "<td>---</td>\n";}
if($rafales[$i]!=""){echo "<td style=\"background:".getventcolor($rafales[$i]).""; if($rafales[$i]==$wx){echo"; font-weight:bold";} echo"\">$rafales[$i] km/h </td>\n";}else{echo "<td>---</td>\n";}
if($domdir[$i]!=""){echo "<td style=\"background:RGB(".getdircolor($domdir[$i]).")\"><img style=\"height:10px\" src=\"http://".$lien."pics/$domdir[$i].gif\" alt=\"$domdir[$i]\"/> $domdir[$i]</td>\n";}else{echo "<td>---</td>\n";}
if($rain[$i]!=""){echo "<td style=\"background:".getpluiecolor($rain[$i]).""; if($rain[$i]==$rx){echo"; font-weight:bold";} echo"\">$rain[$i] mm</td>\n";}else{echo "<td>---</td>\n";}
if($maxrain[$i]!=""){echo "<td style=\"background:".getpluiecolor($maxrain[$i]).""; if($maxrain[$i]==$rxj){echo"; font-weight:bold";} echo"\">$maxrain[$i] mm</td>\n";}else{echo "<td>---</td>\n";}
}
echo "</tr>\n";
echo "<tr style='background:#ccd3e0'>\n<td style='font-weight:bold'>Total</td>\n<td>$tn °C</td>\n<td>$tnm °C</td>\n<td>$tx °C</td>\n<td>$txm °C</td>\n<td> $tm °C</td>\n<td>$wm km/h</td>\n<td>$wx km/h</td>\n<td><img style=\"height:10px\" src=\"http://".$lien."pics/$dr.gif\" alt=\"$dr\"/> $dr</td>\n<td>$rs mm</td>\n<td>$rxj mm</td>\n</tr>\n";
echo "</table>\n";




}
}
?>