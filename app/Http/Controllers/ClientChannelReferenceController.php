<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ClientChannelReference;

class ClientChannelReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $clientChannelReferences = DB::table('client_channels_reference')
                    ->join('clients','client_channels_reference.clientID', 'clients.clientID')
                    ->join('client_channels', 'client_channels_reference.client_channelID', 'client_channels.client_channelID')
                    ->join('statusCodes', 'client_channels_reference.status',  'statusCodes.code')
                    ->select('client_channels_reference.*', 'clients.clientName', 'client_channels.client_channel_name', 'statusCodes.description')
                    ->get();

        $statusCodes = DB::table('statusCodes')->get();

        // get client channels for drop down
        $clientChannels = DB::table('client_channels')->get();

        // get clients for drop down
        $clients = DB::table('clients')->get();

        // get channels for drop down
        $channels = DB::table('channel')->get();

        return view('client_channel_reference.index', compact('clientChannelReferences', 'clients', 'statusCodes', 'clientChannels', 'channels'));
    }

    public function search(Request $request) {

        if(empty($request->clientChannelReferenceSearch)) {
            return redirect('client_channel_reference');
        } else {

            $clientChannelReferenceSearch = $request->clientChannelReferenceSearch;

            $clientChannelReferences = DB::table('client_channels_reference')
                    ->join('clients','client_channels_reference.clientID', 'clients.clientID')
                    ->join('client_channels', 'client_channels_reference.client_channelID', 'client_channels.client_channelID')
                    ->join('statusCodes', 'client_channels_reference.status',  'statusCodes.code')
                    ->select('client_channels_reference.*', 'clients.clientName', 'client_channels.client_channel_name', 'statusCodes.description')
                    ->where('clients.clientName', 'like', '%'.$clientChannelReferenceSearch.'%')
                    ->get();

            $clientChannelReferencesCount = DB::table('client_channels_reference')
                    ->join('clients','client_channels_reference.clientID', 'clients.clientID')
                    ->join('client_channels', 'client_channels_reference.client_channelID', 'client_channels.client_channelID')
                    ->join('statusCodes', 'client_channels_reference.status',  'statusCodes.code')
                    ->select('client_channels_reference.*', 'clients.clientName', 'client_channels.client_channel_name', 'statusCodes.description')
                    ->where('clients.clientName', 'like', '%'.$clientChannelReferenceSearch.'%')
                    ->count();

            $statusCodes = DB::table('statusCodes')->get();

            // get clients for drop down
            $clients = DB::table('clients')->get();

            // get client channels for drop down
            $clientChannels = DB::table('client_channels')->get();

            // get channels for drop down
        	$channels = DB::table('channel')->get();

            return view('client_channel_reference.index', compact('clientChannelReferences', 'clients', 'statusCodes', 'clientChannels', 'channels'));

        }




        if(!$clientChannelReferencesCount) {
            \Session::flash('error_message','No records found.');
        } 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
             \Session::flash('flash_message','New client channel reference created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        return redirect('client_channel_reference');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$channelRefId        = $request->echannel_ref_id;
        $clientID            = $request->eccrSource;
        $destinationClientID = $request->eccrDestination;
        $client_channelID    = $request->eccrclientChannelID;
        $code                = $request->eccrchannelCode;
        $queue_name          = $request->equeue_name;
        $end_point           = $request->eendpoint;
        $callback            = $request->ecallback;
        $senderid            = "";  //$request->senderid;
        $notifyCustomer      = "no"; //$request->notifyCustomer;
        $status              = $request->eccrStatusCode;

        // instantiate model class
        $clientChannelReference = new ClientChannelReference();
    	
    	$result = $clientChannelReference->updateClientChannelReference($channelRefId, $clientID, $destinationClientID, $client_channelID, $code, $queue_name, $end_point, $callback, $senderid, $notifyCustomer, $status);

    	if($result) {
             \Session::flash('flash_message','Client channel reference details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('client_channel_reference');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
    {
        // instantiate model class
        $clientChannelReference = new ClientChannelReference();

        // get params from post request ajax
        $channelRefId = $request->rchannel_ref_id;

        // call function from model to deactivate clientChannelReference 
        $result = $clientChannelReference->deactivateClientChannelReference($channelRefId);

        
        if($result) {
             \Session::flash('flash_message','Client channel reference deactivated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('client_channel_reference');
    }

     public function show()
    {
        return redirect('client_channel_reference');
    }
}
