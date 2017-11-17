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
        <!-- Trigger the add status code modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addStatusCodeModal">Add New Status Code</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/status_codes/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="statusCodeSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="searchStatusCodeBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped status-codes-table">
    <thead>
        <tr>
            <th>Status Code ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($statusCodes as $statusCode)
            <tr>
                <td class="statusCodeID">{{ $statusCode->statusCodeID }}</td>
                <td class="code">{{ $statusCode->code }}</td>
                <td class="description">{{ $statusCode->description }}</td>
                <td class="date_created">{{ $statusCode->date_created }}</td>
                <td class="date_modified">{{ $statusCode->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-status-code" type="button" data-toggle="modal" data-target="#editStatusCodeModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-status-code" type="button" data-toggle="modal" data-target="#deactivateStatusCodeModal">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $statusCodes->links() }}

<!-- Add status code modal -->
<div id="addStatusCodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Status Code</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addStatusCodeForm" action="/status_codes" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Code</label>
                          <div class="col-sm-9">
                              <input type="text" name="code" id="code" class="form-control" placeholder="Code">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Description</label>
                          <div class="col-sm-9">
                              <input type="text" name="description" id="description" class="form-control" placeholder="Description">
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


<!-- Edit status code modal -->
<div id="editStatusCodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Status Code</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editStatusCodeForm" action="/status_codes" method="post">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Code</label>
                          <div class="col-sm-9">
                              <input type="hidden" name="estatusCodeID" id="estatusCodeID" class="form-control" placeholder="Code">
                              <input type="text" name="ecode" id="ecode" class="form-control" placeholder="Code">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Description</label>
                          <div class="col-sm-9">
                              <input type="text" name="edescription" id="edescription" class="form-control" placeholder="Description">
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




<!-- deactivate status code -->
<div id="deactivateStatusCodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate Status Code</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateStatusCodeForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this status code?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status Code ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rstatusCodeID" id="rstatusCodeID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateStatusCode" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop