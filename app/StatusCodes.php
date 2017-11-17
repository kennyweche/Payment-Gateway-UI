<?php

namespace App;  

use Illuminate\Database\Eloquent\Model;
use DB;

class StatusCodes extends Model
{
    protected $table = 'statusCodes';
    public $primaryKey  = 'statusCodeID';

    // function to add status code
    public function addStatusCode($code, $description) {
    	$date_created = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO statusCodes(code, description, date_created) VALUES (?,?,?)', [$code, $description, $date_created]);

    	return $result;
    	
    }

    // function to update status code details
    public function updateStatusCode($statusCodeID, $code, $description) {

    	$result = DB::table('statusCodes')
		            ->where('statusCodeID', $statusCodeID)
		            ->update(['code' => $code, 'description' => $description]);

    	return $result;
    	
    }

    // function to delete status code 
    public function deleteStatusCode($statusCodeID) {

    	$result = DB::table('statusCodes')
		            ->where('statusCodeID', $statusCodeID)
		            ->delete();

    	return $result;
    	
    }

}
