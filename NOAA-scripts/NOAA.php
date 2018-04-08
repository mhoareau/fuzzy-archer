<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="SUBJECT" CONTENT="m&#65533;t&#65533;o Vantage Pro Davis">
<META NAME="DESCRIPTION" CONTENT="Relev&#65533;s M&#65533;t&#65533;o Quotidien et Historiques">
<META NAME="ABSTRACT" CONTENT="Relev&#65533;s M&#65533;t&#65533;o Quotidien et Historiques">
<META NAME="KEYWORDS" CONTENT="M&#65533;t&#65533;o, m&#65533;t&#65533;o, meteo, pluie, vent, temp&#65533;rature, temperature, station, Vantage, Davis, Pro, Davis Vantage Pro,pression, UV, $lx_sunny, soleil,">
<META NAME="REVISIT-AFTER" CONTENT="5 DAYS">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=9" >
<META NAME="LANGUAGE" CONTENT="FR">
<meta http-equiv="content-type" content="text/plain; charset=ISO-8859-1"> 
<META NAME="ROBOTS" CONTENT="All">
<META NAME="VERSION" CONTENT="V1.1">

<script type="text/javascript" src="./highchartsNOAA/jquery.min.js"></script>

<Style type="text/css">
form {
    padding:0px;
    margin-bottom:0px;
  }
  body {
    background-color: #FFFFFF;
    font-family:Arial, Helvetica, sans-serif;
    color: #000000;
    font-size: 16px;
  }
 .rap1 {font-family:Arial, Helvetica, sans-serif;font-size:small;font-weight:800
}
 .rap2 {font-family:Arial, Helvetica, sans-serif;font-size:small;font-weight:400
}


.myTable { background-color:#FFFFFF;border-collapse:collapse; }
.myTable th { background-color:#BDB76B;color:white; }
.myTable td, .myTable th { padding:1px;border:1px solid #BDB76B; }
.stylegrosrouge { font-weight:800 ; color: navy;}
.stylegros { font-weight:800 ;}
</style>
<?php

error_reporting(E_ALL & ~E_NOTICE);


require ('constantes.inc.php');
if (file_exists("translate1.".LANGUE.".php")) {include ("translate1.".LANGUE.".php"); $rep_img="pics".LANGUE;} else {include "translate1.inc.php"; $rep_img="pics";}
require ('procs.inc.php');
$lx_year_r="r_annuel"; 
$lx_year_c="c_annuel";
$lx_mth_c="c_mensuel";
$lx_mth_r="r_mensuel";
$mon_logo=LOGO ;
$sun=SONDE_SOL;
echo "
<BR>
<HR>
<Center>
<table border=0>
<TR>
    <td><form action='NOAA.php'>
	<input type='hidden' name='period' value='c_mensuel'>
	<input type='submit' value='$lx_comp_mth'></Form></td>
    <td><form action='NOAA.php'>
	<input type='hidden' name='period' value='c_annuel'>
	<input type='submit' value='$lx_comp_yr'></Form></td>
    <td><form action='NOAA.php'>
	<input type='hidden' name='period' value='r_mensuel'>
	<input type='submit' value='$lx_rap_mth'></Form></td>
    <td><form action='NOAA.php'>
	<input type='hidden' name='period' value='r_annuel'>
	<input type='submit' value='$lx_rap_yr'></Form></td>
  </tr>
</table>
<HR>";

$period = (isset ($_GET['period'])) ? $_GET['period'] : "r_mensuel";
if ($period == "r_mensuel") {include "mensuelcompareH1.php";}
if ($period == "c_mensuel" or $period == "" ) {include "mensuelcompareH.php";}
if ($period == "r_annuel") {include "annuelcompareH1.php";}
if ($period == "c_annuel") {include "annuelcompareH.php";}
echo "</center>";
?>
 
<body>
<table style="top:600px;" align="center" width="172">
  <tr>
<td colspan="1">
<div id="container1" style="width: 450px; height: 350px; margin: 0 auto"></div>
</td>
<td colspan="1">
<div id="container2" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<tr>
<td colspan="1">
<div id="container3" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
<td colspan="1">
<div id="container4" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td> 
</tr>
<?php 
if ( $period == "c_annuel"){
?>
<tr>
<td colspan="1">
<div id="container5" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
<td colspan="1">
<div id="container7" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<tr>
<td colspan="1">
<div id="container6" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>

 <td colspan="1">
<div id="container11" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<?php 
if ($sun=='TRUE'){
//J'ai les sondes soleil
?>
<tr>
<td colspan="1">
<div id="container8" style="width: 450x; height: 350px; margin: 0 auto;"></div>
</td>

<td colspan="1">
<div id="container9" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr><tr>
<td colspan="1">
<div id="container10" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
  <td colspan="1">
<div id="container11" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<?php 
}
} 
if ( $period == ""  or $period == "c_mensuel" ) {?>
<tr>
<td colspan="2">
<div id="container7" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<tr>
<td colspan="2">
<div id="container6" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<tr>
<td colspan="2">
<div id="container5" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
 <td colspan="2">
<div id="container11" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<?php 
if ($sun=='TRUE'){
//J'ai les sondes soleil
?>
<tr>
<td colspan="2">
<div id="container8" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<tr>
<td colspan="2">
<div id="container9" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr><tr>
<td colspan="2">
<div id="container10" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<?php  
}} 
?>

<?php
if ($period == "r_annuel")
{ 
if ($sun=='TRUE'){
//J'ai les sondes soleil
?>
<tr>
<td colspan="1">
<div id="container8" style="width: 450x; height: 350px; margin: 0 auto;"></div>
</td>

<td colspan="1">
<div id="container9" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr><tr>
<td colspan="1">
<div id="container10" style="width: 450px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<?php 
} 
}
?>

<?php 

 
if ($period == "r_mensuel") {
if ($sun=='TRUE'){
//J'ai les sondes soleil
?>
<tr>
<td colspan="2">
<div id="container8" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<tr>
<td colspan="2">
<div id="container9" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr><tr>
<td colspan="2">
<div id="container10" style="width: 900px; height: 350px; margin: 0 auto;"></div>
</td>
</tr>
<?php } 
} 
?>



</table>
<script src="./highchartsNOAA/js/highcharts.js"></script>
<script src="./highchartsNOAA/js/highcharts-more.js"></script>
<script src="./highchartsNOAA/js/modules/exporting.js"></script>
<?php echo THEME ?>

		<script type="text/javascript">
			var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
			Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return Highcharts.Color(color).setOpacity(0.7).get('rgba');
});
		</script>

</body>
</html>


