<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB; 


class Users extends Model
{
    protected $table = 'users';
    public $primaryKey  = 'userID';
    
    // function to add user
    public function addUser($username, $password, $userType, $clientID, $status, $userGroup) {
    	$date_created  = date('Y-m-d H:i:s');
    	$date_modified = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO users(username, password, userType, clientID, status, date_created, date_modified, userGroup) VALUES (?,?,?,?,?,?,?,?)', [$username, $password, $userType, $clientID, $status, $date_created, $date_modified, $userGroup]);

    	return $result;
    	
    }

    // function to update user details
    public function updateUser($userID, $username, $userType, $clientID, $status, $userGroup) {

    	$result = DB::table('users')
		            ->where('userID', $userID)
		            ->update(['username' => $username, 'userType' => $userType, 'clientID' => $clientID, 'status' => $status, 'userGroup' => $userGroup]);

    	return $result;
    	
    }

    // function to deactivate user 
    public function deactivateUser($userID) {

    	$result = DB::table('users')
		            ->where('userID', $userID)
		            ->update(['status' => 137]);

    	return $result;
    	
    }
}
