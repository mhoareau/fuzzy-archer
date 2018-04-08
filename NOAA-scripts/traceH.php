

<?php
include ('constantes.inc.php');

$tabmois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
$spaces = array("     ","    ","   ","  ");
$space = array(" "," "," "," ");
$lab_dirvent = array('N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO');

$fichier= array(3);
If ($xtitre=="Jours") {
include ('GetMonthlyData.php');


} else {#début extraction Annuelle
include ('GetYearlyData.php');
}


#fin extraction annuelle

//if (count($Xlab[1])>count($Xlab[2]))  {$Xlab1=$Xlab[1];}  
//else {$Xlab1=$Xlab[2];}

##########################
# Sélection du graphique #
##########################
 
?>
<script type="text/javascript">


$(function () {
    // set the theme
    Highcharts.setOptions({
        colors: ['#3366cc', '#ff4f3b', '#FFAA00', '#FFAA00', '#ff4f3b', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
});
	//Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
	//return Highcharts.Color(color).setOpacity(0.5).get('rgba');});

})

$(function () {
    var chart;
    $(document).ready(function() {

	
	
if (mensuel==true)
{	
// chart1 Températures Maxima
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container1',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: 
				{
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
            title: {
                text: 'Températures maximum',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: 
				{
					step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 0.5,
                    color: '#ffffff'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>°C' ;
		});
		return s;
		},
		shared: true
	    },			
	    plotOptions: {
				series: {
					marker: {
						enabled: false
					}
				}
			},
            series: [ 
			{
				name: 'Maxima '+date1,
                data: dTmax[1]},{
                name: 'Maxima '+date2,
                data: dTmax[2]}
           ]
        });

		
// chart2 .....................................début graphique des tempétatures minimum/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
            title: {
                text: 'Températures minimum ',
               
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 0.5,
                    color: '#808080'
                }]
            },
	tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>°C' ;
		});
		return s;
		},
		shared: true
	    },	
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
         series: [{
                name: 'Minima '+date1,
                data: dTmin[1]},{
                name: 'Minima '+date2,
                data: dTmin[2]}
           ]
        });
//......................................fin graphique des tempétature minimum/
// chart3 ......................................début graphique des tempétature moyennes/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
           title: {
                text: 'Températures Moyennes',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 0.5,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>°C' ;
		});
		return s;
		},
		shared: true
	    },	
	    plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Température '+date1,
                data: dTemp[1]},{
                name: 'Température '+date2,
                data: dTemp[2]}
           ]
        });	
//......................................fin graphique des tempétature moyennes/
// chart4......................................début graphique des précipitations cumulées/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container4',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },

            title: {
                text: 'Précipitations Cumulées',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Pluie (mm)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
				min: 0
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#1e90ff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>mm' ;
		});
		return s;
		},
		shared: true
		},	       
		plotOptions: {
			series: {
				marker: {
					enabled: false
					}
				}
		},
            series: [{
                name: 'Pluviométrie '+date1,
				color: '#1e90ff',
                data: dRain1},{
                name: 'Pluviométrie '+date2,
				color: '#87cefa',
                data: dRain2}
           ]
        });
//......................................fin graphique des précipitations cumulées/			
// chart5......................................début graphique des précipitations /
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container7',
                type: 'column',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },

            title: {
                text: 'Précipitations',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Précipitations (mm)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#1e90ff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>mm' ;
		});
		return s;
		},
		shared: true
	    },	
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Pluviométrie '+date1,
				color: '#1e90ff',
                data: dRain[1]},{
                name: 'Pluviométrie '+date2,
				color: '#87cefa',
                data: dRain[2]}
           ]
        });
}
else //annuel
{
//......................................fin graphique des précipitations /	
// chart1 Températures Maxima
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container1',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: 
				{
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
            title: {
                text: 'Températures moyenne maximum',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: 
				{
					step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 0.5,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>°C' ;
		});
		return s;
		},
		shared: true
	    },			
	    plotOptions: {
				series: {
					marker: {
						enabled: false
					}
				}
			},
            series: [ 
			{
				name: 'Maxima '+date1,
                data: dTmeanmax[1]},{
                name: 'Maxima '+date2,
                data: dTmeanmax[2]}
           ]
        });

		
// chart2
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
            title: {
                text: 'Températures moyenne minimum ',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 0.5,
                    color: '#808080'
                }]
            },
	tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>°C' ;
		});
		return s;
		},
		shared: true
	    },	
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
         series: [{
                name: 'Minima '+date1,
                data: dTmeanmin[1]},{
                name: 'Minima '+date2,
                data: dTmeanmin[2]}
           ]
        });

// chart3
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
           title: {
                text: 'Températures Moyennes',
               
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 0.5,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>°C' ;
		});
		return s;
		},
		shared: true
	    },	
	    plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Température '+date1,
                data: dTemp[1]},{
                name: 'Température '+date2,
                data: dTemp[2]}
           ]
        });	

// chart4 ......................................début graphique des précipitations cumulées/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container4',
                type: 'spline',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },

            title: {
                text: 'Précipitations Cumulées',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Pluie (mm)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
				min: 0
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffffff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>mm' ;
		});
		return s;
		},
		shared: true
		},	       
		plotOptions: {
			series: {
				marker: {
					enabled: false
					}
				}
		},
            series: [{
                name: 'Pluviométrie '+date1,
				color: '#1e90ff',
                data: dRain1},{
                name: 'Pluviométrie '+date2,
				color: '#87cefa',
                data: dRain2}
           ]
        });
//......................................fin graphique des précipitations cumulées/			
// chart5..................................début graphique des précipitations /
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container7',
                type: 'column',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },

            title: {
                text: 'Précipitations',
            
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Précipitations (mm)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#1e90ff;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>mm' ;
		});
		return s;
		},
		shared: true
	    },	
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Pluviométrie '+date1,
				color: '#1e90ff',
                data: dRain[1]},{
                name: 'Pluviométrie '+date2,
				color: '#87cefa',
                data: dRain[2]}
           ]
        });
}
//......................................fin graphique des précipitations /				
// chart6 ......................................début graphique du vent /
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container5',
                type: 'column',
                marginRight: 10,
                marginBottom: 65,

				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },
            title: {
                text: 'Vent',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Vent (km/h)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#228b22;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>km/h' ;
		});
		return s;
		},
		shared: true
	    },	
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Vent '+date1,
				color: '#228b22',
                data: dVent[1]},{
                name: 'Vent '+date2,
				color: '#32cd32',
                data: dVent[2]}
				//,{
                //name: 'Rafales '+date1,
                //data: dGust[1]},{
                //name: 'Rafales '+date2,
                //data: dGust[2]}
           ]
        });
//......................................fin graphique du vent /				
// chart7...............................début graphique des rafales /
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container6',
                type: 'column',
                marginRight: 10,
                marginBottom: 65,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },

            title: {
                text: 'Rafales',
                
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: {
                title: {
                    text: 'Rafales (km/h)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#228b22;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>km/h' ;
		});
		return s;
            },
            shared: true
        },        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Rafales '+date1,
				color: '#228b22',
                data: dGust[1]},{
                name: 'Rafales '+date2,
				color: '#32cd32',
                data: dGust[2]}
           ]
        });
//......................................fin graphique des rafales /		
// chart11..........................début graphique de la direction du vent/
        chart = new Highcharts.Chart({
            chart: {
			type: 'line',
			renderTo: 'container11',
            polar: true
			},
		pane: { 
			size: '70%',
			startAngle: 0,
			endAngle: 360

			},
		navigation: {
			buttonOptions: {
				enabled: false
				}
			},
legend: {
	layout: 'horizontal',
	align: 'center',
	floating: true,
	borderWidth: 1
    },

		title: {
			text: 'Direction des vents',
			
			},
		subtitle: {
                text: nomsite,
                x: -20
			},
      credits: {
            text: '',
            href: ''
        },
		xAxis: {
        categories: ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSO', 'SO', 'OSO', 'O', 'ONO', 'NO', 'NNO']
			},	    
		yAxis: {
			min: 0
			},
	    plotOptions: {
	        series: {
	            pointStart: 0,
	            pointInterval: 22.5
	        },
	        column: {
	            pointPadding: 0,
	            groupPadding: 0
	        }
	    },		
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#228b22;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+' %</span>' ;
		});
		return s;
		},
		shared: true
	    },	
            series: [{
                name: 'Vents dominants '+date1,
		color: '#228b22',
		type: 'line',		
	        pointPlacement: 'between',
                data: dDir[1]},{
                name: 'Vents dominants '+date2,
				color: '#32cd32',
 		type: 'line',
                data: dDir[2]}
           ]
        });

		
		if (sun)	{	
//......................................fin graphique de la direction du vent/
// chart8.....................................début graphique UV/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container8',
                type: 'column',
                marginRight: 10,
                marginBottom: 30,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
            legend: {

				layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 50,			
				floating: true,
                borderWidth: 1
            },

            title: {
                text: 'Index UV',
                x: -20 //center
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: '',
            href: ''
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: [{
                title: {
                    text: 'Index UV'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
			}]
		},{
                title: {
                    text: 'Index UV'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
                opposite: true
            }
	    ],
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#9932cc;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span> ' ;
		});
		return s;
		},
		shared: true
	    },	
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: 
			[	
				{
                name: 'UV maxima '+date1,
				color: '#9932cc',
				type: 'column',
                data: dUVmax[1]
				},
				{
                name: 'UV maxima '+date2,
				color: '#9370db',
				type: 'column',
                data: dUVmax[2]
				},
				{	
                name: 'UV moyens '+date1,
				color: '#9932cc',
				type: 'line',            
                data: dUVavg[1]
				},
				{
                name: 'UV moyens '+date2,
 				color: '#9370db',
				type: 'line',                
                data: dUVavg[2]}
           ]
        });
//......................................fin graphique UV/	
// chart9.....................................début graphique radiations solaires/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container9',
                type: 'column',
                marginRight: 10,
                marginBottom: 30,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
            legend: {

				layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 50,			
				floating: true,
                borderWidth: 1
            },

            title: {
                text: 'Radiations solaires',
                x: -20 //center
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: 'Météo Villarzel',
            href: 'http://www.boock.ch/meteo-villarzel.php'
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: [{
                title: {
                    text: 'Radiations (W/m²)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
			}]
		},{
                title: {
                    text: 'Radiations solaires'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
                opposite: true
            }
	    ],
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffa500;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>W/m²' ;
		});
		return s;
		},
		shared: true
	    },	

        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Radiations maxima '+date1,
				color: '#ffa500',
				type: 'column',
                data: dRadmax[1]},{
                name: 'Radiations maxima '+date2,
				color: '#ffd700',
				type: 'column',
                data: dRadmax[2]},{		
 				color: '#FFAA00',
               name: 'Radiations moyennes '+date1,
			   color: '#ffa500',
				type: 'line',            
                data: dRadavg[1]},{
   				color: '#00FF00',
               name: 'Radiations moyennes '+date2,
			   color: '#ffd700',
				type: 'line',                
                data: dRadavg[2]}
           ]
        });
//......................................fin graphique radiations solaires/	
// chart10......................................début graphique énergie solaires/
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container10',
                type: 'column',
                marginRight: 10,
                marginBottom: 30,
				plotBorderColor: '#346691',
				plotBorderWidth: 2
            },
			navigation: {
				buttonOptions: {
					enabled: false
				}
			},
            legend: {

				layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 50,			
				floating: true,
                borderWidth: 1
            },

            title: {
                text: 'Energie solaires totales',
                x: -20 //center
            },
            subtitle: {
                text: nomsite,
                x: -20
            },
            credits: {
            text: 'Météo Villarzel',
            href: 'http://www.boock.ch/meteo-villarzel.php'
        },
            xAxis: {
                categories: dXlab,            
				labels: {
                step: MonStep
				}
            },
            yAxis: [{
                title: {
                    text: 'Energie (kWh/m²)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
			}]
		},{
                title: {
                    text: 'Energie (kWh/m²)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
                opposite: true
            }
	    ],
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#ffa500;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+'</span>kWh/m²' ;
		});
		return s;
		},
		shared: true
	    },	

        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
            series: [{
                name: 'Radiations totales '+date1,
				color: '#ffa500',
		type: 'column',
                data: dRadtot[1]},{
                name: 'Radiations totales '+date2,
				color: '#ffd700',
 		type: 'column',
                data: dRadtot[2]}
           ]
        });
	}
		
        });
        });


//Non utilisé

function formatage(){
                var s = '<b><span style="color:blue;font-size:small; font-weight:800">'+ this.x+'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:black;font-size:small; font-weight:800">'+  point.y+'</span>' ;
});
return s;
}
	
//Non utilisé	
    function comArr(unitsArray) { 
        var outarr = [];
        for (var i = 0; i < dXlab.length; i++) {
         outarr[i] = [dXlab[i], unitsArray[i]];
        }
      return outarr;
    } 
			
eval(<?php echo  "'var dXlab =  ".json_encode($xlabel)."'" ?>);
<?php echo  "'var xtitre =  ".($xtitre)."'" ?>;
eval(<?php echo  "'var dTmin =  ".json_encode($lowtemp)."'" ?>);
eval(<?php echo  "'var dTmax  =  ".json_encode($hightemp)."'" ?>);
eval(<?php echo  "'var dTmeanmin =  ".json_encode($meanmin)."'" ?>);
eval(<?php echo  "'var dTmeanmax =  ".json_encode($meanmax)."'" ?>);
eval(<?php echo  "'var dTemp =  ".json_encode($meantemp)."'" ?>);
eval(<?php echo  "'var dRainc =  ".json_encode($raincum)."'" ?>);
eval(<?php echo  "'var dTmM =  ".json_encode($meanmax)."'" ?>);
eval(<?php echo  "'var dTmm =  ".json_encode($meanmin)."'" ?>);
eval(<?php echo  "'var dSun =  ".json_encode($soleil)."'" ;?>);
eval(<?php echo  "'var dRain =  ".json_encode($rain)."'" ;?>);
eval(<?php echo  "'var dGust =  ".json_encode($rafales)."'" ?>);
eval(<?php echo  "'var dVent =  ".json_encode($ventmoyen)."'" ?>);
eval(<?php echo  "'var dUVavg =  ".json_encode($uv_avg)."'" ?>);
eval(<?php echo  "'var dUVmax =  ".json_encode($uv_max)."'" ?>);
eval(<?php echo  "'var dRadtot =  ".json_encode($rad_tot)."'" ?>);
eval(<?php echo  "'var dRadavg =  ".json_encode($rad_avg)."'" ?>);
eval(<?php echo  "'var dRadmax =  ".json_encode($rad_max)."'" ?>);
eval(<?php echo  "'var dDir =  ".json_encode($wind_d)."'" ?>);
eval(<?php echo  "'var dXlabvent=  ".json_encode($lab_dirvent)."'" ?>);
<?php echo  "var MyFormat =  '".$format."'" ?>;
<?php echo  "var MonStep =  '".$monstep."'" ?>;
<?php echo  "var date1 =  '".$date1."'" ?>;
<?php echo  "var date2 =  '".$date2."'" ?>;
<?php echo  "var norm = '".FICHE_NORMALES."'" ?>;
<?php echo  "var sun = '".$sun."'" ?>;
<?php echo  "var nomsite = '".NOM_SITE."'" ?>;
<?php echo  "var mensuel = '".$mensuel."'" ?>;


var tmax;
if (norm='TRUE'){ tmax="{name: 'Maxima '+date1,data: dTmax[1]},{name: 'Maxima '+date2,data: dTmax[2]},{name: 'Maxima Normales',data: dTmax[3]}"}
else {tmax="{name: 'Maxima '+date1,data: dTmax[1]},{name: 'Maxima '+date2,data: dTmax[2]}"};


//Cumul pluie sorti du php pb de traitement plus compliqué !!!!
		var dRain1=new Array();
		var dRain2=new Array();
		var dRain3=new Array();

        dRain1[0]= Math.floor(dRain[1][0]*1);
        dRain2[0]= Math.floor(dRain[2][0]*1);
		dRain3[0]= '';
        for(var i = 1; i < dRain[1].length; i++) 
			{
			dRain1.push((dRain1[i-1]*1)+Math.round(dRain[1][i]*1));
			} 
        for(var i = 1; i < dRain[2].length; i++) 
			{
			dRain2.push((dRain2[i-1]*1)+Math.round(dRain[2][i]*1));	
			}
		
		if (mensuel!=true)
		{
			dRain3[0]= Math.floor(dRain[3][0]*1);
			for(var i = 1; i < dRain[3].length; i++) 
			{
				dRain3.push((dRain3[i-1]*1)+Math.round(dRain[3][i]*1));	
			}	

			}	  
		else 
		{
			for(var i = 1; i < dRain[2].length; i++) 
			{
				dRain3[i]='';	
			}	
		}
			
				


		</script>
