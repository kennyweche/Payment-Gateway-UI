@extends('layouts.master')
@section('content')

@if(Session::has('flash_message'))
    <p class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></p>
@endif
@if(Session::has('error_message'))
    <p class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></p>
@endif
<br>
<div class="container-fluid">
    <div class="row" id="paymentsForm">
        <div class="col-md-12">
            <form class="form-horizontal" id="paymentSearchForm" action="{{ url('/payments/search') }}" method="post">
                <div class="row">

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label>From Client</label>
                             <select class="form-control" name="paymentFromClientID" id="paymentFromClientID">
                                <option value="">Choose Client</option>

                                @if(Auth::user()->clientID == 1)
                                    @foreach($clients as $client)
                                        <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                    @endforeach
                                @else
                                    @foreach($clients as $client)
                                        <option value="{{$client->sourceClientID}}">{{$client->source}}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>

                     <div class="col-md-1"></div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label>To Client</label>
                             <select class="form-control" name="paymentToClientID" id="paymentToClientID">
                                <option value="">Choose Client</option>

                                @if(Auth::user()->clientID == 1)
                                    @foreach($clients as $client)
                                        <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                    @endforeach
                                @else
                                    @foreach($clients as $client)
                                        <option value="{{$client->destinationClientID}}">{{$client->destination}}</option>
                                    @endforeach
                                @endif
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label>Ref No</label>
                            <input type="text" name="refNo" id="refNo" class="form-control">
                        </div>
                    </div>


                    <div class="col-md-1"></div>

                   <div class="col-sm-1">
                        <div class="form-group">
                            <label>Src Account</label>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="sourceAccount" id="sourceAccount" class="form-control">
                        </div>
                    </div>


                    <div class="col-md-1"></div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="text"  name="paymentFromDate" id="paymentFromDate" class="form-control" placeholder="To Date">
                        </div>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-sm-1">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="text"  name="paymentToDate" id="paymentToDate" class="form-control" placeholder="To Date">
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <div class="form-group">
                            <input type="submit"  name="paymentsSearchBtn" id="paymentsSearchBtn" class="btn btn-success btn-block" value="Search">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped payments-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Reference No.</th>
            <th>Amount(KES)</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Transaction Type</th>
            <th>Source Account</th>
            <th>Destination Account</th>
            <th>Status</th>
            <th>Time</th>
           <!--  <th colspan="2">Action</th> -->
        </tr>
    </thead>
    <tbody>
@if(!empty($payments))
        @foreach($payments as $payment)
            <tr>
                <td class="requestlogID">{{ $payment->requestlogID }}</td>
                <td class="external_ref_id">{{ $payment->external_ref_id }}</td>
                <td class="amount">{{ number_format($payment->amount, 2) }}</td>
                <td class="source">{{ $payment->source }}</td>
                <td class="destination">{{ $payment->clientName }}</td>
                <td class="transactionType">{{ $payment->code }}</td>
                <td class="source_account">{{ $payment->source_account }}</td>
                <td class="destination_account">{{ $payment->destination_account }}</td>

                <?php 
                    if($payment->overalStatus == 121) {
                        $class = "status alert alert-warning";
                    } elseif($payment->overalStatus == 123) {
                        $class = "status alert alert-success";
                    } else {
                        $class = "status alert alert-danger";
                    }
                
                ?>

                <td class="<?php echo $class; ?>">{{ $payment->description }}</td>
                
                <td class="date_created">{{ $payment->payment_date }}</td>

                 <!-- <td><a href="#" type="button" class="btn btn-info payments-action" type="button" data-toggle="modal" data-target="#paymentsActionModal">Action</a></td> -->
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
@endif

@stop