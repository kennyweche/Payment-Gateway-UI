@extends('layouts.master')
@section('content')
	
	@foreach($groups as $group)
	<div class="panel panel-default">
		<div class="panel-heading">Group Name : {{ $group->group_name }}</div>
	</div>

	<div class="panel-body">
		
		<h4>Permissions available for <span class="text-danger">{{ $group->group_name }}</span> group.</h4>

		<a href="#" type="button" class="btn btn-info btn-sm attach-group-permissions" type="button" data-toggle="modal" data-target="#attachPermissionsModal">Attach | Remove Permissions</a>

		<input type="hidden" name="attgroupID" id="attgroupID" class="form-control" value="{{ $group->group_id }}">

		<br><br>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>

			<tbody>
				@foreach($permissions as $perm)
				<tr>
					<td>{{ $perm->perm_id }}</td>
					<td>{{ $perm->perm_name }}</td>
					<td>{{ $perm->perm_desc }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

	<div class="panel-footer">User Management</div>
@endforeach

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
                            <input type="text" name="agroupID" id="atgroupID" class="form-control" readonly>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group">
                    	<label class="col-sm-2 control-label">Permissions</label>
                    	<div class="col-sm-10">
	                    	<div class="checkbox">
	                    		@foreach($perms as $perm)
	                        	<label><input type="checkbox" name="permissions[]" value="{{ $perm->id }}">{{ $perm->name }}</label><br>
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
@stop