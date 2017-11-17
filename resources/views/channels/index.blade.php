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
        <!-- Trigger the add channels modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addChannelModal">Add New Channel</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/channels/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="channelsSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="channelsSearchBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped channels-table">
    <thead>
        <tr>
            <th>Channel ID</th>
            <th>Channel Name</th>
            <th>Status</th>
            <th>Channel Code</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($channels as $channel)
            <tr>
                <td class="channelID">{{ $channel->channelID }}</td>
                <td class="channelName">{{ $channel->channelName }}</td>
                <td>{{ $channel->description }}</td>
                <input type="hidden" class="channelStatusCode" name="channelStatusCode" value="{{ $channel->status }}">
                <td class="channelCode">{{ $channel->channelCode }}</td>
                <td class="date_created">{{ $channel->date_created }}</td>
                <td class="date_modified">{{ $channel->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-channel" type="button" data-toggle="modal" data-target="#editChannelModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-channel" type="button" data-toggle="modal" data-target="#deactivateChannelModal">Deactivate</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $channels->links() }}

<!-- Add channel modal -->
<div id="addChannelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Channel</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addChannelForm" action="/channels" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Name</label>
                          <div class="col-sm-9">
                              <input type="text" name="channelName" id="channelName" class="form-control" placeholder="Channel Name">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="channelStatusCode" id="channelStatusCode">
                                  <option value="">Choose Status</option>
                                  @foreach($statusCodes as $codes)
                                      <option value="{{$codes->code}}">{{$codes->description}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Code</label>
                          <div class="col-sm-9">
                              <input type="text" name="channelCode" id="channelCode" class="form-control" placeholder="Channel Code">
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


<!-- Edit channel modal -->
<div id="editChannelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Channel</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editChannelForm" action="/channels" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Name</label>
                          <div class="col-sm-9">
                              <input type="hidden" name="echannelID" id="echannelID" class="form-control" placeholder="Channel ID">
                              <input type="text" name="echannelName" id="echannelName" class="form-control" placeholder="Channel Name">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="echannelStatusCode" id="echannelStatusCode">
                                  <option value="">Choose Status</option>
                                  @foreach($statusCodes as $codes)
                                      <option value="{{$codes->code}}">{{$codes->description}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Code</label>
                          <div class="col-sm-9">
                              <input type="text" name="echannelCode" id="echannelCode" class="form-control" placeholder="Channel Code">
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




<!-- deactivate channel -->
<div id="deactivateChannelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate Channel</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateChannelForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this channel?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Channel</label>
                        <div class="col-sm-10">
                            <input type="text" name="rchannelID" id="rchannelID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateChannelBtn" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop