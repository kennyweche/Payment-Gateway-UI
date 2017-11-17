@extends('layouts.master')
@section('content')

	<div class="row">
		<div class="col-md-10 col-md-offset-2">
			@if(Session::has('flash_message'))
		    <p class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></p>
			@endif
			@if(Session::has('error_message'))
			    <p class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></p>
			@endif
			<br>
		</div>
	</div>

     <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
                <li><a data-toggle="tab" href="#groups">Groups</a></li>
                <li><a data-toggle="tab" href="#permissions">Permissions</a></li>
            </ul>

            <br>

            <div class="tab-content">

                    <div id="users" class="tab-pane fade in active">
                        <div class="col-md-12 users">
                            <div class="panel panel-default">
                                <div class="panel-heading">Users</div>
                                <div class="panel-body">
                                    <div align="center">
                                        <a href="#" type="button" class="btn btn-default" type="button" data-toggle="modal" data-target="#addUserModal"><span class="fa fa-plus"></span> Add New User</a>
                                    </div>
                                    <br>
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>User Type</th>
                                                <th>Group</th>
                                                <th>Client</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Modified</th>
                                                <th colspan="4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data -->
                                            @foreach($users as $user)
                                                <tr>
                                                    <td class="userID">{{ $user->id }}</td>
                                                    <td class="username">{{ $user->username }}</td>
                                                    <td class="email">{{ $user->email }}</td>
                                                    <td class="userType">{{ $user->userType }}</td>

                                                    <td>{{ $user->name }}</td>
                                                    <input type="hidden" class="userGroupID" name="userGroupID" value="{{ $user->user_group }}">

                                                    <td>{{ $user->clientName }}</td>
                                                    <input type="hidden" class="userClientID" name="userClientID" value="{{ $user->clientID }}">

                                                    <td>{{ $user->description }}</td>
                                                    <input type="hidden" class="userStatusCodeID" name="userStatusCodeID" value="{{ $user->status }}">

                                                    <td class="user_created_at">{{ $user->created_at }}</td>
                                                    <td class="user_modified_at">{{ $user->updated_at }}</td>

                                                    <td><a href="#" type="button" class="btn btn-info btn-xs add-to-group" type="button" data-toggle="modal" data-target="#addUserToGroupModal"><span class="fa fa-plus"> Group</span></a></td>

                                                    <td><a href="#" type="button" class="btn btn-info btn-xs edit-user" type="button" data-toggle="modal" data-target="#editUserModal">Edit</a></td>

                                                    @if($user->status == 137)
                                                    <td><a href="#" type="button" class="btn btn-success btn-xs activate-users" type="button" data-toggle="modal" data-target="#activateUsersModal">Activate</a></td>
                                                    @else
                                                    <td><a href="#" type="button" class="btn btn-danger btn-xs deactivate-users" type="button" data-toggle="modal" data-target="#deactivateUsersModal">Deactivate</a></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="panel-footer">User Management</div>
                            </div>
                        </div>
                    </div>

                    <div id="groups" class="tab-pane fade">
                        <div class="col-md-12 groups">
                            <div class="panel panel-default">
                                <div class="panel-heading">Groups</div>
                                <div class="panel-body">
                                    <div align="center">
                                        <a href="#" type="button" class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroupModal"><span class="fa fa-plus"></span> Add New Group</a>
                                    </div>
                                    <br>
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Created</th>
                                                <th>Modified</th>
                                                <th colspan="4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data -->
                                            @foreach($groups as $group)
                                                <tr>
                                                    <td class="groupID">{{ $group->id }}</td>
                                                    <td class="groupName">{{ $group->name }}</td>
                                                    <td class="groupDescription">{{ $group->description }}</td>
                                                    <td>{{ $group->created_at }}</td>
                                                    <td>{{ $group->updated_at }}</td>
                                                    <td><a href="{{ route('group.show', $group->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                                    <td><a href="#" type="button" class="btn btn-info btn-sm attach-permissions" type="button" data-toggle="modal" data-target="#attachPermissionsModal">Attach Permissions</a></td>
                                                    <td><a href="#" type="button" class="btn btn-warning btn-sm edit-group" type="button" data-toggle="modal" data-target="#editGroupModal">Edit</a></td>
                                                    <td><a href="#" type="button" class="btn btn-danger btn-sm remove-group" type="button" data-toggle="modal" data-target="#removeGroupModal">Remove</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="panel-footer">User Management</div>
                            </div>
                        </div>
                    </div>

                    <div id="permissions" class="tab-pane fade">
                        <div class="col-md-12 permissions">
                            <div class="panel panel-default">
                                <div class="panel-heading">Permissions</div>
                                <div class="panel-body">
                                    <div align="center">
                                        <a href="#" type="button" class="btn btn-default" type="button" data-toggle="modal" data-target="#addPermissionModal"><span class="fa fa-plus"></span> Add New Permission</a>
                                    </div>
                                    <br>
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th >Name</th>
                                                <th>Description</th>
                                                <th>Created</th>
                                                <th>Modified</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data -->
                                            @foreach($permissions as $permission)
                                                <tr>
                                                    <td class="permissionID">{{ $permission->id }}</td>
                                                    <td class="permName">{{ $permission->name }}</td>
                                                    <td class="permDescription">{{ $permission->description }}</td>
                                                    <td>{{ $permission->created_at }}</td>
                                                    <td>{{ $permission->updated_at }}</td>
                                                    <td><a href="#" type="button" class="btn btn-info btn-sm edit-permission" type="button" data-toggle="modal" data-target="#editPermissionModal">Edit</a></td>
                                                    <td><a href="#" type="button" class="btn btn-danger btn-sm remove-permission" type="button" data-toggle="modal" data-target="#removePermissionModal">Remove</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="panel-footer">User Management</div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>

<!-- MODALS -->

<div id="addUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addUserForm" method="post" action="{{ url('/user_management/add_user') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" id="username" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">User Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="userType" id="userType">
                            	<option>Choose User Type</option>
                            	<option value="UI">UI</option>
                            	<option value="API">API</option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Group</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="userGroupID" id="userGroupID">
                            	<option>Choose Group</option>  
                            	@foreach($groups as $group)
                            	<option value="{{ $group->id }}">{{ $group->name }}</option>
                            	@endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="userClientID" id="userClientID">
                            	<option>Choose Client</option>
                            	@foreach($clients as $client)
                            	<option value="{{ $client->clientID }}">{{ $client->clientName }}</option>
                            	@endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="userStatusCodeID" id="userStatusCodeID">
                            	<option>Choose Status</option>
                            	@foreach($statusCodes as $status)
                            	<option value="{{ $status->code }}">{{ $status->description }}</option>
                            	@endforeach
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="addUserBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="editUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editUserForm" method="post" action="{{ url('/user_management/edit_user') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="euserID" id="euserID" class="form-control" readonly>
                            <input type="text" name="eusername" id="eusername" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="eemail" id="eemail" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">User Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="euserType" id="euserType">
                                <option>Choose User Type</option>
                                <option value="UI">UI</option>
                                <option value="API">API</option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Group</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="euserGroupID" id="euserGroupID">
                                <option>Choose Group</option>  
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="euserClientID" id="euserClientID">
                                <option>Choose Client</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->clientID }}">{{ $client->clientName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="euserStatusCodeID" id="euserStatusCodeID">
                                <option>Choose Status</option>
                                @foreach($statusCodes as $status)
                                <option value="{{ $status->code }}">{{ $status->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="editUserBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="addGroupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Group</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addGroupForm" method="post" action="{{ url('/user_management/add_group') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="groupName" id="groupName" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="groupDescription" id="groupDescription" class="form-control">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="addGroupBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="editGroupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Group</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editGroupForm" method="post" action="{{ url('/user_management/edit_group') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="egroupID" id="egroupID" class="form-control" readonly>
                            <input type="text" name="egroupName" id="egroupName" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="egroupDescription" id="egroupDescription" class="form-control">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="editGroupBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="addPermissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add New Permission</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addPermissionForm" method="post" action="{{ url('/user_management/add_permission') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="permName" id="permName" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="permDescription" id="permDescription" class="form-control">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="addPermissionBrn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="editPermissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit Permission</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editPermissionForm" method="post" action="{{ url('/user_management/edit_permission') }}">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="epermissionID" id="epermissionID" class="form-control" readonly>
                            <input type="text" name="epermName" id="epermName" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="epermDescription" id="epermDescription" class="form-control">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="editPermissionBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>
    </div>
</div>

<div id="addUserToGroupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add User To Group | Client</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addToGroupForm" action="{{ url('user_management/add_user_to_group') }}" method="POST">

                      <div class="form-group">
                          <label class="col-sm-3 col-sm-3 control-label">User ID</label>
                          <div class="col-sm-9">
                              <input type="text" name="userID" id="userID" placeholder="User ID" class="form-control" readonly>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                          <label class="col-sm-3 col-sm-3 control-label">Group</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="userGroupID" id="userGroupID">
                                  <option value="">Choose Group</option>
                                  @foreach($groups as $group)
                                      <option value="{{$group->id}}">{{$group->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="saveBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="attachPermissionsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Attach Permissions</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="attachPermissionsModalForm" action="{{ url('user_management/attach_permissions') }}" method="post">

                	<div class="form-group">
                        <label class="col-sm-2 control-label">Group ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="agroupID" id="agroupID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                    	<label class="col-sm-2 control-label">Permissions</label>
                    	<div class="col-sm-10">
	                    	<div class="checkbox">
	                    		@foreach($permissions as $permission)
	                        	<label><input type="checkbox" name="permissions[]" value="{{ $permission->id }}">{{ $permission->name }}</label><br>
	                        	@endforeach
	                        </div>
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="attachPermissionsBtn" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="deactivateUsersModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Deactivate User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="deactivateUserForm" action="{{ url('user_management/deactivate_user') }}" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to deactivate this user?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rusersID" id="rusersID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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

<div id="activateUsersModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Activate User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="activateUserForm" action="{{ url('user_management/activate_user') }}" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to activate this user?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">User ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="auserID" id="auserID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="activateUserBtn" class="btn btn-success">Activate</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="removeGroupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Remove Group</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="removeGroupForm" action="{{ url('user_management/remove_group') }}" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to remove this group?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Group ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rgroupID" id="rgroupID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="removeGroupBtn" class="btn btn-success">Remove</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

<div id="removePermissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Remove Permission</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="removePermissionForm" action="{{ url('user_management/remove_permission') }}" method="post">

                    <div class="form-group">
                        <div class="col-sm-12">
                            <p class="alert alert-danger">Are you sure you want to remove this permission?</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Permission ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="rpermissionID" id="rpermissionID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                      
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="removePermissionBtn" class="btn btn-success">Remove</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>  
            </div>
            </form>
        </div>

    </div>
</div>

@stop