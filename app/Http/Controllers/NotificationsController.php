<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NotificationsController extends Controller
{
    public function index() {

    	// get all data from notifications table and paginate
    	$notifications = DB::table('notifications')
    					->select('notifications.*')
    					->Paginate(5);

    	return view('notifications.index', compact('notifications'));

    }

    public function search(Request $request) {

    	if(empty($request->notificationSearch)) {
    		return redirect('notifications');
    	} else {

    		$notificationSearch = $request->notificationSearch;

    		$notifications = DB::table('notifications')
    					->select('notifications.*')
    					->where('notifications.message_id', 'like', '%'.$notificationSearch.'%')
    					->orWhere('notifications.requestLogID', 'like', '%'.$notificationSearch.'%')
    					->orWhere('notifications.senderid', 'like', '%'.$notificationSearch.'%')
    					->orWhere('notifications.receiver', 'like', '%'.$notificationSearch.'%')
    					->orWhere('notifications.message', 'like', '%'.$notificationSearch.'%')
    					->orWhere('notifications.date_created', 'like', '%'.$notificationSearch.'%')
    					->orWhere('notifications.date_modified', 'like', '%'.$notificationSearch.'%')
    					->Paginate(5);

            $notificationsCount = DB::table('notifications')
                        ->select('notifications.*')
                        ->where('notifications.message_id', 'like', '%'.$notificationSearch.'%')
                        ->orWhere('notifications.requestLogID', 'like', '%'.$notificationSearch.'%')
                        ->orWhere('notifications.senderid', 'like', '%'.$notificationSearch.'%')
                        ->orWhere('notifications.receiver', 'like', '%'.$notificationSearch.'%')
                        ->orWhere('notifications.message', 'like', '%'.$notificationSearch.'%')
                        ->orWhere('notifications.date_created', 'like', '%'.$notificationSearch.'%')
                        ->orWhere('notifications.date_modified', 'like', '%'.$notificationSearch.'%')
                        ->count();

            if(!$notificationsCount) {
                \Session::flash('error_message','No records found.');
            }           


    		return view('notifications.index', compact('notifications'));
    	}
    	

    }

     public function show()
    {
        return redirect('notifications');
    }
}
