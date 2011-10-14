<?php
include_once('base.php');
include_once('utils.php');
if(isset($_POST['id']) && ($_POST['id']!= '')) {
	$graph = $_POST['id'];
	$url = $_POST['url'];
}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
<script src="Highstock/js/highstock.js" type="text/javascript"></script>
<script type='text/javascript'>
function chart (data, data2, data3) {
	
    chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column'
         },
         
        title: {
            text: 'Clicks per link'
         },
         
        rangeSelector: {
         		enabled: true,
         		inputEnabled: false
		    },
		    
		scrollbar: {
			enabled: true
		},
        
        xAxis: {
		        type: 'datetime'
		    },

        yAxis: {
        	align: 'low',
            title: {
               text: 'Clicks'
            }
         },
         
        series: [{
        	type: 'column',
            data: data            

         }]
    });
    
chart2 = new Highcharts.Chart({
      chart: {
         renderTo: 'container2',
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         height:400,
         width:600
      },
      title: {
         text: 'Clicks per country'
      },
      tooltip: {
         formatter: function() {
            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
         }
      },
      plotOptions: {
         pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
               enabled: true,
               formatter: function() {
                  return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
               }
            }
         }
      },
       series: [{
         type: 'pie',
         name: 'country',
         data: data2
      }]
   });

chart3 = new Highcharts.Chart({
      chart: {
         renderTo: 'container3',
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         height:400,
         width:600
      },
      title: {
         text: 'Clicks per user to this URL'
      },
      tooltip: {
         formatter: function() {
            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
         }
      },
      plotOptions: {
         pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
               enabled: true,
               formatter: function() {
                  return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
               }
            }
         }
      },
      
       series: [{
         type: 'pie',
         name: 'users',
         data: data3
      }]
   });

}
</script>   

<?php
if($graph != '') {
	echo "<body onload='chart(Array(".implode(',',clicks_graph($graph))."), Array(".implode(',',countries_graph($graph))."), Array(".implode(',',users_graph($url))."))'>";
	echo '<div id="container" width="500" height="500"> </div><br>';
	echo '<div id="container2" width="500" height="300"></div>';
	echo '<div id="container3" width="500" height="300" align=right></div>';
} else {
	echo '<div>there was an error with your link.</div>';
}
?>
<form action='historial.php'>
	<input type='submit' value='regresar'>
</form>



