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
        <!-- Trigger the add client channel modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addClientChannelModal">Add New Client Channel</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/client_channel/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="clientChannelSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="searchClientChannelBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered  table-stripped client-channels-table">
    <thead>
        <tr>
            <th>Client Channel ID</th>
            <th>Client</th>
            <th>Channel</th>
            <th>Client Channel Name</th>
            <th>Status</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientChannels as $clientChannel)
            <tr>
                <td class="eclient_channelID">{{ $clientChannel->client_channelID }}</td>
                <td>{{ $clientChannel->clientName }}</td>
                <input type="hidden" class="clientID" name="clientID" value="{{ $clientChannel->clientID }}">
                <td>{{ $clientChannel->channelName }}</td>
                <input type="hidden" class="clientChannelChannelID" name="clientChannelChannelID" value="{{ $clientChannel->channelID }}">
                <td class="clientChannelName">{{ $clientChannel->client_channel_name }}</td>
                <td>{{ $clientChannel->description }}</td>
                <input type="hidden" class="clientChannelStatusCode" name="clientChannelStatusCode" value="{{ $clientChannel->status }}">
                <td class="clientChanneldate_created">{{ $clientChannel->date_created }}</td>
                <td class="clientChanneldate_modified">{{ $clientChannel->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-client-channel" type="button" data-toggle="modal" data-target="#editClientChannelModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-client-channel" type="button" data-toggle="modal" data-target="#deactivateClientChannelModal">Deactivate</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $clientChannels->links() }}

<!-- Add client channel modal -->
<div id="addClientChannelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Client Channel</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addClientChannelForm" action="/client_channel" method="post">

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

<!-- Edit client channel modal -->
<div id="editClientChannelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Client Channel</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editClientChannelForm" action="/client_channel" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Name</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="eclient" id="eclient">
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
                          <label class="col-sm-3 col-sm-3 control-label">Channel</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="cechannelID" id="cechannelID">
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
                              <select class="form-control" name="eclientChannelStatusCode" id="eclientChannelStatusCode">
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
                                <input type="text" name="eclientChannelName" id="eclientChannelName" placeholder="Client Channel Name" class="form-control">
                                <input type="hidden" name="eclient_channelID" id="eclient_channelID" placeholder="Client Channel ID" class="form-control">
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Created On</label>
                          <div class="col-sm-9">
                              <input type="text" name="eclientChanneldate_created" id="eclientChanneldate_created" class="form-control" value="" readonly>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Last Modified</label>
                          <div class="col-sm-9">
                              <input type="text" name="eclientChanneldate_modified" id="eclientChanneldate_modified" class="form-control" value="" readonly>
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




<!-- deactivate client channel modal -->
<div id="deactivateClientChannelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate Client Channel</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateClientChannelForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this client channel?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client Channel ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rclientChannelID" id="rclientChannelID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateClientChannel" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop