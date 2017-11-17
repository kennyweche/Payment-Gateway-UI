<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Client;
use App\ClientChannel;
use App\ClientChannelReference;
use App\Users;

class ClientSetUpWizzardController extends Controller
{
    public function index() {

    	//$clients        = DB::table('clients')->get();
    	$clientChannels = DB::table('client_channels')->get();
    	$statusCodes = DB::table('statusCodes')
                    ->Where('code', '=', 136)
                    ->orWhere('code', '=', 137)
                    ->get();
        $userGroups = DB::table('user_groups')->get();

    	$channels   = DB::table('channel')->get();

        $clients = DB::table('clients')
                    ->join('statusCodes', 'statusCodes.code', '=', 'clients.status')
                    ->select('clients.*', 'statusCodes.description')
                    ->get();

    	return view('client_set_up_wizzard.index', compact('clients', 'clientChannels', 'statusCodes', 'channels', 'userGroups'));
    }

    public function addNewClient(Request $request) {
        // instantiate model class
        $client = new Client();
        
        // get params from post request
        $clientName = $request->clientName;
        $clientCode = $request->clientCode;
        $status     = $request->statusCode;

        // call function from model to add client to database
        $result = $client->addClient($clientName, $clientCode, $status);

        if($result) {
             \Session::flash('flash_message','New client created successfully, now create client channel.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

       return redirect('client_set_up_wizzard');
    }

    public function addNewClientChannel(Request $request) {   
        // instantiate model class
        $clientChannel = new ClientChannel();

        // get params from post request
        $clientID            = $request->client;
        $channelID           = $request->clientChannel;
        $client_channel_name = $request->clientChannelName;
        $status              = $request->clientChannelStatusCode;
        

        // call function from model to add client to database
        $result = $clientChannel->addClientChannel($clientID, $channelID, $client_channel_name, $status);

        if($result) {
             \Session::flash('flash_message','New client channel created successfully, now create client channel reference.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('client_set_up_wizzard');
    }

    public function addNewClientChannelReference(Request $request) {
        $clientID            = $request->ccrSource;
        $destinationClientID = $request->ccrDestination;
        $client_channelID    = $request->ccrclientChannelID;
        $code                = $request->ccrchannelCode;
        $queue_name          = $request->queue_name;
        $end_point           = $request->endpoint;
        $callback            = $request->callback;
        $senderid            = "";  //$request->senderid;
        $notifyCustomer      = "no"; //$request->notifyCustomer;
        $status              = $request->ccrStatusCode;


        // instantiate model class
        $clientChannelReference = new ClientChannelReference();

        $result = $clientChannelReference->addClientChannelReference($clientID, $destinationClientID, $client_channelID, $code, $queue_name, $end_point, $callback, $senderid, $notifyCustomer, $status);

        if($result) {
             \Session::flash('flash_message','New client channel reference created successfully, set up finished.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('client_set_up_wizzard');
    }

    public function addNewClientUser(Request $request) {
    	// instantiate model class
        $user = new Users();
        
        // get params from post request
        $username  = $request->username;
        $password  = $request->password;
        $userType  = $request->userType;
        $clientID  = $request->userClientID;
        $status    = $request->userStatusCode;
        $userGroup = $request->userGroup;

        // call function from model to add user to database
        $result = $user->addUser($username, $password, $userType, $clientID, $status, $userGroup);

        if($result) {
             \Session::flash('flash_message','New client user created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('client_set_up_wizzard');
    }

    public function show() {
    	
    	return redirect('client_set_up_wizzard');
   
    }
}
