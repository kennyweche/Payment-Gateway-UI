<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ClientChannel;

class ClientChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get statusCodes for drop down
        //$statusCodes = DB::table('statusCodes')->get();
        $statusCodes = DB::table('statusCodes')
                    ->Where('code', '=', 136)
                    ->orWhere('code', '=', 137)
                    ->get();

        // get clients for drop down
        $clients = DB::table('clients')->get();

        // get channels for drop down
        $channels = DB::table('channel')->get();

        // get all clients from db with pagination
        $clientChannels = DB::table('client_channels')
            ->join('clients', 'clients.clientID', '=', 'client_channels.clientID')
            ->join('channel', 'channel.channelID', '=', 'client_channels.channelID')
            ->join('statusCodes', 'statusCodes.code', '=', 'client_channels.status')
            ->select('client_channels.*', 'channel.channelName', 'clients.clientName', 'statusCodes.description')
            ->Paginate(7);

        return view('client_channel.index', compact('clientChannels','statusCodes', 'clients', 'channels'));

        //return view('clients.index', ['statusCodes' => $statusCodes]);
    }

    public function search(Request $request) {

        // check if search request is empty

        if(empty($request->clientChannelSearch)) {

            return redirect('client_channel');

        } else {
            // get params from request
            $clientChannelSearch = $request->clientChannelSearch;

            // run query
            /*$clientChannels = ClientChannel::where('client_channel_name', 'like', '%'.$clientChannelSearch.'%')
                        ->orWhere('client_channelID', 'like', '%'.$clientChannelSearch.'%')
                        ->orWhere('clientCode', 'like', '%'.$clientChannelSearch.'%')
                        ->orWhere('date_created', 'like', '%'.$clientChannelSearch.'%')
                        ->orWhere('date_modified', 'like', '%'.$clientChannelSearch.'%')
                        ->Paginate(5);*/

            $clientChannels = DB::table('client_channels')
                ->join('clients', 'clients.clientID', '=', 'client_channels.clientID')
                ->join('channel', 'channel.channelID', '=', 'client_channels.channelID')
                ->join('statusCodes', 'statusCodes.code', '=', 'client_channels.status')
                ->select('client_channels.*', 'channel.channelName', 'clients.clientName', 'statusCodes.description')
                ->where('client_channels.client_channel_name', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('channel.channelName', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('clients.clientName', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('client_channels.date_created', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('client_channels.date_modified', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('statusCodes.description', 'like', '%'.$clientChannelSearch.'%')
                ->Paginate(7);

            $clientChannelsCount = DB::table('client_channels')
                ->join('clients', 'clients.clientID', '=', 'client_channels.clientID')
                ->join('channel', 'channel.channelID', '=', 'client_channels.channelID')
                ->join('statusCodes', 'statusCodes.code', '=', 'client_channels.status')
                ->select('client_channels.*', 'channel.channelName', 'clients.clientName', 'statusCodes.description')
                ->where('client_channels.client_channel_name', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('channel.channelName', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('clients.clientName', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('client_channels.date_created', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('client_channels.date_modified', 'like', '%'.$clientChannelSearch.'%')
                ->orWhere('statusCodes.description', 'like', '%'.$clientChannelSearch.'%')
                ->count();

            if(!$clientChannelsCount) {
                \Session::flash('error_message','No records found.');
            }

            // get status codes for drop down
            //$statusCodes = DB::table('statusCodes')->get();

            $statusCodes = DB::table('statusCodes')
                        ->Where('code', '=', 136)
                        ->orWhere('code', '=', 137)
                        ->get();
            // get clients for drop down
            $clients = DB::table('clients')->get();

            // get channels for drop down
            $channels = DB::table('channel')->get();

            if($clientChannels) {
                // return view with search results
                return view('client_channel.index', compact('clientChannels','statusCodes', 'clients', 'channels'));

            } else {

                $clientChannels = DB::table('client_channels')
                ->join('clients', 'clients.clientID', '=', 'client_channels.clientID')
                ->join('channel', 'channel.channelID', '=', 'client_channels.channelID')
                ->select('client_channels.*', 'channel.channelName', 'clients.clientName')
                ->Paginate(7);

                \Session::flash('error_message','No matching records found!.');
               
                // return view with search results
                return view('client_channel.index', compact('clientChannels','statusCodes', 'clients', 'channels'));
            }

            // return view with search results
            return view('client_channel.index', compact('clientChannels','statusCodes', 'clients', 'channels'));

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
             \Session::flash('flash_message','New client channel created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('client_channel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show()
    {
        return redirect('client_channel');
    }

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
        // instantiate model class
        $clientChannel = new ClientChannel();

        // get params from post request ajax
        $client_channelID = $request->eclient_channelID;
        $clientID = $request->eclient;
        $channelID = $request->cechannelID;
        $client_channel_name = $request->eclientChannelName;
        $status = $request->eclientChannelStatusCode;


         $result = $clientChannel->updateClientChannel($client_channelID, $clientID, $channelID, $client_channel_name, $status);

         if($result) {
             \Session::flash('flash_message','Client channel details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('client_channel');
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
        $clientChannel = new ClientChannel();

        // get params from post request ajax
        $client_channelID = $request->rclientChannelID;

        // call function from model to deactivate client channel 
        $result = $clientChannel->deactivateClientChannel($client_channelID);

        
        if($result) {
             \Session::flash('flash_message','Client deactivated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('client_channel');
    }
}
