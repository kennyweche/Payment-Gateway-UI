<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class ClientChannel extends Model
{
	protected $table = 'client_channels';
    public $primaryKey  = 'client_channelID';

    // function to add new client channel
    public function addClientChannel($clientID, $channelID, $client_channel_name, $status) {

    	$date_created = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO client_channels(clientID, channelID, client_channel_name, status, date_created) VALUES (?,?,?,?,?)', [$clientID, $channelID, $client_channel_name, $status, $date_created]);

    	return $result;
    }

    // function to update client channel details
    public function updateClientChannel($client_channelID, $clientID, $channelID, $client_channel_name, $status) {

    	$result = DB::table('client_channels')
		            ->where('client_channelID', $client_channelID)
		            ->update(['clientID' => $clientID, 'channelID' => $channelID, 'client_channel_name' => $client_channel_name, 'status' => $status]);

    	return $result;
    	
    }

    // function to deactivate client channel 
    public function deactivateClientChannel($client_channelID) {

    	$result = DB::table('client_channels')
		            ->where('client_channelID', $client_channelID)
		            ->update(['status' => 137]);

    	return $result;
    	
    }

}
