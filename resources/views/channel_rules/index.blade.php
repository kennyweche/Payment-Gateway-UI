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
        <!-- Trigger the add channel rule modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addChannelRuleModal">Add New Channel Rule</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/channel_rules/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="channelRulesSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="channelRulesSearchBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered  table-stripped channel-rules-table">
    <thead>
        <tr>
            <th>Channel Rules ID</th>
            <th>Rule Name</th>
            <th>Rules Endpoint</th>
            <th>Client Channel ID</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($channelRules as $channelRule)
            <tr>
                <td class="channelRulesID">{{ $channelRule->channel_rules_id }}</td>
                <td class="ruleName">{{ $channelRule->rule_name }}</td>
                <td class="rulesEndpoint">{{ $channelRule->rules_endpoint }}</td>
                <input type="hidden" class="clientChannelID" name="clientChannelID" value="{{ $channelRule->client_channelID }}">
                <td>{{ $channelRule->client_channel_name }}</td>
                <td class="channelRuledate_created">{{ $channelRule->date_created }}</td>
                <td class="channelRuledate_modified">{{ $channelRule->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-channel-rules" type="button" data-toggle="modal" data-target="#editChannelRuleModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-channel-rule" type="button" data-toggle="modal" data-target="#deactivateChannelRulesModal">Deactivate</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $channelRules->links() }}

<!-- Add channel rule modal -->
<div id="addChannelRuleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Channel Rule</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addChannelRulesForm" action="/channel_rules" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Rule Name</label>
                          <div class="col-sm-9">
                              <input type="text" name="ruleName" id="ruleName" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Rule Endpoint</label>
                          <div class="col-sm-9">
                              <input type="text" name="rulesEndpoint" id="rulesEndpoint" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Channel</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="clientChannelID" id="clientChannelID">
                                  <option value="">Choose Channel</option>
                                  @foreach($clientChannels as $clientChannel)
                                      <option value="{{$clientChannel->client_channelID}}">{{$clientChannel->client_channel_name}}</option>
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

<!-- Edit channel rule modal -->
<div id="editChannelRuleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Channel Rule</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editChannelRuleForm" action="/channel_rules" method="post">

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Rule Name</label>
                          <div class="col-sm-9">
                              <input type="hidden" name="echannelRulesID" id="echannelRulesID" class="form-control">
                              <input type="text" name="eruleName" id="eruleName" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Rule Endpoint</label>
                          <div class="col-sm-9">
                              <input type="text" name="erulesEndpoint" id="erulesEndpoint" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Channel</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="eclientChannelID" id="eclientChannelID">
                                  <option value="">Choose Channel</option>
                                  @foreach($clientChannels as $clientChannel)
                                      <option value="{{$clientChannel->client_channelID}}">{{$clientChannel->client_channel_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Created On</label>
                          <div class="col-sm-9">
                              <input type="text" name="echannelRuledate_created" id="echannelRuledate_created" class="form-control" value="" readonly>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Last Modified</label>
                          <div class="col-sm-9">
                              <input type="text" name="echannelRuledate_modified" id="echannelRuledate_modified" class="form-control" value="" readonly>
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




<!-- deactivate channel rule modal -->
<div id="deactivateChannelRulesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate Channel Rule</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateChannelRuleForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this channel rule?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Channel Rule ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rchannelRulesID" id="rchannelRulesID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateChannelRuleBtn" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop