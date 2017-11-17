@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        @if(Session::has('flash_message'))
            <p class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></p>
        @endif
        @if(Session::has('error_message'))
            <p class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></p>
        @endif
        <br>
    </div>
</div>
<div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#client">Client</a></li>
                    <li><a data-toggle="tab" href="#client-payment-channel">Client Payment Channel</a></li>
                    <li><a data-toggle="tab" href="#client-route">Client Channel Route</a></li>
                </ul>

                <br>

                <div class="tab-content">

                    <div id="client" class="tab-pane fade in active">
                        <div class="col-md-9 col-md-offset-1 panel panel-default client">
                            <h5 class="page-header text-center">Client</h5>
                            <form class="form-horizontal" id="addClientForm" action="/client_set_up_wizzard/client" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Client Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="clientName" id="clientName" placeholder="Client Name" class="form-control">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Client Code</label>
                                    <div class="col-sm-9">
                                          <input type="text" name="clientCode" id="clientCode" placeholder="Client Code" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="statusCode" id="statusCode">
                                            <option value="">Choose Status</option>
                                            @foreach($statusCodes as $codes)
                                                <option value="{{$codes->code}}">{{$codes->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" id="createClientBtn" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="client-payment-channel" class="tab-pane fade">
                       <div class="col-md-9 col-md-offset-1 panel panel-default clientChannel">
                            <h5 class="page-header text-center">Client Payment Channels</h5>

                            <form class="form-horizontal" id="addClientChannelForm" action="/client_set_up_wizzard/client_channel" method="post">

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Client Name</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="client" id="client">
                                            <option value="">Choose Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Channel</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="clientChannel" id="clientChannel">
                                            <option value="">Choose Channel</option>
                                            @foreach($channels as $channel)
                                                <option value="{{$channel->channelID}}">{{$channel->channelName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="clientChannelStatusCode" id="clientChannelStatusCode">
                                            <option value="">Choose Status</option>
                                            @foreach($statusCodes as $codes)
                                                <option value="{{$codes->code}}">{{$codes->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Client Channel Name</label>
                                    <div class="col-sm-9">
                                          <input type="text" name="clientChannelName" id="clientChannelName" placeholder="Client Channel Name" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" id="createClientBtn" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                       </div>
                    </div>

                    <div id="client-route" class="tab-pane fade">
                        <div class="col-md-9 col-md-offset-1 panel panel-default clientChannelReference">
                            <h5 class="page-header text-center">Client Channel Route</h5>
                            <form class="form-horizontal" id="addClientChannelReferenceForm" action="/client_set_up_wizzard/client_channel_reference" method="post">

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Source</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="ccrSource" id="ccrSource">
                                            <option value="">Choose Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Destination</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="ccrDestination" id="ccrDestination">
                                            <option value="">Choose Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Client Channel</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="ccrclientChannelID" id="ccrclientChannelID">
                                            <option value="">Choose Client Channel</option>
                                            @foreach($clientChannels as $clientChannel)
                                                <option value="{{$clientChannel->client_channelID}}">{{$clientChannel->client_channel_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Queue Name</label>
                                    <div class="col-sm-9">
                                          <input type="text" name="queue_name" id="queue_name" placeholder="Queue Name" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Channel Code</label>
                                    <div class="col-sm-9">
                                          <select class="form-control" name="ccrchannelCode" id="ccrchannelCode">
                                            <option value="">Choose Channel Code</option>
                                            @foreach($channels as $channel)
                                                <option value="{{$channel->channelCode}}">{{$channel->channelCode}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Endpoint</label>
                                    <div class="col-sm-9">
                                          <input type="text" name="endpoint" id="endpoint" placeholder="Endpoint" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Callback</label>
                                    <div class="col-sm-9">
                                          <input type="text" name="callback" id="callback" placeholder="Callback" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="ccrStatusCode" id="ccrStatusCode">
                                            <option value="">Choose Status</option>
                                            @foreach($statusCodes as $codes)
                                                <option value="{{$codes->code}}">{{$codes->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" id="createClientBtn" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>

@stop