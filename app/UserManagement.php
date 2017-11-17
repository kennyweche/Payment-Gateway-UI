<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserManagement extends Model
{
    public function addUsers($username, $email, $userType, $user_group, $clientID, $status) {
        $created_at = date('Y-m-d H:i:s');
        $password = bcrypt("123456");
        $result = DB::insert('INSERT INTO ui_users(username, email, password, userType, user_group, clientID, status, created_at) VALUES(?,?,?,?,?,?,?,?)', [$username, $email, $password, $userType, $user_group, $clientID, $status, $created_at]);

        return $result;
    }

    public function findPermissions($groupID) {
        $perms = DB::table('permissions')
                    ->select('permissions.name')
                    ->join('user_permissions', 'user_permissions.permission', '=', 'permissions.id')
                    ->join('user_groups', 'user_groups.id', '=', 'user_permissions.user_group')
                    ->where('user_groups.id', '=', $groupID)
                    ->get();
    }

	public function addGroup($groupName, $groupDescription) {

		$created_at = date('Y-m-d H:i:s');

		$result = DB::insert('INSERT INTO user_groups(name, description, created_at) VALUES(?,?,?)', [$groupName, $groupDescription, $created_at]);

		return $result;
	}

	public function addPermission($permName, $permDescription) {

		$created_at = date('Y-m-d H:i:s');
		
		$result = DB::insert('INSERT INTO permissions(name, description, created_at) VALUES(?,?,?)', [$permName, $permDescription, $created_at]);

		return $result;
	}
    
    public function addUserToGroup($userID, $userClientID, $userGroupID){
    	$result = DB::table('ui_users')
		            ->where('id', $userID)
		            ->update(['clientID' => $userClientID, 'user_group' => $userGroupID]);

    	return $result;
    }

    public function attachPermissions($groupID, $permissions) {

    	$created_at = date('Y-m-d H:i:s');

        // remove all permissions first
        $result = DB::table('user_permissions')
                    ->where('user_group', $groupID)
                    ->delete();

        if($result) {

            foreach ($permissions as $key => $value) {
                DB::insert('INSERT INTO user_permissions(user_group, permission, created_at) VALUES(?,?,?)', [$groupID, $value, $created_at]);
            }

            return TRUE;
        }
    }

    public function deactivateUsers($userID) {

    	$result = DB::table('ui_users')
		            ->where('id', $userID)
		            ->update(['status' => 137]);

    	return $result;
    }

    public function activateUser($userID) {

    	$result = DB::table('ui_users')
		            ->where('id', $userID)
		            ->update(['status' => 136]);

    	return $result;
    }

    public function editUser($userID, $username, $email, $userType, $user_group, $clientID, $status) {
        $result = DB::table('ui_users')
                    ->where('id', $userID)
                    ->update(['username' => $username, 'email' => $email, 'userType' => $userType, 'user_group' => $user_group, 'clientID' => $clientID, 'status' => $status]);

        return $result;
    }

    public function editGroup($groupID, $groupName, $groupDescription) {
        $result = DB::table('user_groups')
                    ->where('id', $groupID)
                    ->update(['name' => $groupName, 'description' => $groupDescription]);

        return $result;
    }

    public function editPermission($permissionID, $permName, $permDescription) {
        $result = DB::table('permissions')
                    ->where('id', $permissionID)
                    ->update(['name' => $permName, 'description' => $permDescription]);

        return $result;
    }

    public function removeGroup($groupID) {

        $result = DB::table('user_groups')
                    ->where('id', $groupID)
                    ->delete();

        $result1 = DB::table('user_permissions')
                    ->where('user_group', $groupID)
                    ->delete();

        return $result;    
    }

    public function removePermission($permissionID) {

        $result = DB::table('permissions')
                    ->where('id', $permissionID)
                    ->delete();

        return $result;     
    }

    public function changePassword($newPassword) {

        $newPassword = bcrypt($newPassword);
        $userID = Auth::user()->id;
        
        $result = DB::table('ui_users')
                    ->where('id', $userID)
                    ->update(['password' => $newPassword]);

        return $result;

    }

    
}
