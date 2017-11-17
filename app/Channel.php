<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Channel extends Model
{
    protected $table = 'channel';
    public $primaryKey  = 'channelID';


    // function to add channel to database
	public function addChannel($channelName, $status, $channelCode){

		$date_created = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO channel(channelName, status, channelCode, date_created) VALUES (?,?,?,?)', [$channelName, $status, $channelCode, $date_created]);

    	return $result;
	}	


	// function to update channel details
	public function updateChannel($channelID, $channelName, $status, $channelCode) {
		$result = DB::table('channel')
		            ->where('channelID', $channelID)
		            ->update(['channelName' => $channelName, 'status' => $status, 'channelCode' => $channelCode]);

    	return $result;
    	
    }

    // function to deactivate channel 
    public function deactivateChannel($channelID) {

    	$result = DB::table('channel')
		            ->where('channelID', $channelID)
		            ->update(['status' => 137]);

    	return $result;
    	
    }
}
