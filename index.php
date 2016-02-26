<!DOCTYPE HTML>
<?php date_default_timezone_set("Asia/Kuala_Lumpur");?>
<!--<div style="display:none;">-->
    <?php include 'data.php';
    include 'data_prep.php';
     ?>
<!--</div>-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Real Time API</title>
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
        exporting: {
            enabled: false
        },
        chart: {
            type: 'area',
             backgroundColor:null
        },
        title: {
            text: 'Air Quality Index Pool',
             style: {
                color: '#ecf0f1',
                fontWeight: 'bold'
            },
            
        },
        subtitle: {
            text: 'Powered by Arduino Uno R3',
            style: {
                color: '#bdc3c7',
            }
        },
         xAxis: {
             labels:{enabled: false},
             title:{
                 text: 'Time',
                 style: {
                color: '#bdc3c7',
                fontWeight: 'bold'
            },
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
                text: 'Index',
                style: {
                    color: '#bdc3c7',  
                },
            },
            labels: {
                format: '{value:.2f} µg/m³',
                 style: {
                    color: '#ecf0f1',  
                },
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
    <!--<body class="container-fluid bg-background">-->
    <body class="container-new bg-background">
 
   <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header"> 
          <a class="navbar-brand" href="#"><span class="fui-yelp"></span> Air Pollution | Real-time API Monitor </a>
        </div>
      </div>
    </nav>

            

            
            <div class="alert alert-warning text-center container" role="alert">
                <span class="fui-alert-circle" aria-hidden="true"></span><b> Warning!</b> if you're seeing this, this site is still under constructions.
            </div>
        
            <div class="row container-fluid">
                <div class=" col-sm-3 text-center">
            <div class="todo">
            <ul>
              <li>
                <div class="todo-icon fui-user"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                     Current API 
                      
                  </h4>
                    <?php echo $result['date']; ?>
                </div>
              </li>
            </ul>
            </div>
                    
                    <?php if($result['data']>=301){ ?>
                    <div class="btn btn-block btn-lg btn-danger">
                       <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Hazardous</div>
                        </h6>
                    </div>
                    <?php } else if(($result['data']<300)&&($result['data']>201)){ ?>
                    <div class="btn btn-block btn-lg btn-veryunhealthy">
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Very Unhealthy</div>
                        </h6>
                    </div>
                    <?php } 
                    else if(($result['data']<200)&&($result['data']>101)){?>
                    <div class="btn btn-block btn-lg btn-unhealthy">
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Unhealthy</div>
                        </h6>
                    </div>
                    <?php } 
                    else if(($result['data']<100)&&($result['data']>51)){?>
                    <div class="btn btn-block btn-lg btn-warning">
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Moderate</div>
                        </h6>
                    </div>
                    <?php } 
                    else if(($result['data']<50)&&($result['data']>0)){?>
                    <div class="btn btn-block btn-lg btn-success">
                        
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Good</div>
                        </h6>
                        
                    </div>
                    <?php }?>
                </div>
                
                <div class=" col-sm-3 text-left">
            <div class="todo">
            <ul>
              <li>
                <div class="todo-icon fui-user"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                      Highest API 
                      <div><strong>35.32 µg/m³</strong></div> 
                  </h4>
                   Thursday, Feb 25, 02:27PM
                </div>
              </li>
              <li>
                <div class="todo-icon fui-list"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                      7 Days Avg API 
                      <div><strong>35.32 µg/m³</strong></div> 
                  </h4>
                   (27/11/2015 - 04/12/15)
                </div>
              </li>
              <li>
                <div class="todo-icon fui-eye"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                     30 Days Avg API 
                      <div><strong>35.32 µg/m³</strong></div> 
                  </h4>
                   (01/11/2015 - 01/12/15)
                </div>
              </li>
              <li>
                <div class="todo-icon fui-time"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                     Overview 
                      <div><strong>0.16%</strong></div> 
                  </h4>
                   Slightly cleaner air from previous week
                </div>
              </li>
            </ul>
          </div><!-- /.todo -->
                    
                </div>
                <div class="col-sm-6">
                    <div id="container" style="min-width: 400px; height: 250px; margin: 0 auto"></div>
                </div>
                
            </div>
              
  
        

        
      
    </body>
</html>

