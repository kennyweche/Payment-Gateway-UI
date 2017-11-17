<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Channel;

class ChannelController extends Controller
{

    public function index()
    {
        //$statusCodes = DB::table('statusCodes')->get();
        $statusCodes = DB::table('statusCodes')
                    ->Where('code', '=', 136)
                    ->orWhere('code', '=', 137)
                    ->get();

        // get all channels from db with pagination
        $channels = DB::table('channel')
        			->join('statusCodes', 'statusCodes.code', '=', 'channel.status')
        			->select('channel.*', 'statusCodes.description')
        			->Paginate(7);

        return view('channels.index', compact('channels', 'statusCodes'));

    }
    
    public function search(Request $request) {

    	if(empty($request->channelsSearch)) {
    		return redirect('channels');
    	} else {
    		 // get params from request
        	$channelsSearch = $request->channelsSearch;

	        // run query
	        $channels = DB::table('channel')
	        			->join('statusCodes', 'statusCodes.code', '=', 'channel.status')
	        			->select('channel.*', 'statusCodes.description')
	        			->where('channelName', 'like', '%'.$channelsSearch.'%')
	                    ->orWhere('status', 'like', '%'.$channelsSearch.'%')
	                    ->orWhere('channelID', 'like', '%'.$channelsSearch.'%')
	                    ->orWhere('channelCode', 'like', '%'.$channelsSearch.'%') 
	                    ->orWhere('channel.date_created', 'like', '%'.$channelsSearch.'%')
	                    ->orWhere('channel.date_modified', 'like', '%'.$channelsSearch.'%')
	                    ->orWhere('statusCodes.description', 'like', '%'.$channelsSearch.'%')
	                    ->Paginate(5);

            $channelsCount = DB::table('channel')
                        ->join('statusCodes', 'statusCodes.code', '=', 'channel.status')
                        ->select('channel.*', 'statusCodes.description')
                        ->where('channelName', 'like', '%'.$channelsSearch.'%')
                        ->orWhere('status', 'like', '%'.$channelsSearch.'%')
                        ->orWhere('channelID', 'like', '%'.$channelsSearch.'%')
                        ->orWhere('channelCode', 'like', '%'.$channelsSearch.'%') 
                        ->orWhere('channel.date_created', 'like', '%'.$channelsSearch.'%')
                        ->orWhere('channel.date_modified', 'like', '%'.$channelsSearch.'%')
                        ->orWhere('statusCodes.description', 'like', '%'.$channelsSearch.'%')
                        ->count();
            if(!$channelsCount) {
                \Session::flash('error_message','No records found.');
            }

	        //$statusCodes = DB::table('statusCodes')->get();
	        $statusCodes = DB::table('statusCodes')
	                    ->Where('code', '=', 136)
	                    ->orWhere('code', '=', 137)
	                    ->get();

	        // return view with search results
	        return view('channels.index', compact('channels', 'statusCodes'));
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
        $channel = new Channel();
        
        // get params from post request
        $channelName = $request->channelName;
        $channelCode = $request->channelCode;
        $status      = $request->channelStatusCode;

        // call function from model to save data
        $result = $channel->addChannel($channelName, $status, $channelCode);

        if($result) {
             \Session::flash('flash_message','New channel created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('channels');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect('channels');
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
    
        $channel = new Channel();

        $channelID   = $request->echannelID;
        $channelName = $request->echannelName;
        $status      = $request->echannelStatusCode;
        $channelCode = $request->echannelCode;

        $result = $channel->updateChannel($channelID, $channelName, $status, $channelCode);

        if($result) {
             \Session::flash('flash_message','Channel updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('channels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $channel = new Channel();

        $channelID = $request->rchannelID;

        $result = $channel->deactivateChannel($channelID);

        if($result) {
             \Session::flash('flash_message','Channel deactivated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('channels');

    }
}