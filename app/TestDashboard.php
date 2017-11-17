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

        $result = DB::select('SELECT calendar.datefield AS DATE,COUNT(clientID) AS count FROM clients RIGHT JOIN calendar ON (DATE(clients.date_created) = calendar.datefield) WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(date_created)) FROM clients) AND (SELECT MAX(DATE(date_created)) FROM clients)) GROUP BY DATE DESC limit 8');


        return $result; 
    }

    public function getTransactionsCountPerWeek() {

        $userClient = Auth::user()->clientID;        

        if(Auth::user()->clientID == 1) {
            $result = DB::select('SELECT calendar.datefield AS DATE,COUNT(requestlogID) AS count FROM request_logs RIGHT JOIN calendar ON (DATE(request_logs.date_created) = calendar.datefield) WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(date_created)) FROM request_logs) AND (SELECT MAX(DATE(date_created)) FROM request_logs)) GROUP BY DATE DESC limit 8');
        } else {
            $result = DB::select("SELECT calendar.datefield AS DATE,COUNT(request_logs.requestlogID) AS count,ccr.clientID, ccr.destinationClientID FROM request_logs INNER JOIN transactions t ON t.requestlogID = request_logs.requestlogID INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id RIGHT JOIN calendar ON (DATE(request_logs.date_created) = calendar.datefield) WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(date_created)) FROM request_logs) AND (SELECT MAX(DATE(date_created)) FROM request_logs)) AND ccr.clientID = '$userClient' OR ccr.destinationClientID = '$userClient' GROUP BY DATE, ccr.clientID, ccr.destinationClientID DESC limit 8");
        }

       


        return $result; 
    }

    public function getPaymentsToClient() {

        $userClient = Auth::user()->clientID;

        if(Auth::user()->clientID == 1) {

            $result = DB::select('
                SELECT SUM(amount) AS amount, (select clientName FROM clients c 
                INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
                WHERE ccr.code = destination)destination
                FROM transactions t 
                INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                GROUP BY destination
                ');

        } else {


            $result = DB::select("
                 SELECT SUM(amount) AS amount, (select clientName FROM clients c 
                INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
                WHERE ccr.code = destination)destination
                FROM transactions t 
                INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                WHERE ccr.destinationClientID = '$userClient'
                GROUP BY destination
                ");
        }

        return $result; 
    }

     public function getPaymentsFromClient() {

        $userClient = Auth::user()->clientID;

        if(Auth::user()->clientID == 1) {
            $result = DB::select('
                SELECT source, 
                SUM(amount) AS amount FROM transactions t 
                INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                GROUP BY r.source
                ');
        } else {
            $result = DB::select("
                SELECT source, 
                SUM(amount) AS amount FROM transactions t 
                INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                WHERE ccr.clientID = '$userClient'
                GROUP BY r.source
                ");
        }

         
        
        return $result; 
    }


    public function getSumByClients() {

        $userClient = Auth::user()->clientID;

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

        if(Auth::user()->clientID == 1) {
    		// get total revenue for current week
        	$result = DB::table('request_logs')
        				->select('amount')
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

        if(Auth::user()->clientID == 1) {
        	$result = DB::select('SELECT calendar.datefield AS DATE,IFNULL(SUM(request_logs.amount),0) AS total
    							FROM request_logs RIGHT JOIN calendar ON (DATE(request_logs.date_created) = calendar.datefield)
    							WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(date_created)) FROM request_logs) AND (SELECT MAX(DATE(date_created)) FROM request_logs)) GROUP BY DATE DESC limit 8');
        } else {

            /*$result = DB::select("SELECT calendar.datefield AS DATE,IFNULL(SUM(request_logs.amount),0) AS total, request_logs.requestlogID, ccr.clientID, ccr.destinationClientID FROM request_logs INNER JOIN transactions t ON t.requestlogID = request_logs.requestlogID INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id RIGHT JOIN calendar ON (DATE(request_logs.date_created) = calendar.datefield) WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(date_created)) FROM request_logs) AND (SELECT MAX(DATE(date_created)) FROM request_logs)) AND ccr.clientID = '$userClient' OR ccr.destinationClientID = '$userClient' GROUP BY DATE, request_logs.requestlogID, ccr.clientID, ccr.destinationClientID DESC limit 8");*/

            $result = DB::select("SELECT calendar.datefield AS DT,IFNULL(SUM(r.amount),0) AS total FROM request_logs r RIGHT JOIN calendar ON (DATE(r.date_created) = calendar.datefield) inner join transactions t on t.requestlogID = r.requestlogID inner join client_channels_reference ccr on t.channel_ref_id=ccr.channel_ref_id WHERE clientID='$userClient' or destinationClientID='$userClient' AND (calendar.datefield BETWEEN '2017-07-01' AND '2017-07-12') GROUP BY DT DESC limit 7");


        }

    	return $result;

    }

    // get total revenue
    public function getTotalRevenue() {

        $userClient = Auth::user()->clientID;

        if(Auth::user()->clientID == 1) {
        	$result = DB::table('request_logs')
        				->select('amount')
        				->sum('amount');
        } else {

            $result = DB::table('request_logs')
                    ->select('amount')
                    ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                    ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'transactions.channel_ref_id')
                    ->where('client_channels_reference.clientID', '=', $userClient)
                    ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                    ->sum('amount');
        }


    	return $result;
    }

    // get all pending payments
    public function getPendingPayments() {

        $userClient = Auth::user()->clientID;

        if(Auth::user()->clientID == 1) {
        	$result = DB::table('request_logs')
        				->where('overalStatus', 121)
        				->count();
        } else {
            $result = DB::table('request_logs')
                    ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                    ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'transactions.channel_ref_id')
                    ->where('client_channels_reference.clientID', '=', $userClient)
                    ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                    ->where('overalStatus', 121)
                    ->orWhere('destinationClientID', '=', $userClient)
                    ->count();
        }

       

    	return $result;
    }

    // get all successful payments
    public function getSuccessfulPayments() {

        $userClient = Auth::user()->clientID;

        if(Auth::user()->clientID == 1) {
        	$result = DB::table('request_logs')
        				->where('overalStatus', 123)
        				->count();
        } else {
            $result = DB::table('request_logs')
                    ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                    ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'transactions.channel_ref_id')
                    ->where('client_channels_reference.clientID', '=', $userClient)
                    ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                    ->where('overalStatus', 123)
                    ->where('clientID', '=', $userClient)
                    ->orWhere('destinationClientID', '=', $userClient)
                    ->count();
        }

        

    	return $result;
    }

    // get all failed payments
    public function getFailedPayments() {

        $userClient = Auth::user()->clientID;

        if(Auth::user()->clientID == 1) {
        	$result = DB::table('request_logs')
        				->where('overalStatus', 124)
        				->count();
        } else {
            $result = DB::table('request_logs')
                    ->join('transactions', 'transactions.requestlogID', '=', 'request_logs.requestlogID')
                    ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'transactions.channel_ref_id')
                    ->where('client_channels_reference.clientID', '=', $userClient)
                    ->orWhere('client_channels_reference.destinationClientID', '=', $userClient)
                    ->where('overalStatus', 124)
                    ->where('clientID', '=', $userClient)
                    ->orWhere('destinationClientID', '=', $userClient)
                    ->count();
        }

        
    	return $result;
    }
}
