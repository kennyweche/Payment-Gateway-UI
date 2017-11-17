<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;
use Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function index() {

        /*$sql="select r.requestlogID, r.amount,(r.external_ref_id)refNo,(select clientName from clients where clientID=ccr.clientID)Source,(select clientName from clients where clientID=ccr.destinationClientID)Destination,(r.source_account)sourceAccount, (r.destination_account)destinationAccount, (ccr.code)TransactionType,(s.description)status, (r.date_created)createdAt from request_logs r inner join transactions t on t.requestlogID = r.requestlogID inner join  client_channels_reference ccr on ccr.code=r.destination inner join statusCodes s on r.overalStatus=s.code WHERE ccr.clientID = $clientID";


        if(toclientID){
          $sql.= "AND ccr.destinationClientID=$toclientID"  
        }

        if(refno){
          $sql.= " AND r.external_ref_id='$accno'";
        }

        if(sourceacc){
          $sql.= " AND r.source_account='$sourceacc'";
        }

        $sql .=  " AND r.date_created between x and y";*/

        $userClient = Auth::user()->clientID;

        if($userClient == 1) {
          $clients = DB::table('clients')->get();
        } else {
          $clients = DB::select(DB::raw("
            select ccr.clientID as sourceClientID,(select clientName from clients c where c.clientID=ccr.clientID)source , ccr.destinationClientID, (select clientName from clients c where c.clientID=ccr.destinationClientID)destination from client_channels_reference ccr where destinationClientID = '$userClient' or clientID = '$userClient';

          "));
        }

        /*
            
            select clientID, destinationClientID  from client_channels_reference where destinationClientID =2;
            select distinct clientID, clientName from clients where clientID in (1,3,2,9);
    
        */

        $payments = DB::select(
                      DB::raw("

                      SELECT r.requestlogID, r.overalStatus, r.payment_date, r.amount,(r.external_ref_id),(select clientName from clients where clientID=ccr.clientID)source,(select clientName from clients where clientID=ccr.destinationClientID)clientName,(r.source_account), (r.destination_account), (ccr.code),(s.description)description, (r.date_created) 
                      FROM request_logs r 
                      INNER JOIN transactions t ON t.requestlogID = r.requestlogID 
                      INNER JOIN  client_channels_reference ccr ON ccr.code=r.destination 
                      INNER JOIN statusCodes s ON r.overalStatus=s.code 
                      WHERE ccr.clientID = '$userClient' OR ccr.destinationClientID = '$userClient'
                      ORDER BY r.payment_date DESC
                      LIMIT 7

                    "));

        /*$clients = DB::table('clients')->get();*/

        /*$sqlCcrMapping = DB::select(DB::raw(" select clientID, destinationClientID  from client_channels_reference where destinationClientID ='$userClient' "));

        $mappings = array(); 

        foreach ($sqlCcrMapping as $key => $value) {
          array_push($mappings, $value->clientID);
          array_push($mappings, $value->destinationClientID);
        }

        $inString = "";

        foreach (array_unique($mappings) as $key => $value) {
          $inString.=$value.",";
        }

        print_r($inString);die();

        $clients = DB::select(DB::raw(" select distinct clientID, clientName from clients where clientID in ('$sqlCcrMapping') "));*/

        return view('payments.index', compact('clients', 'payments'));

    }

    public function paymentSearch(Request $request) {

        $paymentFromClientID = $request->paymentFromClientID;
        $paymentToClientID   = $request->paymentToClientID;
        $refNo               = $request->refNo;
        $sourceAccount       = $request->sourceAccount;
        $paymentFromDate     = $request->paymentFromDate;
        $paymentToDate       = $request->paymentToDate;

        $sql = "
                  SELECT r.requestlogID, r.overalStatus, r.payment_date, r.amount,(r.external_ref_id),(select clientName from clients where clientID=ccr.clientID)source,(select clientName from clients where clientID=ccr.destinationClientID)clientName,(r.source_account), (r.destination_account), (ccr.code),(s.description)description, (r.date_created) 
                  FROM request_logs r 
                  INNER JOIN transactions t ON t.requestlogID = r.requestlogID 
                  INNER JOIN  client_channels_reference ccr ON ccr.code=r.destination 
                  INNER JOIN statusCodes s ON r.overalStatus=s.code 
                  WHERE ccr.clientID = '$paymentFromClientID'

            ";

        if(!empty($paymentToClientID)) {

            $sql.= " AND ccr.destinationClientID = '$paymentToClientID' ";
            $payments = DB::select(
                      DB::raw("

                      $sql

                    "));

  
        } 

        if(!empty($refNo)) {

            $sql.= " AND r.external_ref_id = '$refNo' ";
            $payments = DB::select(
                      DB::raw("

                      $sql

                    "));

  
        } 

        if(!empty($sourceAccount)) {

            $sql.= " AND r.source_account = '$sourceAccount' ";
            $payments = DB::select(
                      DB::raw("

                      $sql

                    "));
  
        } 

         if(!empty($paymentFromDate) && !empty($paymentToDate)) {

            $sql.= " AND r.payment_date BETWEEN '$paymentFromDate' AND '$paymentToDate' ";
            $payments = DB::select(
                      DB::raw("

                      $sql

                    "));
  
        } 


        $userClient = Auth::user()->clientID;

        if($userClient == 1) {
          $clients = DB::table('clients')->get();
        } else {
          $clients = DB::select(DB::raw("
            select ccr.clientID as sourceClientID,(select clientName from clients c where c.clientID=ccr.clientID)source , ccr.destinationClientID, (select clientName from clients c where c.clientID=ccr.destinationClientID)destination from client_channels_reference ccr where destinationClientID = '$userClient' or clientID = '$userClient';

          "));
        }
        
        return view('payments.index', compact('payments', 'clients'));
          


    }

    public function show() {
      return redirect('payments');
    }
}
