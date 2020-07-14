/*Dashboard Init*/
 
"use strict"; 

/*****Ready function start*****/
$(document).ready(function(){
	$('#statement').DataTable({
		"bFilter": false,
		"bLengthChange": false,
		"bPaginate": false,
		"bInfo": false,
	});
	if( $('#chart_2').length > 0 ){
		var ctx6 = document.getElementById("chart_2").getContext("2d");
		var data6 = {
			 labels: [
			"organic",
			"Referral",
			"Other"
		],
		datasets: [
			{
				data: [200,50,250],
				backgroundColor: [
					"#ff6028",
					"#ff936d",
					"#ffaf93",
				],
				hoverBackgroundColor: [
					"#ff6028",
					"#ff936d",
					"#ffaf93",
				]
			}]
		};
		
		var pieChart  = new Chart(ctx6,{
			type: 'pie',
			data: data6,
			options: {
				animation: {
					duration:	3000
				},
				responsive: true,
				maintainAspectRatio:false,
				legend: {
					display:false
				},
				tooltip: {
					backgroundColor:'rgba(33,33,33,1)',
					cornerRadius:0,
					footerFontFamily:"'Roboto'"
				},
				elements: {
					arc: {
						borderWidth: 0
					}
				}
			}
		});
	}
	
	
	
	if( $('#ct_chart_3').length > 0 ){
		new Chartist.Pie('#ct_chart_3', {
		  series: [20, 10, 30, 40]
		}, {
		  donut: true,
		  donutWidth: 60,
		  startAngle: 270,
		  total: 200,
		  showLabel: true
		});
	}
	
	if( $('#ct_chart_5').length > 0 ){
		new Chartist.Bar('#ct_chart_5', {
		  labels: ['Qt1', 'Qt2', 'Qt3', 'Qt4'],
		  series: [
			[60, 40, 80, 70],
			[40, 30, 70, 65],
			[80, 30, 10, 60]
		  ]
		}, {
		  seriesBarDistance: 15,
		  axisX: {
			offset: 40
		  },
		  axisY: {
			offset: 30,
			labelInterpolationFnc: function(value) {
			  return value + ' '
			},
			scaleMinSpace: 15
		  }
		});
	}
	
	if( $('#ct_chart_7').length > 0 ){
		new Chartist.Bar('#ct_chart_7', {
		  labels: ['Q1', 'Q2', 'Q3', 'Q4'],
		  series: [
			[800000, 1200000, 1400000, 1300000],
			[200000, 400000, 500000, 300000],
			[100000, 200000, 400000, 600000]
		  ]
		}, {
		  stackBars: true,
		  axisY: {
			labelInterpolationFnc: function(value) {
			  return (value / 1000) + 'k';
			}
		  }
		}).on('draw', function(data) {
		  if(data.type === 'bar') {
			data.element.attr({
			  style: 'stroke-width: 30px'
			});
		  }
		});
	}

});
/*****Ready function end*****/

/*****Load function start*****/
$(window).on("load",function(){
	window.setTimeout(function(){
		$.toast({
			heading: 'Selamat datang di KiosRakyat',
			text: 'Anda dapat melihat fitur selengkapnya dibar kiri.',
			position: 'bottom-right',
			loaderBg:'#e8af48',
			icon: 'warning',
			hideAfter: 3500, 
			stack: 6
		});
	}, 3000);
});
/*****Load function* end*****/

/*****Sparkline function start*****/
var sparklineLogin = function() { 
	if( $('#sparkline_1').length > 0 ){
		$("#sparkline_1").sparkline([2,4,4,6,8,5,6,4,8,6,6], {
			type: 'bar',
			width: '100%',
			height: '180',
			barWidth: '8',
			barSpacing: '15',
			barColor: '#ed8739',
			highlightSpotColor: '#ed8739'
		});
	}	
}
/*****Sparkline function end*****/

/*****Resize function start*****/
var sparkResize,echartResize;
$(window).on("resize", function () {
	/*Sparkline Resize*/
	clearTimeout(sparkResize);
	sparkResize = setTimeout(sparklineLogin, 200);
	
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
sparklineLogin();
/*****Function Call end*****/