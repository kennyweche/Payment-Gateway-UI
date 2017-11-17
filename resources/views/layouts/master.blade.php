<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Payment Gateway</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">

    <link href="//cdnjs.cloudflare.com/ajax/libs/c3/0.1.29/c3.css" rel="stylesheet" type="text/css">

    <link href="https://maxcdn.bootstrapcdn.com/css/ie10-viewport-bug-workaround.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('/datetime_picker/jquery.datetimepicker.css') }} "/>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!--<script src="{{ asset('/js/ie-emulation-modes-warning.js') }}"></script> -->
    <script src="https://d3js.org/d3.v4.min.js"></script>
    
  </head> 
  <body>
    
    <!-- header -->
    <div class="container" id="masterNav">
      <nav id="masterNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" id="navbar-brand" href="#">Payment Gateway v2</a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav pull-left">   
               <li><a href="#"></a></li>
            </ul>
             <ul class="nav navbar-nav pull-right">   
               <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()['username'] }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" type="button" type="button" data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <!-- / header -->
    
    
    <!-- yield content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                
                <ul class="nav nav-pills nav-stacked">
                    <!-- <h5><a href="#">Menu</a></h5> -->
                    <br><br><br>
                    
                    @if( Auth::user()['user_group'] == 1 || Auth::user()['user_group'] == 2 || Auth::user()['user_group'] == 3 || Auth::user()['user_group'] == 4 )
                        <li><a href="/dashboard"><span class="fa fa-tachometer"></span> Dashboard</a></li>
                    @endif
                    <li><a href="/payments"><span class="fa fa-pie-chart"></span> Payments</a></li>
                    
                    @if( Auth::user()['user_group'] == 1 || Auth::user()['user_group'] == 2 || Auth::user()['user_group'] == 3 || Auth::user()['user_group'] == 4 )
                        <li><a href="/reports"><span class="fa fa-area-chart"></span> Reports</a></li>
                    @endif

                    @if( Auth::user()['user_group'] == 1 || Auth::user()['user_group'] == 2 )
                        <li><a href="/client_set_up_wizzard"><span class="fa fa-users"></span> Client Set Up Wizard</a></li>
                        <li><a href="/user_management"><span class="fa fa-users"></span> User Set Up Wizard</a></li>
                        <li><a class="tree-toggler nav-header"><span class="fa fa-credit-card"></span> Clients &nbsp;&nbsp;&nbsp;&nbsp; <span class=" drop-down fa fa-chevron-down"></span></a>
                            <ul class="nav nav-list tree">
                                <li><a href="/clients"> <i class="fa fa-circle-o"></i> Clients</a></li>
                                <li><a href="channels"> <i class="fa fa-circle-o"></i> Channels</a></li>
                                <li><a href="/client_channel"> <i class="fa fa-circle-o"></i> Client Channels</a></li>
                                <li><a href="client_channel_reference"> <i class="fa fa-circle-o"></i> Clients Channel Reference</a></li>
                                <li><a href="/channel_rules"> <i class="fa fa-circle-o"></i> Channel Rules</a></li>
                            </ul>
                        </li>
                        <li><a href="/status_codes"><span class="fa fa-hourglass-start"></span> Status Codes</a></li>
                        <li><a href="/users"><span class="fa fa-users"></span> Users</a></li>
                        <li><a href="/notifications"><span class="fa fa-bell"></span> Notifications</a></li>
                        <li><a href="notifications_templates"><span class="fa fa-comments"></span> Notifications Template</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-10 content">

                <!-- contents goes here -->
                @yield('content')

                <br><br>
                <!-- footer -->
                <footer class="master-footer navbar navbar-default navbar-fixed-bottom">
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-4 col-md-offset-4">
                              <br>
                              <p class="text-center"><b>&copy; 2017 All rights reserved. &nbsp;&nbsp;&nbsp; Payment Gateway v2</b></p>
                          </div>
                        </div>
                    </div>
                </footer>
                  <!-- / footer -->
            </div>
        </div>
    </div>
    
    <!-- / yield content -->
            
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/custom.js') }}"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.js"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/c3/0.1.29/c3.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('/js/ie10-viewport-bug-workaround.js') }}"></script>

    <script src="{{ asset('/datetime_picker/build/jquery.datetimepicker.full.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        /*jslint browser:true*/
        /*global jQuery, document*/
        jQuery(document).ready(function () {
            'use strict';

                jQuery('#paymentFromDate').datetimepicker({
                    format:'Y-m-d H:i:s',
                });

                jQuery('#paymentToDate').datetimepicker({
                    format:'Y-m-d H:i:s',
                    minDate: 0
                });



                // set min date
                $("#fromDate").change(function() {
                    
                    // get min date
                    var minDate = $("#fromDate").val();
                    //alert(minDate);

                    // set min date
                    $('#toDate').datepicker('option', 'minDate', minDate);

                });

                // set min date
                $("#paymentFromDate").change(function() {
                    
                    // get min date
                    var minDate = $("#paymentFromDate").val();
                    //alert(minDate);

                    // set min date
                    $("#paymentToDate").datetimepicker('option', 'minDate', minDate);

                });
                
                // calculate totals
                $("#toTable").each(function(){

                    // instantiate the 'total' variable
                    var sum = 0;

                    // iterate through 'amount' cells in each row:
                    $("td.to-amount").each(function() {

                        var amount = $(this).text();
                        sum += parseFloat(amount.replace(/,/g, ""));

                        //sum += parseFloat($(this).text());
                        //alert(sumTotal);
                    });

                    var toSum = sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                    $("#to-total").append(toSum);
                    $('input.toSum').val(toSum);

                });

                $("#fromTable").each(function(){

                    // instantiate the 'total' variable
                    var sum = 0;

                    // iterate through 'amount' cells in each row:
                    $("td.from-amount").each(function() {

                        var amount = $(this).text();
                        sum += parseFloat(amount.replace(/,/g, ""));

                        //sum += parseFloat($(this).text());
                        //alert(sumTotal);
                    });

                    var fromSum = sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                    $("#from-total").append(fromSum);
                    $("input.fromSum").val(fromSum);

                });

                $("#generatReportBtn").click(function() {
                    $("#reportForm").hide();
                });
        });

        $( function() {
            $( "#fromDate" ).datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $( "#toDate" ).datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0
            });
        });



    </script>

    <div id="changePasswordModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Change Password</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="changePasswordForm" method="post" action="{{ url('/user_management/change_password') }}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="currentPassword" id="currentPassword" class="form-control">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="newPassword" id="newPassword" class="form-control">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" id="changePasswordBtn" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>  
                </div>
                </form>
            </div>

        </div>
    </div>
  
</body>

    
</html>