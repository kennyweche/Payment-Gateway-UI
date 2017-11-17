<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use SnappyImage;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller {

    public function index() {

        $userClient = Auth::user()->clientID;

        if($userClient == 1) {
          $clients = DB::table('clients')->get();
        } else {
          $clients = DB::select(DB::raw("
            select ccr.clientID as sourceClientID,(select clientName from clients c where c.clientID=ccr.clientID)source , ccr.destinationClientID, (select clientName from clients c where c.clientID=ccr.destinationClientID)destination from client_channels_reference ccr where destinationClientID = '$userClient' or clientID = '$userClient';

          "));
        }

        

        $status = FALSE;

      	return view('reports.index', compact('clients', 'status'));

    }

    public function search(Request $request) {

          $userClient = Auth::user()->clientID;

          if($userClient == 1) {
            $clients = DB::table('clients')->get();
          } else {
            $clients = DB::select(DB::raw("
              select ccr.clientID as sourceClientID,(select clientName from clients c where c.clientID=ccr.clientID)source , ccr.destinationClientID, (select clientName from clients c where c.clientID=ccr.destinationClientID)destination from client_channels_reference ccr where destinationClientID = '$userClient' or clientID = '$userClient';

            "));
          }

          $fromclientID = $request->fromclientID;
          $toclientID   = $request->toclientID;
          $fromDate     = $request->fromDate;
          $toDate       = $request->toDate;

          //================================================//
                  // Get client name
          //================================================//

          $clientName = DB::table('clients')
              ->select('clientName', 'clientID')
              ->where('clientID', '=', $fromclientID)
              ->get();

          $clients = DB::select(DB::raw("
            select ccr.clientID as sourceClientID,(select clientName from clients c where c.clientID=ccr.clientID)source , ccr.destinationClientID, (select clientName from clients c where c.clientID=ccr.destinationClientID)destination from client_channels_reference ccr where destinationClientID = '$userClient' or clientID = '$userClient';

          "));

          //=================================================//
                  // Generate Report Data
          //=================================================//
          if(empty($request->toclientID)) {
              $allTransactionsToClientCount = DB::select(
                    DB::raw("

                  SELECT source,
                  count(t.transactionID) AS count, 
                  SUM(amount) AS total, (select clientName FROM clients c 
                  INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
                  WHERE ccr.code = destination)destination FROM transactions t 
                  INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                  INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                  WHERE ccr.destinationClientID='$fromclientID' AND r.date_created BETWEEN '$fromDate' AND '$toDate'
                  GROUP BY r.source, r.destination

                "));

              $allTransactionsFromClientCount = DB::select(
                DB::raw("

                  SELECT source,
                  count(t.transactionID) AS count, 
                  SUM(amount) AS total, (select clientName FROM clients c 
                  INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
                  WHERE ccr.code = destination)destination FROM transactions t 
                  INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                  INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                  WHERE ccr.clientID='$fromclientID' AND r.date_created BETWEEN '$fromDate' AND '$toDate'
                  GROUP BY r.source, r.destination

                "));

                if(empty($allTransactionsFromClientCount) && empty($allTransactionsToClientCount)) {

                    \Session::flash('error_message','Opps! No records found for '.$fromDate.' to '.$toDate.' for '.$clientName->first()->clientName);
                    $status = FALSE;

                    return view('reports.index', compact('clients','allTransactionsFromClientCount', 'allTransactionsToClientCount', 'fromDate', 'toDate', 'clientName', 'toclientID', 'fromclientID', 'status'));
                } else {
                      $status = TRUE;
                     return view('reports.index', compact('clients','allTransactionsFromClientCount', 'allTransactionsToClientCount', 'fromDate', 'toDate', 'clientName', 'toclientID', 'fromclientID', 'status'));
                }


            } else {

                $allTransactionsBetweenClientsCount = DB::select(
                    DB::raw("

                  SELECT source,
                  count(t.transactionID) AS count, 
                  SUM(amount) AS total, (select clientName FROM clients c 
                  INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
                  WHERE ccr.code = destination)destination FROM transactions t 
                  INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                  INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                  WHERE ccr.clientID='$fromclientID' AND ccr.destinationClientID='$toclientID' AND r.date_created BETWEEN '$fromDate' AND '$toDate'
                  GROUP BY r.source, r.destination

                "));

                if(empty($allTransactionsBetweenClientsCount)) {
                    \Session::flash('error_message','Opps! No records found for '.$fromDate.' to '.$toDate);
                    $status = FALSE;

                    return view('reports.index', compact('clients','allTransactionsBetweenClientsCount','fromDate', 'toDate', 'clientName', 'toclientID', 'fromclientID', 'status'));
                } else {

                    $status = TRUE;
                    return view('reports.index', compact('clients','allTransactionsBetweenClientsCount','fromDate', 'toDate', 'clientName', 'toclientID', 'fromclientID', 'status'));
                }
                                    
            }
        
    }

    public function show() {
        return redirect('reports');
    }

    public function exportPDF(Request $request) {

        $fromDate      = $request->fromDate;
        $toDate        = $request->toDate;
        $clientName    = $request->clientName;
        $fromclientID  = $request->fromclientID;
        $toclientID    = $request->toclientID;
        $fromSum       = $request->fromSum;
        $toSum         = $request->toSum;

        if(!empty($request->toclientID)) {

            $allTransactionsBetweenClientsCount = DB::select(
                    DB::raw("

                  SELECT source,
                  count(t.transactionID) AS count, 
                  SUM(amount) AS total, (select clientName FROM clients c 
                  INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
                  WHERE ccr.code = destination)destination FROM transactions t 
                  INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
                  INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
                  WHERE ccr.clientID='$fromclientID' AND ccr.destinationClientID='$toclientID' AND r.date_created BETWEEN '$fromDate' AND '$toDate'
                  GROUP BY r.source, r.destination

                "));

            $date = date('Y-m-d H:i:s');
            $pdf = PDF::loadView('reports.report', compact('fromDate', 'toDate', 'clientName', 'allTransactionsBetweenClientsCount', 'fromSum', 'toSum'));
            return $pdf->download($date.'_report_for_'.$clientName.'_from_'.$fromDate.'_to_'.$toDate.'_invoice.pdf');

        } else {
            $allTransactionsToClientCount = DB::select(
              DB::raw("

            SELECT source,
            count(t.transactionID) AS count, 
            SUM(amount) AS total, (select clientName FROM clients c 
            INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
            WHERE ccr.code = destination)destination FROM transactions t 
            INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
            INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
            WHERE ccr.destinationClientID='$fromclientID' AND r.date_created BETWEEN '$fromDate' AND '$toDate'
            GROUP BY r.source, r.destination

          "));

          $allTransactionsFromClientCount = DB::select(
            DB::raw("

              SELECT source,
              count(t.transactionID) AS count, 
              SUM(amount) AS total, (select clientName FROM clients c 
              INNER JOIN client_channels_reference ccr ON c.clientID=ccr.destinationClientID 
              WHERE ccr.code = destination)destination FROM transactions t 
              INNER JOIN request_logs r ON t.requestlogID = r.requestlogID 
              INNER JOIN client_channels_reference ccr ON ccr.channel_ref_id = t.channel_ref_id 
              WHERE ccr.clientID='$fromclientID' AND r.date_created BETWEEN '$fromDate' AND '$toDate'
              GROUP BY r.source, r.destination

            "));
          $date = date('Y-m-d H:i:s');
          
          $pdf = PDF::loadView('reports.report', compact('fromDate', 'toDate', 'clientName', 'allTransactionsFromClientCount', 'allTransactionsToClientCount', 'fromSum', 'toSum'));
          return $pdf->download($date.'_report_for_'.$clientName.'_from_'.$fromDate.'_to_'.$toDate.'_invoice.pdf');
      }
        
    }



}
