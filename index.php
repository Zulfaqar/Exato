<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Real Time API Regulator</title>
          <!-- Boostrap and JQuery-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'spline',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: 'API Reading Pool',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                 global: {
                useUTC: false
            },
            xAxis: {
            type: 'datetime',
            tickInterval: 3600, // one week
               labels: {
                format: '{value: %H:%M}',
                align: 'right'
                //rotation: -30
            } },
           
                yAxis: {
                    title: {
                        text: 'Amount'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: []
            }
            
            $.getJSON("data.php", function(json) {
                options.xAxis.categories = json[0]['data'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                chart = new Highcharts.Chart(options);
            });
        });
        </script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
      <div class="row">  
   
           <p class="text-center"> 
                <h1>Welcome to Exato!
                <small>if you're seeing this, this site is still under constructions</small>
                </h1>
            </p>
    </div>
  
            <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

    
        
        
    </body>
</html>