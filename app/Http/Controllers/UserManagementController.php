<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\UserManagement;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index() {

    	$users = DB::table('ui_users')
                ->join('clients', 'clients.clientID', '=', 'ui_users.clientID')
                ->join('statusCodes', 'statusCodes.code', '=', 'ui_users.status')
                ->join('user_groups', 'user_groups.id', '=', 'ui_users.user_group')
                ->select('ui_users.*', 'clients.clientName', 'user_groups.name', 'statusCodes.description')
                ->get();

        $statusCodes = DB::table('statusCodes')
                    ->Where('code', '=', 136)
                    ->orWhere('code', '=', 137)
                    ->get();

    	$permissions = DB::table('permissions')->get();
    	$groups      = DB::table('user_groups')->get();
    	$clients     = DB::table('clients')->get();

    	return view('user_management.index', compact('users', 'permissions', 'groups', 'clients', 'statusCodes'));
    }

    public function addUsers(Request $request) {

        $userManagement = new UserManagement();

        $username   = $request->username;
        $email      = $request->email;
        $userType   = $request->userType;
        $user_group = $request->userGroupID;
        $clientID   = $request->userClientID;
        $status     = $request->userStatusCodeID;

        $result = $userManagement->addUsers($username, $email, $userType, $user_group, $clientID, $status);

        if($result) {
             \Session::flash('flash_message','New user registered successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function addGroup(Request $request) {

        $userManagement = new UserManagement();

        $groupName        = $request->groupName;
        $groupDescription = $request->groupDescription;

        $result = $userManagement->addGroup($groupName, $groupDescription);

        if($result) {
             \Session::flash('flash_message','New group created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function addPermission(Request $request) {

        $userManagement = new UserManagement();

        $permName        = $request->permName;
        $permDescription = $request->permDescription;

        $result = $userManagement->addPermission($permName, $permDescription);

        if($result) {
             \Session::flash('flash_message','New permissions created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function addUserToGroup(Request $request) {
    	$userID       = $request->userID;
    	$userClientID = $request->userClientID;
    	$userGroupID  = $request->userGroupID;

    	$userManagement = new UserManagement();

    	$result = $userManagement->addUserToGroup($userID, $userClientID, $userGroupID);

    	if($result) {
             \Session::flash('flash_message','User added to group successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');
    }

    public function deactivateUsers(Request $request) {
        $userManagement = new UserManagement();

        $userID = $request->rusersID;
        
        $result = $userManagement->deactivateUsers($userID);
    
        if($result) {
             \Session::flash('flash_message','User deactivated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');
    }

    public function activateUser(Request $request) {

        $userManagement = new UserManagement();

        $userID = $request->auserID;
        $result = $userManagement->activateUser($userID);

        if($result) {
             \Session::flash('flash_message','User activated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');
    }

    public function attachPermissions(Request $request) {

        $userManagement = new UserManagement();

        $groupID     = $request->agroupID;
        $permissions = $request->permissions;

        $result = $userManagement->attachPermissions($groupID, $permissions);

        if($result) {
             \Session::flash('flash_message','Permissions attached to group successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }    

    public function editUser(Request $request) {

        $userManagement = new UserManagement();

        $userID     = $request->euserID;
        $username   = $request->eusername;
        $email      = $request->eemail;
        $userType   = $request->euserType;
        $user_group = $request->euserGroupID;
        $clientID   = $request->euserClientID;
        $status     = $request->euserStatusCodeID;

        $result = $userManagement->editUser($userID, $username, $email, $userType, $user_group, $clientID, $status);

        if($result) {
             \Session::flash('flash_message','User details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function editGroup(Request $request) {

        $userManagement = new UserManagement();

        $groupID          = $request->egroupID;
        $groupName        = $request->egroupName;
        $groupDescription = $request->egroupDescription;

        $result = $userManagement->editGroup($groupID, $groupName, $groupDescription);

        if($result) {
             \Session::flash('flash_message','Group details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function editPermission(Request $request) {

        $userManagement = new UserManagement();

        $permissionID    = $request->epermissionID;
        $permName        = $request->epermName;
        $permDescription = $request->epermDescription;

        $result = $userManagement->editPermission($permissionID, $permName, $permDescription);

        if($result) {
             \Session::flash('flash_message','Permissions details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function removeGroup(Request $request) {

        $userManagement = new UserManagement();

        $groupID = $request->rgroupID;
        $result = $userManagement->removeGroup($groupID);

        if($result) {
             \Session::flash('flash_message','Group removed successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function removePermission(Request $request) {

        $userManagement = new UserManagement();

        $permissionID = $request->rpermissionID;

        $result = $userManagement->removePermission($permissionID);

        if($result) {
             \Session::flash('flash_message','Permission removed successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('user_management');   
    }

    public function show($id) {
       
       $groups = DB::table('user_groups')
                       ->select('user_groups.id as group_id','user_groups.name as group_name', 'user_groups.description as group_desc')
                       ->where('user_groups.id', '=', $id)
                       ->get();

       $permissions = DB::table('user_permissions')
                       ->select('user_permissions.*', 'permissions.id as perm_id','permissions.name as perm_name','permissions.description as perm_desc')
                       ->join('permissions', 'permissions.id', '=', 'user_permissions.permission')
                       ->join('user_groups', 'user_groups.id', '=', 'user_permissions.user_group')
                       ->where('user_permissions.user_group', '=', $id)
                       ->get();

        $perms = DB::table('permissions')->get();

       return view('user_management.group', compact('permissions', 'groups', 'perms'));
   }

   public function changePassword(Request $request) {

        $userManagement = new UserManagement();

        $currentPassword = $request->currentPassword;
        $newPassword     = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        $passwordCheck = Hash::check($currentPassword, Auth::user()->password);

        if($passwordCheck) {

            $result = $userManagement->changePassword($newPassword);

            if($result) {
                 \Session::flash('flash_message','Password changed successfully.');
                 return view('auth.login');
                 Auth::logout();
            } else {
                 \Session::flash('error_message','Error in handling request.');
            }

        } else {
             \Session::flash('error_message','Password provided do not match old password.');
        }
   }

}