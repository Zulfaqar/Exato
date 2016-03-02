<!DOCTYPE HTML>
<?php date_default_timezone_set("Asia/Kuala_Lumpur");
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
<!--<div style="display:none;">-->
    <?php include 'data.php';
    include 'data_prep.php';
    include 'max_value.php';
    include 'avg_7days.php';
    include 'avg_30days.php';
     ?>
<!--</div>-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <link rel="icon" href="img/icons/png/gieERMx7T.png">
   
        
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
                 text: 'Time <br> (7days)',
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
            <h3>Air Pollution | Real-time API Monitor</h3>
      </div>
    </nav>  
            <div class="alert alert-success text-center container" role="alert">
                <span class="fui-alert-circle" aria-hidden="true"></span><b> Great News!</b> This site is already a beta!
                <div>Fork it here via <a href="https://github.com/Zulfaqar/exato/tree/dev" <span class="fui-github"></span> </a>
                    | Developer's <a href='https://my.linkedin.com/in/zulfaqarofficia' <span class="fui-linkedin"></span></a></div>
            </div>
        
            <div class="row container-fluid">
                
                
                <div class=" col-sm-3 text-center">
            <div class="todo">
            <ul>
              <li>
                 <div class="todo-icon fui-time"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                     Current API 
                      
                  </h4>
                    <?php echo $result['date']; ?>
                </div>
              </li>
            </ul>
            </div>
                    
                    <?php if($result['data']>=301.00){ ?>
                    <div class="btn btn-block btn-lg btn-danger">
                       <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Hazardous</div>
                        </h6>
                    </div>
                    <?php } else if(($result['data']<300.00)&&($result['data']>=201.00)){ ?>
                    <div class="btn btn-block btn-lg btn-veryunhealthy">
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Very Unhealthy</div>
                        </h6>
                    </div>
                    <?php } 
                    else if(($result['data']<=200.00)&&($result['data']>=101.00)){?>
                    <div class="btn btn-block btn-lg btn-unhealthy">
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Unhealthy</div>
                        </h6>
                    </div>
                    <?php } 
                    else if(($result['data']<=100.00)&&($result['data']>=51.00)){?>
                    <div class="btn btn-block btn-lg btn-warning">
                        <h6><b><?php echo $result['data'];?> µg/m³</b> 
                            <div>Moderate</div>
                        </h6>
                    </div>
                    <?php } 
                    else if(($result['data']<=50.00)&&($result['data']>=0.00)){?>
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
                <div class="todo-icon fui-clip"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                      Highest API 
                      <div><strong><?php echo $max['max']; ?> µg/m³</strong></div> 
                  </h4>
                   <?php echo $max['date']; ?>
                </div>
              </li>
              <li>
                <div class="todo-icon fui-list-thumbnailed"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                      7 Days Avg API 
                      <div><strong><?php echo $avg_7days['average_value']; ?> µg/m³</strong></div> 
                  </h4>
                   (<?php echo $avg_7days['from']; ?> - <?php echo $avg_7days['till']; ?>)
                </div>
              </li>
              <li>
                <div class="todo-icon fui-list-large-thumbnails"></div>
                <div class="todo-content">
                  <h4 class="todo-name">
                     30 Days Avg API 
                      <div><strong><?php echo $avg_30days['average_value']; ?> µg/m³</strong></div> 
                  </h4>
                   (<?php echo $avg_30days['from']; ?> - <?php echo $avg_30days['till']; ?>)
                </div>
              </li>
            </ul>
          </div>
                
            
            </div>
                
                
                
                <div class="col-sm-6">
                    <div id="container" style="min-width: auto; height: auto;"></div>
                </div>
                
            </div>
              
  
        

        
      
    </body>
</html>

