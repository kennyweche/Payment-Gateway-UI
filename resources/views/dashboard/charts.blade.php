//================================================================================//
                    // BAR CHART TOTAL PAYMENTS BY CALENDER DATES
//================================================================================//
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        
            <?php 
                $valuesArray[] = 'Total Payments';
                $datesArray[] = 'x';
                foreach ($getGraphData as $key => $value) {
                    $datesArray[] =  $value->DATE;
                    $valuesArray[] = $value->total;
                }

            ?>

            var xAxisArr = <?php echo json_encode($datesArray); ?>;
            var dataArr = <?php echo json_encode($valuesArray, JSON_NUMERIC_CHECK); ?>;

            var chart = c3.generate({
                bindto: '#x',
                data: {
                    x: 'x',
                    columns: [
                        xAxisArr,
                        dataArr
                    ]
                },
                axis: {
                    x: {
                        type: 'timeseries',
                        tick: {
                            format: '%Y-%m-%d'
                        }
                    }
                }
            });
        
    });
</script>

//================================================================================//
                            // DONUT CHART SUM BY CLIENTS
//================================================================================//
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>    
$(document ).ready(function() {
    var chart = c3.generate({
        data: {
            columns: [
                //
                <?php 
                    foreach ($getSumByClients AS $value) { 
                        echo '["'.$value->source.''.'",'; 
                        echo ($value->amount)*100/$getTotalRevenue.'],'; 
                    }
                ?>
            ],
            type : 'donut'
        },
        donut: {
            title: "Payments:",
        }
    });
});
</script>


//================================================================================//
                            // DONUT CHART PAYMENTS STATUS
//================================================================================//
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>    
$(document ).ready(function() {
    var chart = c3.generate({
        data: {
            columns: [
                //
                <?php 
                    echo '["Successful Payments",'.$getSuccessfulPayments.'],';
                    echo '["Pending Payments",'.$getPendingPayments.'],';
                    echo '["Failed Payments",'.$getFailedPayments.'],';
                ?>
            ],
            type : 'donut'
        },
        donut: {
            title: "Payments:",
        }
    });
});
</script>

//================================================================================//
                            // BAR CHART PAYMENTS STATUS LAST ONE WEEK
//================================================================================//
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>    
$(document ).ready(function() {
    var chart = c3.generate({
        data: {
            columns: [
                ['data1', 30, 200, 100, 400, 150, 250],
                ['data2', 130, 100, 140, 200, 150, 50]
            ],
            type: 'bar'
        },
        bar: {
            width: {
                ratio: 0.5 // this makes bar width 50% of length between ticks
            }
            // or
            //width: 100 // this makes bar width 100px
        }
    });
});