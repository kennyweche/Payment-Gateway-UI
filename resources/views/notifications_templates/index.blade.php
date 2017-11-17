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
         <!-- Trigger the add message_template code modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMessageTemplateModal">Add New Message Template</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/notifications_templates/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="notificationTemplateSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="notificationTemplateSearchBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped notifications-templates-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Channel Ref</th>
            <th>Status</th>
            <th>Template</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notificationTemplates as $notificationTemplate)
            <tr>
                <td class="template_id">{{ $notificationTemplate->template_id }}</td>
                <td>{{ $notificationTemplate->code }}</td>
                <input type="hidden" class="notifications_channel_ref_id" value="{{ $notificationTemplate->channel_ref_id }}">
                <td>{{ $notificationTemplate->description }}</td>
                 <input type="hidden" class="notifications_status_code_id" value="{{ $notificationTemplate->status_code_id }}">
                <td class="template">{{ $notificationTemplate->template }}</td>
                <td class="notifications_date_created">{{ $notificationTemplate->date_created }}</td>
                <td class="notifications_date_modified">{{ $notificationTemplate->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-message-template" type="button" data-toggle="modal" data-target="#editMessageTemplateModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger delete-message-template" type="button" data-toggle="modal" data-target="#deleteTemplateModal">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $notificationTemplates->links() }}


<!-- Add message template modal -->
<div id="addMessageTemplateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Message Template </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addMessageTemplateForm" action="/notifications_templates" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Message Template</label>
                          <div class="col-sm-9">
                             <textarea rows="6" class="form-control" name="messageTemplate" id="messageTemplate" placeholder="Some message here"></textarea>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Ref</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="messageChannelRef" id="messageChannelRef">
                                  <option value="">Choose Channel Ref</option>
                                  @foreach($channelRefs as $channelRef)
                                      <option value="{{$channelRef->channel_ref_id}}">{{$channelRef->code}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="messageStatusCode" id="messageStatusCode">
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


<!-- Edit message template modal -->
<div id="editMessageTemplateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Message Template</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editMessageTemplateForm" action="/notifications_templates" method="post">

                     <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Message Template</label>
                          <div class="col-sm-9">
                             <textarea rows="6" class="form-control" name="emessageTemplate" id="emessageTemplate" placeholder="Some message here"></textarea>
                             <input type="hidden" name="etemplate_id" id="etemplate_id" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Channel Ref</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="emessageChannelRef" id="emessageChannelRef">
                                  <option value="">Choose Channel Ref</option>
                                  @foreach($channelRefs as $channelRef)
                                      <option value="{{$channelRef->channel_ref_id}}">{{$channelRef->code}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="emessageStatusCode" id="emessageStatusCode">
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
                              <input type="text" name="enotifications_date_created" id="enotifications_date_created" class="form-control" value="" readonly>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Last Modified</label>
                          <div class="col-sm-9">
                              <input type="text" name="enotifications_date_modified" id="enotifications_date_modified" class="form-control" value="" readonly>
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

<!-- delete message template -->
<div id="deleteTemplateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Delete Message Template</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deleteMessageTemplate" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to delete this message template?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Template ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rtemplate_id" id="rtemplate_id" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deleteTemplateBtn" class="btn btn-success">Delete</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>
@stop