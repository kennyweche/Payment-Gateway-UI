<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ClientChannelReference extends Model
{
   public function addClientChannelReference($clientID, $destinationClientID, $client_channelID, $code, $queue_name, $end_point, $callback, $senderid, $notifyCustomer, $status) {

   	$date_created = date('Y-m-d H:i:s');

    $result = DB::insert('INSERT INTO client_channels_reference(clientID, destinationClientID, client_channelID, code, queue_name, end_point, callback, senderid, notifyCustomer, status, date_created) VALUES (?,?,?,?,?,?,?,?,?,?,?)', [$clientID, $destinationClientID, $client_channelID, $code, $queue_name, $end_point, $callback, $senderid, $notifyCustomer, $status, $date_created]);

    return $result;


   }

   public function updateClientChannelReference($channelRefId, $clientID, $destinationClientID, $client_channelID, $code, $queue_name, $end_point, $callback, $senderid, $notifyCustomer, $status) {

   		$result = DB::table('client_channels_reference')
		            ->where('channel_ref_id', $channelRefId)
		            ->update(['clientID' => $clientID, 'destinationClientID' => $destinationClientID, 'client_channelID' => $client_channelID, 'code' => $code, 'queue_name' => $queue_name, 'end_point' => $end_point, 'callback' => $callback, 'senderid' => $senderid, 'notifyCustomer' => $notifyCustomer, 'status' => $status]);

    	return $result;

   }

   // function to deactivate client channel reference
    public function deactivateClientChannelReference($channelRefId) {

    	$result = DB::table('client_channels_reference')
		            ->where('channel_ref_id', $channelRefId)
		            ->update(['status' => 137]);

    	return $result;
    	
    }
}

