

<?php


//$tabmois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
//$spaces = array("     ","    ","   ","  ");
//$space = array(" "," "," "," ");
//$lab_dirvent = array('N','NNE','NE','ENE','E','ESE','SE','SSE','S','SSO','SO','OSO','O','ONO','NO','NNO');


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
                text: 'Températures',

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
                var s = '<b><span style="color:#ff4f3b;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
				name: 'Maxi',
        color: '#ff4f3b',
                data: dTmax[1]},{
				name: 'Moyenne',
        color: '#FFAA00',
                data: dTemp[1]},{
        name: 'Mini',
        color: '#3366cc',
                data: dTmin[1]}
           ]
        });

// chart4 Pluie
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
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
                var s = '<b><span style="color:#1e90ff;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
                name: 'Cumul pluie',
                color: '#1e90ff',
				type: 'area',
                data: dRain1},{
                name: 'Pluie',
                color: '#87cefa',
                data: dRain[1]}
           ]
        });
// chart6 vent
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
                type: 'column',
                zoomType: 'x',
                spacingRight: 20,
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
                maxZoom: 7, // seven days            
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
                var s = '<b><span style="color:#32cd32;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
                name: 'Vent ',
                color: '#228b22',
                data: dVent[1]},{
                name: 'Rafales ',
                color: '#32cd32',
                data: dGust[1]}
           ]
        });
		
// chart11 direction
        chart = new Highcharts.Chart({
            chart: {
			type: 'column',
			marginBottom: 65,
			renderTo: 'container4',
            polar: true
			},
		pane: { 
			size: '80%',
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

			min: 0,
			max:100,
			labels:{
				enabled: false
			},
			},
		
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#32cd32;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+' %</span>' ;
		});
		return s;
		},
		shared: true
	    },	
            series: [{
                name: 'Vents dominants ',
				color: '#32cd32',
				type: 'column',		
				pointPlacement: -0.15,
                data: dDir[1]}
           ]
        });
			
}
else //annuel
{	
// chart1 Températures 
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
                text: 'Températures',
                
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
                var s = '<b><span style="color:#ff4f3b;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
				name: 'Maxi',
				color: '#ff4f3b',
                data: dTmax[1]},
			{
                name: 'Mini',
				color: '#3366cc',
                data: dTmin[1]},
			{
                name: 'Moy',
				color: '#FFAA00',
                data: dTemp[1]},
			{
				name: 'Normale Moy',
				color: '#FFAA00',
				dashStyle : 'shortdot',
                data: [25.1, 25.2, 24.8, 23.9, 22.4, 20.8, 20, 20, 20.5, 21.5, 22.8, 24.8]},
               
           ]
        });
		

// chart4 précipitations

chart = new Highcharts.Chart({
chart: {
renderTo: 'container2',
type: 'column',
marginRight: 65,
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
	x: -10 //center
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
	text: 'Pluie (mm)'
	},
	plotLines: [{
	value: 0,
	width: 1,
	color: '#808080'
	}],
	min: 0
},
{

	opposite: true,
	title: {
	text: 'Cumul (mm)'
	},
	plotLines: [{		
	value: 0,
	width: 1,
	color: '#808080'
	}],
	min: 0
}
],
tooltip: { formatter: function() {
	var s = '<b><span style="color:#87cefa;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';            
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

series: [
{
name: 'Pluviométrie cumul',
yAxis: 1,
color: '#1e90ff',
type: 'area',
data: dRain1},
{
name: 'Norme cumul',
yAxis: 1,
color: '#ffa500',
type: 'line',
data: [278.6, 629.6, 862.1, 1016.4, 1114, 1190.9, 1248.7, 1306.5, 1356.5, 1399.9, 1469.9, 1658.6]},
{
name: 'Pluviométrie ',
color: '#87cefa',
data: dRain[1]},
{
name: 'Norme',
lineWidth: 0,
marker: {
enabled: true,
radius: 2
},
color: '#ffa500',
type: 'line',
data: [278.6, 351, 232.5, 154.3, 97.6, 76.9, 57.8, 57.8, 50, 43.4, 70, 188.7]}
]
});

       // chart6 vent
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
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
                var s = '<b><span style="color:#32cd32;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
                name: 'Vent ',
                color: '#228b22',
                data: dVent[1]},{
                name: 'Rafales ',
                color: '#32cd32',
                data: dGust[1]}
           ]
        });
		
// chart11 direction
        chart = new Highcharts.Chart({
            chart: {
			type: 'column',
			renderTo: 'container4',
            polar: true
			},
		pane: { 
			size: '80%',
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
	align: 'left',
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
		
	    tooltip: { formatter: function() { 
                var s = '<b><span style="color:#32cd32;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
                $.each(this.points, function(i, point) {
                    s += '<br/><span style="color:'+ point.series.color +'">'+  
		       point.series.name +':</span><span style="color:#ffffff;font-size:small; font-weight:800">'+  point.y+' %</span>' ;
		});
		return s;
		},
		shared: true
	    },	
            series: [{
                name: 'Vents dominants ',
				color: '#228b22',
				type: 'column',		
				pointPlacement: 'between',
                data: dDir[1]}
           ]
        });
		

}
				
		
if (sun)	
{	
// chart8
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
                var s = '<b><span style="color:#9932cc;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
                name: 'UV maxima ',
                color: '#9932cc',
				type: 'column',
                data: dUVmax[1]
				},
				{	
                name: 'UV moyens ',
				color: '#9370db',
				type: 'line',            
                data: dUVavg[1]
				}
           ]
        });
	
// chart9
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
                var s = '<b><span style="color:#ffa500;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
                name: 'Radiations maxima ',
                color: '#ffa500',
				type: 'column',
                data: dRadmax[1]},{		
               name: 'Radiations moyennes ',
               color: '#ffd700',
				type: 'line',            
                data: dRadavg[1]}
           ]
        });
	
// chart10
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
                text: 'Energie solaire totale',
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
                var s = '<b><span style="color:#ffa500;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
                name: 'Energie solaire ',
                color: '#ffa500',
				type: 'column',
                data: dRadtot[1]}
           ]
        });
// chart12 ......................Températures moyenne maximmum 
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container12',
                type: 'spline',
                marginRight: 10,
                marginBottom: 30,
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
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 50,			
				floating: true,
                borderWidth: 1
            },
            title: {
                text: 'Températures moyenne maximum',
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
                var s = '<b><span style="color:#ff4f3b;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
				name: 'Moyenne maximum ',
                data: dTmeanmax[1]}
           ]
        });	

// chart13 ......................Températures moyenne minimum
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container13',
                type: 'spline',
                marginRight: 10,
                marginBottom: 30,
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
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 50,			
				floating: true,
                borderWidth: 1
            },
            title: {
                text: 'Températures moyennes minimum',
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
                var s = '<b><span style="color:#ff4f3b;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
				name: 'Moyenne minimum ',
                data: dTmeanmin[1]}
           ]
        });
// chart14 ......................températures Moyennes 
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container14',
                type: 'spline',
                marginRight: 10,
                marginBottom: 30,
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
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 50,			
				floating: true,
                borderWidth: 1
            },
            title: {
                text: 'Températures Moyennes',
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
                var s = '<b><span style="color:#ff4f3b;font-size:small; font-weight:800">'+ this.x+ ' '+date1 +'</span></b>';             
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
				name: 'Température moyenne ',
                data: dTemp[1]}
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
			
			var dirV = Array[[[0]['N']],[[22.5],['NNE']],[[45],['NE']],[[67.5],['ENE']],[[90],['E']],[[112.5],['ESE']],[[135],['SE']],[[157.5],['SSE']],[[180],['S']],[[202.5],['SSO']],[[225],['SO']],[[247.5],['OSO']],[[270],['O']],[[292.5],['ONO']],[[315],['NO']],[[337.5],['NNO']]]


		</script>
