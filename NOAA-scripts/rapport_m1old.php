
<table class="myTable" border=1 style="font-size:11pt;font-weight:400" cellspacing=2 width="900">
  <TR bgcolor='#ffffff'>
    <TD valign='top'colspan=11 color='black' size='2'>
	<br><center><U><Font size='4'><?php echo $lx_title_rap .$moisA[1].' '. $annee[1];?></Font></U></Center><BR>
</td>
</tr>
<tr align="right">

<td rowspan="2" style="text-align:center;font-size:12pt; font-weight:700" ><?php echo $lx_day?></td>
<td colspan="3" style="text-align:center;font-size:12pt; font-weight:700"><?php echo $lx_temp?></td>
<td colspan="2" style="text-align:center;font-size:12pt; font-weight:700"><?php echo $lx_wind?></td>
<td rowspan="2" style="text-align:center;font-size:12pt; font-weight:700"><?php echo $lx_rain?></td>
</tr>
<tr>
<td colspan="1" style="text-align:center;font-size:12pt; font-weight:900">Minima</td>

<td colspan="1" style="text-align:center;font-size:12pt; font-weight:700">Maxima</td>
<td style="text-align:center;font-size:12pt; font-weight:700">&nbsp;<?php echo $lx_avg?>&nbsp;</td>
<td style="text-align:center;font-size:12pt; font-weight:700"><?php echo $lx_wind_spd.' (Rafales)'?></td>
<td style="text-align:center;font-size:12pt; font-weight:700"><?php echo $lx_secteur?></td></tr>
<?php
for ($index=1; $index<2; $index++) 
{
$tn = $lowtemp_m[$index];
$tx = $hightemp_m[$index];
$wx = $rafales_m[$index];
$rx = getmax($rain[$index]);
$rs = $rain_m[$index];
$tm = $meantemp_m[$index];
$wm = $ventmoyen_m[$index];
//$dr = getrec($dir[$index]);
$tmx = getmax($meantemp[$index]);
$tmn = getmin($meantemp[$index]);

	for ($i=0;$i<$nb[$index]+1;$i++)
{
echo 
'<tr><td>'.$jour[$index][$i];//.
if(is_numeric($lowtemp[$index][$i])){echo "<td style='text-align:right; background:".gettempcolor($lowtemp[$index][$i])."'; >";echo mymin($lowtemp[$index],$lowtemp[$index][$i])." °C".$lx_at. $hourlowtemp[$index][$i]."</td>";} else{echo "<td>---</td>";}
if(is_numeric($hightemp[$index][$i])){echo "<td style='text-align:right; background:".gettempcolor($hightemp[$index][$i]).";'>"; echo mymax($hightemp[$index],$hightemp[$index][$i])." °C".$lx_at. $hourhightemp[$index][$i]."</td>";}else{echo "<td>---</td>";}
if(is_numeric($meantemp[$index][$i])){echo "<td style='text-align:right; background:".gettempcolor($meantemp[$index][$i])."'>"; echo myminmax($meantemp[$index],$meantemp[$index][$i])." °C</td>";}else{echo "<td>---</td>\n";}
if(is_numeric($ventmoyen[$index][$i])){echo "<td style='text-align:right; background:".getventcolor($rafales[$index][$i]).";'>"; echo $ventmoyen[$index][$i]." km/h &nbsp;&nbsp;(".mymax($rafales[$index],$rafales[$index][$i])." km/h".")</td>";} else {echo "<td>--- ---</td>\n";}

if($dir[$index][$i]!=""){echo "</td><td style='text-align:right; background:RGB(".getdircolor($dir[$index][$i]).")'>"; echo "<img style='height:10px' src='".$rep_img."/".$dir[$index][$i].".gif' alt='".$dir[$index][$i]."'/>". $dir[$index][$i]."</td>";} else {echo "<td> </td>";}

if($rain[$index][$i]!=""){echo "</td><td style='color:white;text-align:right; background:".getpluiecolor($rain[$index][$i])."'"; if($rain[$index][$i]==$rx){echo"; font-weight:bold";} echo"\">".mymax($rain[$index],$rain[$index][$i])." mm</td>\n";}else{echo "<td style='text-align:right;'>0 mm</td>\n";}


echo '</tr>';

}
}
?>


</table>

