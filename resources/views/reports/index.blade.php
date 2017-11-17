@extends('layouts.master')
@section('content')


<div class="container-fluid">
    <div class="row" id="reportForm">
        <div class="col-md-12">
            <form class="form-horizontal" id="reportsSearchForm" action="/reports/search" method="post">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Payments From</label>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="download" id="download" value="download">
                            <select class="form-control" name="fromclientID" id="fromclientID">
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

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Payments To</label>
                            <select class="form-control" name="toclientID" id="toclientID">
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

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="text"  name="fromDate" id="fromDate" class="form-control" placeholder="From Date">
                        </div>
                    </div>


                    <div class="col-md-1"></div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="text"  name="toDate" id="toDate" class="form-control" placeholder="To Date">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <div class="form-group">
                            <input type="submit"  name="reportsSearchBtn" id="reportsSearchBtn" class="btn btn-success btn-block" value="Search">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<br>

<div class="container-fluid">

    @if(Session::has('flash_message'))
        <div class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em><div>
    @endif
    @if(Session::has('error_message'))
        <div class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></div>
    @endif
    <br>

    @if($status)
    <table class="table table-bordered" style="border: 1px solid black;">
        <tr>
            <td>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Display client data -->
                        <div class="pull-right company-info text-danger text-center">
                            @if(!empty($clientName))
                                <h2>{{ $clientName->first()->clientName }}'s Report</h2>
                            @endif

                            @if(!empty($fromDate))
                                <p>From Date: <span class="text-info">{{ date('d, F, Y', strtotime($fromDate)) }}</span></p>
                                <p>To Date  : <span class="text-info">{{ date('d, F, Y', strtotime($toDate)) }}</span></p>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row reports-section" id="report-section">
                    <div class="col-md-12">
                        @if(!empty($allTransactionsToClientCount))
                        <h2 class="page-header text-success">Payments Done To 
                        @if(!empty($clientName))
                             {{ $clientName->first()->clientName }}
                        @endif
                        </h2>
                        <table id="toTable" class="table table-bordered table-bordered">
                            <tr>
                                <thead>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Transactions</th>
                                    <th>Amount(KES)</th>
                                </thead>
                                <tbody>
                                    @if(!empty($allTransactionsToClientCount))
                                        @foreach($allTransactionsToClientCount as $transactionsToClient)
                                            <tr>
                                                <td>{{ $transactionsToClient->source }}</td>
                                                <td>{{ $transactionsToClient->destination }}</td>
                                                <td>{{ $transactionsToClient->count }}</td>
                                                <td class="to-amount">{{ number_format($transactionsToClient->total,2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr align="right">
                                            <td colspan="3">Total</td>
                                            <td class="alert alert-success" id="to-total">KSh. </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </tr>
                        </table>
                        <hr>


                        @if(!empty($allTransactionsFromClientCount))
                        <h2 class="page-header text-danger">Payments Done From 
                        @if(!empty($clientName))
                             {{ $clientName->first()->clientName }}
                        @endif
                        </h2>
                        <table id="fromTable" class="table table-bordered table-bordered">
                            <tr>
                                <thead>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Transactions</th>
                                    <th>Amount(KES)</th>
                                </thead>
                                <tbody>
                                        @foreach($allTransactionsFromClientCount as $transactionsFromClient)
                                            <tr>
                                                <td>{{ $transactionsFromClient->source }}</td>
                                                <td>{{ $transactionsFromClient->destination }}</td>
                                                <td>{{ $transactionsFromClient->count }}</td>
                                                <td class="from-amount">{{ number_format($transactionsFromClient->total,2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr align="right">
                                            <td colspan="3">Total</td>
                                            <td class="alert alert-success" id="from-total">KSh. </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </tr>
                        </table>
                        <hr>
                    @endif
                    @if(!empty($allTransactionsBetweenClientsCount))
                        <h2 class="page-header text-success">Transactions</h2>
                        <table id="fromTable" class="table table-bordered table-bordered">
                            <tr>
                                <thead>
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Transactions</th>
                                    <th>Amount(KES)</th>
                                </thead>
                                <tbody>
                                    @if(!empty($allTransactionsBetweenClientsCount))
                                        @foreach($allTransactionsBetweenClientsCount as $transactionsBetweenClient)
                                            <tr>
                                                <td>{{ $transactionsBetweenClient->source }}</td>
                                                <td>{{ $transactionsBetweenClient->destination }}</td>
                                                <td>{{ $transactionsBetweenClient->count }}</td>
                                                <td class="from-amount">{{ number_format($transactionsBetweenClient->total,2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr align="right">
                                            <td colspan="3">Total</td>
                                            <td class="alert alert-success" id="from-total">KSh. </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </tr>
                        </table>
                        <hr>
                    @endif
                    </div>
                </div>

            </td>
        </tr>
    </table>
    <hr>
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="/reports/generate-report" method="POST">
                    <input type="hidden" name="fromDate" value="{{ $fromDate }}">
                    <input type="hidden" name="toDate" value="{{ $toDate }}">
                    <input type="hidden" name="clientName" value="{{ $clientName->first()->clientName }}">
                    <input type="hidden" name="fromclientID" value="{{ $fromclientID }}">
                    <input type="hidden" name="toclientID" value="{{ $toclientID }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="fromSum" class="fromSum" value="">
                    <input type="hidden" name="toSum" class="toSum" value="">
                    <button class="generate-report-btn btn btn-info" type="submit">Download Report</button>
                </form>
            </div>
        </div>
    @endif
    <hr>
</div>


@stop