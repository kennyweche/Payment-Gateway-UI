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
        <!-- Trigger the add user modal with this button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addUserModal">Add New User</button>
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/users/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="userSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="userSearchBtn" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped users-table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Usertype</th>
            <th>Client ID</th>
            <th>User Group</th>
            <th>Status</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td class="userID">{{ $user->userID }}</td>
                <td class="username">{{ $user->username }}</td>
                <td class="userType">{{ $user->userType }}</td>
                <td>{{ $user->description }}</td>
                <input type="hidden" class="userStatusCode" name="userStatusCode" value="{{ $user->status }}">
                <td>{{ $user->clientName }}</td>
                <input type="hidden" class="userClientID" name="userClientID" value="{{ $user->clientID }}">
                <td>{{ $user->name }}</td>
                <input type="hidden" class="userGroup" name="userGroup" value="{{ $user->userGroup }}">
                <td class="userdate_created">{{ $user->date_created }}</td>
                <td class="userdate_modified">{{ $user->date_modified }}</td>
                <td><a href="#" type="button" class="btn btn-info edit-user" type="button" data-toggle="modal" data-target="#editUserModal">Edit</a></td>
                 <td><a href="#" type="button" class="btn btn-danger deactivate-user" type="button" data-toggle="modal" data-target="#deactivateUserModal">Deactivate</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $users->links() }}

<!-- Add user modal -->
<div id="addUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addUserForm" action="/users" method="POST">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Username</label>
                          <div class="col-sm-9">
                              <input type="text" name="username" id="username" placeholder="User Name" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Password</label>
                          <div class="col-sm-9">
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">User Type</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="userType" id="userType">
                                  <option value="">Choose User Type</option>
                                  <option value="UI">UI</option>
                                  <option value="API">API</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">User Group</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="userGroup" id="userGroup">
                                  <option value="">Choose User Group</option>
                                  @foreach($userGroups as $userGroup)
                                      <option value="{{$userGroup->id}}">{{$userGroup->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="userClientID" id="userClientID">
                                  <option value="">Choose Client</option>
                                  @foreach($clients as $client)
                                      <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="userStatusCode" id="userStatusCode">
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

<!-- Edit user modal -->
<div id="editUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editUserForm" action="" method="POST">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Username</label>
                          <div class="col-sm-9">
                          	  <input type="hidden" name="euserID" id="euserID" placeholder="User ID" class="form-control">
                              <input type="text" name="eusername" id="eusername" placeholder="User Name" class="form-control">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="put">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">User Type</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="euserType" id="euserType">
                                  <option value="">Choose User Type</option>
                                  <option value="UI">UI</option>
                                  <option value="API">API</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">User Group</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="euserGroup" id="euserGroup">
                                  <option value="">Choose User Group</option>
                                  @foreach($userGroups as $userGroup)
                                      <option value="{{$userGroup->id}}">{{$userGroup->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Client</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="euserClientID" id="euserClientID">
                                  <option value="">Choose Client</option>
                                  @foreach($clients as $client)
                                      <option value="{{$client->clientID}}">{{$client->clientName}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="euserStatusCode" id="euserStatusCode">
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
	                        <input type="text" name="euserdate_created" id="euserdate_created" class="form-control" value="" readonly>
	                    </div>
                  	</div>

					<div class="form-group">
						<label class="col-sm-3 col-sm-3 control-label">Last Modified</label>
						<div class="col-sm-9">
							<input type="text" name="euserdate_modified" id="euserdate_modified" class="form-control" value="" readonly>
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


<!-- deactivate user modal -->
<div id="deactivateUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateUserForm" action="" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this user?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="ruserID" id="ruserID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="deactivateUserBtn" class="btn btn-success">Deactivate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop