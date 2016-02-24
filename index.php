<!DOCTYPE HTML>
<?php date_default_timezone_set("Asia/Kuala_Lumpur");?>
<div style="display:none;"><?php include 'data_prep.php'; ?></div>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
        <div class="container">
 
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">
                Real-Time API Regulator
            </h1>
                <div class="alert alert-danger text-center" role="alert">
                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span><b> Warning!</b> if you're seeing this, this site is still under constructions.
                </div>
            
        </div>
    </div>
            <div class="row">
                <div class="col-sm-3 text-center">
                    <div>
                    <?php echo date("F j, Y, g:i A"); 
                   
echo $result['data'];?> 
                    </div>
                    <div>
                    <h4>Current API</h4>
                    </div>
                    <div class="alert alert-danger">
                        <h4><b>524.10 </b>µg/m³</h4>
                        <div><b>Hazardous</b></div>
                    </div>
                    <div class="alert alert-danger">
                        <h4><b>524.10 </b>µg/m³</h4>
                         <div><b>Very Unhealthy</b></div>
                    </div>
                    <div class="alert alert-warning">
                        <h4><b>186.32 </b>µg/m³</h4>
                         <div><b>Unhealthy</b></div>
                    </div>
                    <div class="alert alert-warning">
                        <h4><b>94.40 </b>µg/m³</h4>
                         <div><b>Moderate</b></div>
                    </div>
                    <div class="alert alert-success">
                        <h4><b>40.10 </b>µg/m³</h4>
                         <div><b>Good</b></div>
                    </div>
                </div>
                <div class="col-sm-3 text-left">
                     <div><h4><small><b>Highest API</b></small>
                        <div>535.32 µg/m³</div>
                        <div><small>Thursday, Feb 25, 02:27PM </small></div></h4>
                    </div>
                    <div><h4><small><b>7 Days Avg API</b> </small>
                        <div>235.32 µg/m³</div>
                        <div><small>(27/11/2015 - 04/12/15)</small></div></h4>
                    </div>
                    <div><h4><small><b>30 Days Avg API</b> </small>
                        <div>40.17 µg/m³</div>
                        <div><small>(01/11/2015 - 01/12/15)</small></div></h4>
                    </div>
                   <div><h4><small><b>Overview</b> </small>
                        <div>0.16% <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></div>
                        <div><small>Slightly cleaner air from previous week</small></div></h4>
                    </div>
                    
                    
                </div>
                <div class="col-sm-6">
                    <div id="container" style="min-width: 400px; height: 250px; margin: 0 auto"></div>
                </div>
                
            </div>
  
            

    
        
</div>
    </body>
</html>