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
        <!-- Trigger the add client modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addClientModal">Add New Client</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/clients/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="clientSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="searchClientBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped clients-table">
    <thead>
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Status</th>
            <th>Client Code</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td class="clientID">{{ $client->clientID }}</td>
                <td class="clientName">{{ $client->clientName }}</td>
                <td>{{ $client->description }}</td>
                <input type="hidden" class="status" name="status" value="{{ $client->status }}">
                <td class="clientCode">{{ $client->clientCode }}</td>
                <td class="date_created">{{ $client->date_created }}</td>
                <td class="date_modified">{{ $client->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-client" type="button" data-toggle="modal" data-target="#editClientModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-client" type="button" data-toggle="modal" data-target="#deactivateClientModal">Deactivate</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $clients->links() }}

<!-- Add client modal -->
<div id="addClientModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Client</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addClientForm" action="/clients" method="post">

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

<!-- Edit client modal -->
<div id="editClientModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Client</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editClientForm" action="" method="POST">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Name</label>
                          <div class="col-sm-9">
                              <input type="hidden" name="eclientID" id="eclientID" class="form-control">
                              <input type="text" name="eclientName" value="" id="eclientName" placeholder="Client Name" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Code</label>
                          <div class="col-sm-9">
                                <input type="text" name="eclientCode" value="" id="eclientCode" placeholder="Client Code" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="eclientStatus" id="eclientStatus">
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
                              <input type="text" name="edate_created" id="edate_created" class="form-control" value="" readonly>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Last Modified</label>
                          <div class="col-sm-9">
                              <input type="text" name="edate_modified" id="edate_modified" class="form-control" value="" readonly>
                          </div>
                      </div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="submitChanges" class="btn btn-success">Submit Changes</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<!-- Edit client modal -->
<div id="editClientModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Client</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editClientForm" action="" method="POST">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Name</label>
                          <div class="col-sm-9">
                              <input type="hidden" name="eclientID" id="eclientID" class="form-control">
                              <input type="text" name="eclientName" value="" id="eclientName" placeholder="Client Name" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client Code</label>
                          <div class="col-sm-9">
                                <input type="text" name="eclientCode" value="" id="eclientCode" placeholder="Client Code" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="eclientStatus" id="eclientStatus">
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
                              <input type="text" name="edate_created" id="edate_created" class="form-control" value="" readonly>
                          </div>
                      </div>

                       <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Last Modified</label>
                          <div class="col-sm-9">
                              <input type="text" name="edate_modified" id="edate_modified" class="form-control" value="" readonly>
                          </div>
                      </div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="submitChanges" class="btn btn-success">Submit Changes</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>


<!-- deactivate client modal -->
<div id="deactivateClientModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate Client</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateClientForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this client?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rclientID" id="rclientID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateClientBtn" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop