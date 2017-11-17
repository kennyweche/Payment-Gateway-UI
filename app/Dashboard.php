<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Model
{
    public function getTotalClients() {
    	$lastSevenDays = \Carbon\Carbon::now()->subDays(7)->toDateTimeString();



    	$result = DB::table('request_logs')
    				->select('source')
    				->where('date_created', '<=', $lastSevenDays)
    				->distinct('source')
    				->groupBy('source')
    				->count();
    	return $result; 
    }

    public function getTotalClientsPerWeek() {

        $result = DB::select('SELECT calendar.datefield AS DATE,COUNT(clientID) AS count FROM clients RIGHT JOIN calendar ON (DATE(clients.date_created) = calendar.datefield) WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(date_created)) FROM clients) AND (SELECT MAX(DATE(date_created)) FROM clients)) GROUP BY DATE DESC LIMIT 7');


        return $result; 
    }

    public function getTransactionsCountPerWeek() {

        $userClient = Auth::user()->clientID;

        if($userClient == 1) {
            $result = DB::select("SELECT calendar.datefield AS DATE,COUNT(r.requestlogID) AS count FROM request_logs r RIGHT JOIN calendar ON (DATE(r.date_created) = calendar.datefield) inner join transactions t on t.requestlogID = r.requestlogID inner join client_channels_reference ccr on t.channel_ref_id=ccr.channel_ref_id GROUP BY DATE DESC LIMIT 7");
        } else {

            $result = DB::select("SELECT calendar.datefield AS DATE,COUNT(r.requestlogID) AS count FROM request_logs r RIGHT JOIN calendar ON (DATE(r.date_created) = calendar.datefield) inner join transactions t on t.requestlogID = r.requestlogID inner join client_channels_reference ccr on t.channel_ref_id=ccr.channel_ref_id WHERE clientID='$userClient' or destinationClientID='$userClient' GROUP BY DATE DESC LIMIT 7");
        }


        return $result; 
    }

    public function getPaymentsToClient() {

        $userClient = Auth::user()->clientID;
        
        if($userClient == 1) {
            $result = DB::select('
                        SELECT IFNULL(SUM(amount),0) AS amount, c.clientName AS destination
                        FROM transactions t 
                        INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                        INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                        INNER JOIN client_channels cc on cc.client_channelID =ccr.client_channelID
                        INNER JOIN clients c on c.clientID =ccr.destinationClientID
                        GROUP BY c.clientName
                ');
        } else {
            $result = DB::select("
                        SELECT IFNULL(SUM(amount),0) AS amount, c.clientName AS destination
                        FROM transactions t 
                        INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                        INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                        INNER JOIN client_channels cc on cc.client_channelID =ccr.client_channelID
                        INNER JOIN clients c on c.clientID =cc.clientID
                        WHERE ccr.destinationClientID = '$userClient'
                        GROUP BY c.clientName
            ");
        }
        

        return $result; 
    }

     public function getPaymentsFromClient() {

        $userClient = Auth::user()->clientID;
        
        if($userClient == 1) {
             $result = DB::select('
                        SELECT IFNULL(SUM(amount),0) AS amount, c.clientName AS source
                        FROM transactions t 
                        INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                        INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                        INNER JOIN client_channels cc on cc.client_channelID =ccr.client_channelID
                        INNER JOIN clients c on c.clientID =ccr.clientID
                        GROUP BY c.clientName
                ');
        } else {
            $result = DB::select("
                        SELECT IFNULL(SUM(amount),0) AS amount, c.clientName AS source
                        FROM transactions t 
                        INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                        INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                        INNER JOIN client_channels cc on cc.client_channelID =ccr.client_channelID
                        INNER JOIN clients c on c.clientID =cc.clientID
                        WHERE ccr.clientID = '$userClient'
                        GROUP BY c.clientName
            ");
        }

        
        
        return $result; 
    }


    public function getSumByClients() {
    	$lastSevenDays = \Carbon\Carbon::now()->subDays(7)->toDateTimeString();

    	$result = DB::table('request_logs')
    				->select('source',  DB::raw('SUM(amount) as amount'))
    				->where('date_created', '<=', $lastSevenDays)
    				->distinct('source')
    				->groupBy('source')
    				->get();       

    	return $result;
    }

    

    public function getCurrentWeekRevenue() {

        $userClient = Auth::user()->clientID;

    	// get current week
	    $fromDate = \Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString();
		$tillDate = \Carbon\Carbon::now()->subDay()->toDateString();

        if($userClient == 1) {
            // get total revenue for current week
            $result = DB::table('request_logs')
                        ->select('amount')
                        ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'transactions.channel_ref_id')
                        ->whereBetween('request_logs.date_created', [$fromDate, $tillDate])
                        ->sum('amount');
        } else {

            // get total revenue for current week
            $result = DB::table('request_logs')
                        ->select('amount')
                        ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'transactions.channel_ref_id')
                        ->where('client_channels_reference.clientID', '=', $userClient)
                        ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                        ->whereBetween('request_logs.date_created', [$fromDate, $tillDate])
                        ->sum('amount');
        }

    	return $result;
    }

    // get data for last seven days revenue representation
    public function getLastSevenDaysRevenue() {
        $userClient = Auth::user()->clientID;

        if($userClient == 1) {
    	
            $result = DB::select("SELECT calendar.datefield AS DATE,IFNULL(SUM(r.amount),0) AS total FROM request_logs r RIGHT JOIN calendar ON (DATE(r.date_created) = calendar.datefield) inner join transactions t on t.requestlogID = r.requestlogID inner join client_channels_reference ccr on t.channel_ref_id=ccr.channel_ref_id GROUP BY DATE DESC LIMIT 7");
        } else {

            $result = DB::select("SELECT calendar.datefield AS DATE,IFNULL(SUM(r.amount),0) AS total FROM request_logs r RIGHT JOIN calendar ON (DATE(r.date_created) = calendar.datefield) inner join transactions t on t.requestlogID = r.requestlogID inner join client_channels_reference ccr on t.channel_ref_id=ccr.channel_ref_id WHERE ccr.clientID='$userClient' or ccr.destinationClientID='$userClient' GROUP BY DATE DESC LIMIT 7");
        }

    	return $result;

    }

    // get total revenue
    public function getTotalRevenue() {
        $userClient = Auth::user()->clientID;

        if($userClient == 1) {
            $result = DB::table('request_logs')
                        ->select('amount')
                        ->sum('amount');
        } else {
            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'transactions.channel_ref_id', '=', 'client_channels_reference.channel_ref_id')
                        ->select('amount')
                        ->where('client_channels_reference.clientID', '=', $userClient)
                        ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                        ->sum('amount');

           /* $result = DB::select("SELECT IFNULL(SUM(r.amount),0) AS amount FROM request_logs r inner join transactions t on t.requestlogID = r.requestlogID inner join client_channels_reference ccr on t.channel_ref_id=ccr.channel_ref_id WHERE ccr.clientID='$userClient' or ccr.destinationClientID='$userClient'");*/
        }
    	

    	return $result;
    }

    // get all pending payments
    public function getPendingPayments() {

        $userClient = Auth::user()->clientID;
    	
        if($userClient == 1) {
            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', 'transactions.channel_ref_id')
                        ->join('client_channels', 'client_channels.client_channelID', 'client_channels_reference.client_channelID')
                        ->join('clients', 'clients.clientID', 'client_channels.clientID')
                        ->where('overalStatus', 121)
                        ->count();
        } else {

            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', 'transactions.channel_ref_id')
                        ->join('client_channels', 'client_channels.client_channelID', 'client_channels_reference.client_channelID')
                        ->join('clients', 'clients.clientID', 'client_channels.clientID')
                        ->where('overalStatus', 121)
                        ->where('client_channels_reference.clientID', '=', $userClient)
                        ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                        ->count();
        }

    	return $result;
    }

    // get all successful payments
    public function getSuccessfulPayments() {

        $userClient = Auth::user()->clientID;
    	

        if($userClient == 1) {
            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', 'transactions.channel_ref_id')
                        ->join('client_channels', 'client_channels.client_channelID', 'client_channels_reference.client_channelID')
                        ->join('clients', 'clients.clientID', 'client_channels.clientID')
                        ->where('overalStatus', 123)
                        ->count();
        } else {

            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', 'transactions.channel_ref_id')
                        ->join('client_channels', 'client_channels.client_channelID', 'client_channels_reference.client_channelID')
                        ->join('clients', 'clients.clientID', 'client_channels.clientID')
                        ->where('overalStatus', 123)
                        ->where('client_channels_reference.clientID', '=', $userClient)
                        ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                        ->count();
        }

    	return $result;
    }

    // get all failed payments
    public function getFailedPayments() {

        $userClient = Auth::user()->clientID;
    	
        if($userClient == 1) {
            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', 'transactions.channel_ref_id')
                        ->join('client_channels', 'client_channels.client_channelID', 'client_channels_reference.client_channelID')
                        ->join('clients', 'clients.clientID', 'client_channels.clientID')
                        ->where('overalStatus', 124)
                        ->count();
        } else {

            $result = DB::table('request_logs')
                        ->join('transactions', 'transactions.requestlogID', 'request_logs.requestlogID')
                        ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', 'transactions.channel_ref_id')
                        ->join('client_channels', 'client_channels.client_channelID', 'client_channels_reference.client_channelID')
                        ->join('clients', 'clients.clientID', 'client_channels.clientID')
                        ->where('overalStatus', 124)
                        ->where('client_channels_reference.clientID', '=', $userClient)
                        ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                        ->count();
        }

    	return $result;
    }
}
