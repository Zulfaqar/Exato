<!--this file displays the data from the energy_project database.
The original tutorial used for this code is from:
http://blueflame-software.com/blog/how-to-load-mysql-results-to-highcharts-using-json/
by Tim Kang-->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Exato</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'line',
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
        <h1> Welcome to Exato! </h1>
        <p> if you're seeing this, this site is still under constructions
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </body>
</html>