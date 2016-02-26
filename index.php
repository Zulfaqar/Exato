<!DOCTYPE HTML>
<?php date_default_timezone_set("Asia/Kuala_Lumpur");?>
<!--<div style="display:none;">-->
    <?php include 'data.php';
    include 'data_prep.php';
     ?>
<!--</div>-->
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Real Time API Regulator</title>
          <!-- Boostrap and JQuery-->
            <link href="css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="css/flat-ui.min.css" rel="stylesheet" type="text/css"/>
       
          <script src="js/flat-ui.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#container').highcharts({
                 legend: {
            enabled: false
        },
        chart: {
            type: 'area'
        },
        title: {
            text: 'Air Quality Index Pool'
        },
        subtitle: {
            text: 'Powered by Arduino Uno R3'
        },
         xAxis: {
             labels:{enabled: false},
             title:{
                 text: 'Time'
             },
             
                categories: [ <?php foreach ($chart['api_date'] as $value) {
                                        echo "'".$value."',";
                                    } ?>],
                crosshair:false,
                type: 'datetime',
                tickInterval: 1,
                },
        yAxis: {
            title: {
                text: 'Index'
            },
            labels: {
                format: '{value:.2f} µg/m³'
            },
           
            
        },
        tooltip: {
            pointFormat: '{series.name} Index <b>{point.y:,.2f} µg/m³</b>',
        },
        plotOptions: {
            area: {
               
                marker: {
                    fillColor: '#34495e',
                    enabled: false,
                    symbol: 'circle',
                    radius: 4,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            color:'#c0392b',
            name: 'API',
            data: [
                <?php 
                    foreach ($chart['api'] as $value) {
                        echo $value.",";
                    }
                ?>],
            zones: [{
                    value: 50.00,
                    color: '#2ecc71'
                 }, {
                    value: 100.00,
                    color: '#f1c40f'
                 }, {
                    value: 200.00,
                    color: '#e67e22'
                 },{
                    value: 300.00,
                    color: '#c0392b'
                 }]
        }]
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
                        <h7><?php echo $result['date']; ?>
                            <b>Current API<b></h7>
                    </div>
                    <?php if($result['data']>301){ ?>
                    <div class="alert alert-danger">
                        <h4><b>
                            <?php echo $result['data'];?>
                            </b> µg/m³</h4>
                        <div><b>Hazardous</b></div>
                    </div>
                    <?php } else if(($result['data']<300)&&($result['data']>201)){ ?>
                    <div class="alert alert-danger">
                        <h4><b><?php echo $result['data'];?> </b>µg/m³</h4>
                         <div><b>Very Unhealthy</b></div>
                    </div>
                    <?php } 
                    else if(($result['data']<200)&&($result['data']>101)){?>
                    <div class="alert alert-warning">
                        <h4><b><?php echo $result['data'];?> </b>µg/m³</h4>
                         <div><b>Unhealthy</b></div>
                    </div>
                    <?php } 
                    else if(($result['data']<100)&&($result['data']>51)){?>
                    <div class="alert alert-warning">
                        <h4><b>><?php echo $result['data'];?> </b>µg/m³</h4>
                         <div><b>Moderate</b></div>
                    </div>
                    <?php } 
                    else if(($result['data']<50)&&($result['data']>0)){?>
                    <div class="alert alert-success">
                        <h4><b><?php echo $result['data'];?> </b>µg/m³</h4>
                         <div><b>Good</b></div>
                    </div>
                    <?php }?>
                </div>
                <div class="col-sm-3 text-left">
                     <div><h6><b>Highest API</b>
                        <div>535.32 µg/m³</div>
                        <div><small>Thursday, Feb 25, 02:27PM </small></div></h6>
                    </div>
                    <div><h6><b>7 Days Avg API</b>
                        <div>235.32 µg/m³</div>
                        <div><small>(27/11/2015 - 04/12/15)</small></div></h6>
                    </div>
                    <div><h6><b>30 Days Avg API</b>
                        <div>40.17 µg/m³</div>
                        <div><small>(01/11/2015 - 01/12/15)</small></div></h6>
                    </div>
                   <div><h6><b>Overview</b>
                        <div>0.16% <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></div>
                        <div><small>Slightly cleaner air from previous week</small></div></h6>
                    </div>
                    
                    
                </div>
                <div class="col-sm-6">
                    <div id="container" style="min-width: 400px; height: 250px; margin: 0 auto"></div>
                </div>
                
            </div>
  
            

    
        
</div>
    </body>
</html>