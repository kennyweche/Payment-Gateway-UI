<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB; 

class Client extends Model
{	

	protected $table = 'clients';
    public $primaryKey  = 'clientID';
    
    // function to add client
    public function addClient($clientName, $clientCode, $status) {
    	$date_created = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO clients(clientName, status, clientCode, date_created) VALUES (?,?,?,?)', [$clientName, $status, $clientCode, $date_created]);

    	return $result;
    	
    }

    // function to update client details
    public function updateClient($clientID, $clientName, $clientCode, $status) {

    	$result = DB::table('clients')
		            ->where('clientID', $clientID)
		            ->update(['clientName' => $clientName, 'status' => $status, 'clientCode' => $clientCode]);

    	return $result;
    	
    }

    // function to deactivate client 
    public function deactivateClient($clientID) {

    	$result = DB::table('clients')
		            ->where('clientID', $clientID)
		            ->update(['status' => 137]);

    	return $result;
    	
    }

}
