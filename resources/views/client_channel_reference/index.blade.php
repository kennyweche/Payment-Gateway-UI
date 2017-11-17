@extends('layouts.master')
@section('content')

@if(Session::has('flash_message'))
    <p class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></p>
@endif
@if(Session::has('error_message'))
    <p class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></p>
@endif
<br>
<div class="row">
    <div class="col-md-6 pull-left">
        <!-- Trigger the add client channel reference modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addClientChannelReferenceModal">Add New Client Channel Reference</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/client_channel_reference/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="clientChannelReferenceSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="searchClientChannelReferenceBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered  table-stripped client-channel-reference-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Channel Name</th>
            <th>Ref Code</th>
            <th>Client Name</th>
            <th>Queue Name</th>
            <th>Channel Status</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientChannelReferences as $clientChannelReference)
            <tr>
                <td class="channel_ref_id">{{ $clientChannelReference->channel_ref_id }}</td>

                <td>{{ $clientChannelReference->client_channel_name }}</td>
                <input type="hidden" class="ccrclient_ChannelID" name="ccrclient_ChannelID" value="{{ $clientChannelReference->client_channelID }}">

                <td class="ccrchannelCode">{{ $clientChannelReference->code }}</td>

                <td>{{ $clientChannelReference->clientName }}</td>
                <input type="hidden" class="ccrclientID" name="ccrclientID" value="{{ $clientChannelReference->clientID }}">

                <td class="hidden">{{ $clientChannelReference->clientName }}</td>
                <input type="hidden" class="ccrdestinationClientID" name="ccrdestinationClientID" value="{{ $clientChannelReference->destinationClientID }}">
  

                <td class="queue_name">{{ $clientChannelReference->queue_name }}</td>

                <td class="endpoint hidden">{{ $clientChannelReference->end_point }}</td>

                <td class="callback hidden">{{ $clientChannelReference->callback }}</td>

                <td class="ccrsenderid hidden">{{ $clientChannelReference->senderid }}</td>

                <td class="notifyCustomer hidden">{{ $clientChannelReference->notifyCustomer }}</td>

                 <td>{{ $clientChannelReference->description }}</td>
                <input type="hidden" class="ccrstatusCode" name="ccrstatusCode" value="{{ $clientChannelReference->status }}">

                <td class="ccrdate_created hidden">{{ $clientChannelReference->date_created }}</td>
                <td class="ccrdate_modified hidden">{{ $clientChannelReference->date_modified }}</td>

                <td><a href="#" type="button" class="btn btn-info edit-client-channel-reference" type="button" data-toggle="modal" data-target="#editClientChannelReferenceModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-client-channel-reference" type="button" data-toggle="modal" data-target="#deactivateClientChannelReferenceModal">Deactivate</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->



<!-- Add client channel reference modal -->
<div id="addClientChannelReferenceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Client Channel Reference</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addClientChannelReferenceForm" action="/client_channel_reference" method="post">

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

            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="saveBtn" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>


<!-- Edit client channel reference modal -->
<div id="editClientChannelReferenceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Client Channel Reference</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editClientChannelReferenceForm" action="/client_channel_reference" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Source</label>
                          <div class="col-sm-9">

                              <input type="hidden" name="echannel_ref_id" id="echannel_ref_id" class="form-control">
                              <select class="form-control" name="eccrSource" id="eccrSource">
                                  <option value="">Choose Client</option>
                                  @foreach($clients as $client)
                                      <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                  @endforeach
                              </select>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Destination</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="eccrDestination" id="eccrDestination">
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
                              <select class="form-control" name="eccrclientChannelID" id="eccrclientChannelID">
                                  <option value="">Choose Client Channel</option>
                                  @foreach($clientChannels as $clientChannel)
                                      <option value="{{$clientChannel->client_channelID}}">{{$clientChannel->client_channel_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Code</label>
                          <div class="col-sm-9">
                                <select class="form-control" name="eccrchannelCode" id="eccrchannelCode">
                                  <option value="">Choose Channel Code</option>
                                  @foreach($channels as $channel)
                                      <option value="{{$channel->channelCode}}">{{$channel->channelCode}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Queue Name</label>
                          <div class="col-sm-9">
                                <input type="text" name="equeue_name" id="equeue_name" placeholder="Endpoint" class="form-control">
                          </div>
                      </div>


                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Endpoint</label>
                          <div class="col-sm-9">
                                <input type="text" name="eendpoint" id="eendpoint" placeholder="Endpoint" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Callback</label>
                          <div class="col-sm-9">
                                <input type="text" name="ecallback" id="ecallback" placeholder="Callback" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="eccrStatusCode" id="eccrStatusCode">
                                  <option value="">Choose Status</option>
                                  @foreach($statusCodes as $codes)
                                      <option value="{{$codes->code}}">{{$codes->description}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Created On</label>
                          <div class="col-sm-9">
                                <input type="text" name="eccrdate_created" id="eccrdate_created" placeholder="Date Created" class="form-control" readonly>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Last Modified On</label>
                          <div class="col-sm-9">
                                <input type="text" name="eccrdate_modified" id="eccrdate_modified" placeholder="Date Modified" class="form-control" readonly>
                          </div>
                      </div>

            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="saveBtn" class="btn btn-success">Submit Changes</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>



<!-- deactivate client channel reference modal -->
<div id="deactivateClientChannelReferenceModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate Client Channel Reference</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateClientChannelReferenceForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this client channel reference?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client Channel Reference ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rchannel_ref_id" id="rchannel_ref_id" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateClientChannelReference" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop