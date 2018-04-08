
<table class="myTable" border=1 style="font-size:9pt;font-weight:400" cellspacing=2 width="900">
<?php
 echo " <TR bgcolor='#ffffff'> 
    <TD valign='top'colspan=11 color='black' size='2'>
	<br><center><B><U><Font size='4'>$lx_title_rap $annee[1]</Font></U></B></Center>";
	if ($annee[$index]==PREMIERE_ANNEE) {echo "<Font color='black' size='1'><Center>Les enregistrements commencent$lx_on". PREMIER_JOUR." ".$tabmois[PREMIER_MOIS-1]." ".PREMIERE_ANNEE."</Center></Font>";}
     else {echo "<Font color='black' size='1'><Center>&nbsp</Center></Font>";}
echo "
</td></tr>";
?>
<tr align="right">

<td rowspan="3" style="text-align:center; width:50px; font-weight:700"><strong><?php echo $lx_mth?></strong></td>
<td colspan="5" style="text-align:center; font-weight:900"><strong><?php echo $lx_temp?></strong></td>
<td colspan="3" style="text-align:center;; font-weight:900"><?php echo $lx_wind?></td>
<td colspan="2" style="text-align:center;; font-weight:900"><?php echo $lx_rain?></td>
</tr>
<tr>

<td colspan="2" style="text-align:center; font-weight:700"><strong><?php echo $lx_temp_min?></strong></td>
<td colspan="2" style="text-align:center;  width:100px;font-weight:700"><strong><?php echo $lx_temp_max?></strong></td>

<td rowspan="2" style="text-align:center; font-weight:700"><strong><?php echo $lx_avg?><br/> <?php echo $lx_m_sing?></strong></td>
<td rowspan="1" style="text-align:center; font-weight:700"><?php echo $lx_spd?><br><?php echo $lx_avg?></td>
<td rowspan="1" style="text-align:center; font-weight:700"><?php echo $lx_raf?><br><?php echo $lx_max?></td>
<td rowspan="2" style="text-align:center; font-weight:700"><?php echo $lx_wind_dom?></td>
<td rowspan="2" style="text-align:center; font-weight:700"><?php echo $lx_cumul?></td>
<td rowspan="2" style="text-align:center; font-weight:700"><?php echo $lx_max?> <br><?php echo $lx_one_day?></td>
</tr>
<tr>
<td style="text-align:center; font-weight:700"><?php echo $lx_tn_abs?></td>
<td style="text-align:center; width:100px; font-weight:700"><?php echo $lx_tn_avg?></td>
<td style="text-align:center;;font-weight:700"><?php echo $lx_tx_abs?></td>
<td style="text-align:center; width:100px; font-weight:700"><?php echo $lx_tx_avg?></td>
</tr>
<?php
for ($index=1; $index<2; $index++) 
{

for ($i=0;$i<$nb2;$i++)
{
echo '<tr><td>'.$tabmois1[$i];//.
if($lowtemp[$index][$i]!=null){echo "<td style='text-align:right; background:".gettempcolor($lowtemp[$index][$i])."'; >";echo mymin($lowtemp[$index],number_format($lowtemp[$index][$i],1)).' °C' .$lx_on. $jourlowtemp[$index][$i]."</td>";} else{echo "<td>---</td>";}
if($meanmin[$index][$i]!=""){echo "<td style='text-align:right; background:".gettempcolor($meanmin[$index][$i]).";'>"; echo mymin($meanmin[$index],number_format($meanmin[$index][$i],1))." °C</td>";}else{echo "<td>---</td>\n";}
if($hightemp[$index][$i]!=""){echo "<td style='text-align:right; background:".gettempcolor($hightemp[$index][$i]).";'>"; echo mymax($hightemp[$index],number_format($hightemp[$index][$i],1)).' °C'.$lx_on. $jourhightemp[$index][$i]."</td>";}else{echo "<td>---</td>";}
if($meanmax[$index][$i]!=""){echo "<td style='text-align:right; background:".gettempcolor($meanmax[$index][$i]).";'>"; echo mymax($meanmax[$index],number_format($meanmax[$index][$i],1))." °C</td>";}else{echo "<td>---</td>\n";}
if($meantemp[$index][$i]!=""){echo "<td style='text-align:right; background:".gettempcolor($meantemp[$index][$i])."'>"; echo myminmax($meantemp[$index],number_format($meantemp[$index][$i],1))." °C</td>";}else{echo "<td>---</td>\n";}
if($ventmoyen[$index][$i]!=""){echo "<td style='text-align:right; background:".getventcolor($ventmoyen[$index][$i]).";'>"; echo mymax($ventmoyen[$index],number_format($ventmoyen[$index][$i],1))." km/h</td>";} else {echo "<td>--- ---</td>\n";}
if($rafales[$index][$i]!=""){echo "<td style='text-align:right; background:".getventcolor($rafales[$index][$i])."'>"; echo mymax($rafales[$index],number_format($rafales[$index][$i],1))." km/h</td>";} else {echo "<td>--- ---</td>\n";}
$x=str_replace("W","O",$domdir[$index][$i]);
if($domdir[$index][$i]!=""){echo "</td><td style='text-align:right; background:RGB(".getdircolor($x).")'>"; echo "<img style='height:10px' src='".$rep_img."/".$x.".gif' alt='".$x."'/>". $x."</td>";} else {echo "<td> </td>";}
if($rain[$index][$i]!=""){echo "</td><td style='text-align:right; background:".getpluiecolor($rain[$index][$i])."'";echo"\">".mymax($rain[$index],number_format($rain[$index][$i],1))." mm</td>\n";}else{echo "<td style='text-align:right;'>0 mm</td>\n";}
if($rainmax[$index][$i]!=""){echo "</td><td style=';text-align:right; background:".getpluiecolor($rainmax[$index][$i])."'"; echo"\">".mymax($rainmax[$index],number_format($rainmax[$index][$i],1))." mm ".$lx_on. $jourrainmax[$index][$i]."</td>\n";}else{echo "<td> </td>";}

}
echo '<tr><td>'.$lx_recap;//.
if($lowtemp_y[$index]!=""){echo "<td style='text-align:right;'; >";echo $lowtemp_y[$index]."</td>";} else{echo "<td>---</td>";}
if($meanmin_y[$index]!=""){echo "<td style='text-align:right; '>"; echo $meanmin_y[$index]."</td>";}else{echo "<td>---</td>\n";}
if($hightemp_y[$index]!=""){echo "<td style='text-align:right;'>"; echo $hightemp_y[$index]."</td>";}else{echo "<td>---</td>";}
if($meanmax_y[$index]!=""){echo "<td style='text-align:right;'>"; echo $meanmax_y[$index]."</td>";}else{echo "<td>---</td>\n";}
if($meantemp_y[$index]!=""){echo "<td style='text-align:right;'>"; echo $meantemp_y[$index]."</td>";}else{echo "<td>---</td>\n";}
if($ventmoyen_y[$index]!=""){echo "</td><td style='text-align:right;'"; echo"\">".$ventmoyen_y[$index]." kmh</td>\n";}else{echo "<td style='text-align:right;'> </td>\n";}
if($rafales_y[$index]!=""){echo "</td><td style='text-align:right;'"; echo"\">".$rafales_y[$index]." kmh</td>\n";}else{echo "<td style='text-align:right;'> </td>\n";}
$x=str_replace("W","O",$value6[4]);
if($x!=""){echo "</td><td style='text-align:right; '>"; echo "<img style='height:10px' src='".$rep_img."/".$x.".gif' alt='".$x."'/>". $x."</td>";} else {echo "<td> </td>";}
if($totalrain_y[$index]!=""){echo "</td><td style='text-align:right;'"; echo"\">".$totalrain_y[$index]." mm</td>\n";}else{echo "<td style='text-align:right;'> </td>\n";}
if($maxpluie_y[$index]!=""){echo "</td><td style='text-align:right; '"; echo"\">".$maxpluie_y[$index]." mm</td>\n";}else{echo "<td style='text-align:right;'> </td>\n";}

echo "<tr><td colspan=6>&nbsp;</td></tr>";;
}
?>


</table>

<?php

?>