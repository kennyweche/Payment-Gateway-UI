<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dashboard;
use DB;
use Auth;


class DashboardController extends Controller
{
    public function index() {

    	// instantiate model class
    	$dashboard = new Dashboard(); 

    	$getTotalClients       = $dashboard->getTotalClients();
    	$getSumByClients       = $dashboard->getSumByClients();
    	$getCurrentWeekRevenue = $dashboard->getCurrentWeekRevenue();
    	$getLastSevenDaysRevenue = $dashboard->getLastSevenDaysRevenue();
    	$getTotalRevenue       = $dashboard->getTotalRevenue();
    	$getPendingPayments    = $dashboard->getPendingPayments();
    	$getSuccessfulPayments = $dashboard->getSuccessfulPayments();
    	$getFailedPayments     = $dashboard->getFailedPayments();
        $getTotalClientsPerWeek      = $dashboard->getTotalClientsPerWeek();
        $getTransactionsCountPerWeek = $dashboard->getTransactionsCountPerWeek();
        $getPaymentsFromClient       = $dashboard->getPaymentsFromClient();
        $getPaymentsToClient         = $dashboard->getPaymentsToClient();

        if(Auth::user()->user_group == 5) {
            return redirect('payments');
        } else {
            // return index view with data  
            return view('dashboard.index', compact('getTotalClients', 'getSumByClients', 'getCurrentWeekRevenue', 'getLastSevenDaysRevenue', 'getTotalRevenue', 'getPendingPayments', 'getSuccessfulPayments', 'getFailedPayments', 'getTotalClientsPerWeek','getTransactionsCountPerWeek','getPaymentsToClient','getPaymentsFromClient'));
        }

    	
    }

     public function show()
    {
        return redirect('dashboard');
    }
}
