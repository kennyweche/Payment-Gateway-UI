@extends('layouts.master')
@section('content')

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>    
$(document ).ready(function() {
    //================================================================================//
                            // BAR CHART PAYMENTS STATUS LAST ONE WEEK
    //================================================================================//
    var chart = c3.generate({
        bindto: '#paymentsByStatusChart',
        data: {
            columns: [
               <?php 
                    echo '["Successful Payments",'.$getSuccessfulPayments.'],';
                    echo '["Pending Payments",'.$getPendingPayments.'],';
                    echo '["Failed Payments",'.$getFailedPayments.'],';
                ?>
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

    //================================================================================//
                            // DONUT CHART SUM BY CLIENTS
    //================================================================================//
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
        },
        bindto: '#sumByClientsChart'
    });

    //================================================================================//
                    // BAR CHART LAST SEVEN DAYS REVENUE BY CALENDER DATES
    //================================================================================//

    <?php 
        $paymentsValuesArray[] = 'Total Revenue Last Seven Days';
        $paymentDatesArray[] = 'x';
        foreach ($getLastSevenDaysRevenue as $key => $value) {
            $paymentDatesArray[] =  $value->DATE;
            $paymentsValuesArray[] = $value->total;
        }

    ?>

    var xAxisArr = <?php echo json_encode($paymentDatesArray); ?>;
    var dataArr = <?php echo json_encode($paymentsValuesArray, JSON_NUMERIC_CHECK); ?>;

    var chart = c3.generate({
        bindto: '#paymentsSummaryChart',
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

    //================================================================================//
                    // BAR CHART TOTAL TRANSACTIONS BY CALENDER DATES
    //================================================================================//

    <?php 
        $transactionsValuesArray[] = 'Total Transactions Last Seven Days';
        $transactionsDatesArray[] = 'x';
        foreach ($getTransactionsCountPerWeek as $key => $value) {
            $transactionsDatesArray[] =  $value->DATE;
            $transactionsValuesArray[] = $value->count;
        }

    ?>

    var xAxisArr = <?php echo json_encode($transactionsDatesArray); ?>;
    var dataArr = <?php echo json_encode($transactionsValuesArray, JSON_NUMERIC_CHECK); ?>;

    var chart = c3.generate({
        bindto: '#transactionsSummaryChart',
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

    //================================================================================//
                    // BAR CHART TOTAL PAYMENTS FROM CLIENT
    //================================================================================//
    var chart = c3.generate({
        bindto:"#paymentsFromClientChart",
        data: {
            columns: [
                <?php 
                    foreach ($getPaymentsFromClient AS $value) { 
                        echo '["'.$value->source.''.'",'; 
                        echo  $value->amount.'],'; 
                    }
                ?>
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

    //================================================================================//
                    // BAR CHART TOTAL PAYMENTS TO CLIENT
    //================================================================================//
    var chart = c3.generate({
        bindto:"#paymentsToClientChart",
        data: {
            columns: [
                <?php 
                    foreach ($getPaymentsToClient AS $value) { 
                        echo '["'.$value->destination.''.'",'; 
                        echo  $value->amount.'],'; 
                    }
                ?>
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
</script>

@if(Session::has('flash_message'))
    <p class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></p>
@endif
@if(Session::has('error_message'))
    <p class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></p>
@endif

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header text-info">Summary for the last seven days</h2>
            <table class="table  table-responsive text-center" >
                <thead>
                    <tr id="summary-table-header">
                        <td>Current Week Revenue</td>
                        <td>Total Revenue</td>
                        <td>Pending Payments</td>
                        <td>Successful Payments</td>
                        <td>Failed Payments</td>
                    </tr>
                </thead>
                <tbody>
                    <tr id="summary-table">
                        <td>{{ number_format($getCurrentWeekRevenue, 2) }}</td>
                        <td>{{ number_format($getTotalRevenue, 2) }}</td>
                        <td>{{ $getPendingPayments }}</td>
                        <td>{{ $getSuccessfulPayments }}</td>
                        <td>{{ $getFailedPayments}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2 class="text-info text-center">Payments from client</h2>
            <hr>
            <div id="paymentsFromClientChart"></div>
        </div>
        <div class="col-md-6">
            <h2 class="text-info text-center">Payments to client</h2>
            <hr>
            <div id="paymentsToClientChart"></div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header text-info text-center">Transactions Count</h2>
            <div id="transactionsSummaryChart"></div>
        </div>
        <div class="col-md-6">
            <h2 class="page-header text-info text-center">Revenue</h2>
            <div id="paymentsSummaryChart"></div>
        </div>
    </div>    

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-info text-center">Payments status</h2>
            <div id="paymentsByStatusChart"></div>
        </div>
    </div>
     <br><br>
</div>


@stop