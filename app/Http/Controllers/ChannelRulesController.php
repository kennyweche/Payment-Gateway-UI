<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ChannelRules;

class ChannelRulesController extends Controller
{
    public function index() {

    	$clientChannels = DB::table('client_channels')->get();

    	$channelRules   = DB::table('channel_rules')
	    					->join('client_channels', 'client_channels.client_channelID', '=', 'channel_rules.client_channelID')
	    					->select('channel_rules.*', 'client_channels.client_channel_name')
	    					->Paginate(7);

    	return view('channel_rules.index', compact('channelRules', 'clientChannels'));
    }

    public function search(Request $request) {

    	if(empty($request->channelRulesSearch)) {
    		return redirect('channel_rules');
    	} else {

    		$channelRulesSearch = $request->channelRulesSearch;

    		$channelRules = DB::table('channel_rules')
    						->join('client_channels', 'client_channels.client_channelID', '=', 'channel_rules.client_channelID' )
    						->select('channel_rules.*', 'client_channels.client_channel_name')
	    					->where('channel_rules.channel_rules_id', 'like', '%'.$channelRulesSearch.'%')
	    					->orWhere('channel_rules.rule_name', 'like', '%'.$channelRulesSearch.'%')
							->orWhere('channel_rules.rules_endpoint', 'like', '%'.$channelRulesSearch.'%')
							->orWhere('channel_rules.client_channelID', 'like', '%'.$channelRulesSearch.'%')
							->orWhere('channel_rules.date_created', 'like', '%'.$channelRulesSearch.'%')
							->orWhere('channel_rules.date_modified', 'like', '%'.$channelRulesSearch.'%')	
							->orWhere('client_channels.client_channel_name', 'like', '%'.$channelRulesSearch.'%')
	    					->Paginate(7);

            $channelRulesCount = DB::table('channel_rules')
                            ->join('client_channels', 'client_channels.client_channelID', '=', 'channel_rules.client_channelID' )
                            ->select('channel_rules.*', 'client_channels.client_channel_name')
                            ->where('channel_rules.channel_rules_id', 'like', '%'.$channelRulesSearch.'%')
                            ->orWhere('channel_rules.rule_name', 'like', '%'.$channelRulesSearch.'%')
                            ->orWhere('channel_rules.rules_endpoint', 'like', '%'.$channelRulesSearch.'%')
                            ->orWhere('channel_rules.client_channelID', 'like', '%'.$channelRulesSearch.'%')
                            ->orWhere('channel_rules.date_created', 'like', '%'.$channelRulesSearch.'%')
                            ->orWhere('channel_rules.date_modified', 'like', '%'.$channelRulesSearch.'%')   
                            ->orWhere('client_channels.client_channel_name', 'like', '%'.$channelRulesSearch.'%')
                            ->count();

            if(!$channelRulesCount) {
                \Session::flash('error_message','No records found.');
            }

	    	// get client channels for dropdown
	    	$clientChannels = DB::table('client_channels')->get();

	    	return view('channel_rules.index', compact('channelRules', 'clientChannels'));

    	}
    }

    public function store(Request $request) {

    	// instantiate model class
    	$channelRules = new ChannelRules();

    	$rule_name = $request->ruleName;
    	$rules_endpoint = $request->rulesEndpoint;
    	$client_channelID = $request->clientChannelID;
    	
    	// call function in model to save channel rule to database
    	$result = $channelRules->addChannelRule($rule_name, $rules_endpoint, $client_channelID);

    	if($result) {
             \Session::flash('flash_message','New channel rule created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect back to index after save
        return redirect('channel_rules');
    }

    public function update(Request $request, $id) {

    	// instantiate model class
    	$channelRules = new ChannelRules();

    	$channel_rules_id = $request->echannelRulesID;
    	$rule_name        = $request->eruleName;
    	$rules_endpoint   = $request->erulesEndpoint;
    	$client_channelID = $request->eclientChannelID;
    	
    	// call function in model to save channel rule to database
    	$result = $channelRules->updateChannelRule($channel_rules_id, $rule_name, $rules_endpoint, $client_channelID);

    	if($result) {
             \Session::flash('flash_message','Channel rule updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect back to index after save
        return redirect('channel_rules');

    }

     public function show()
    {
        return redirect('channel_rules');
    }

    public function destroy(Request $request, $id)
    {
        // instantiate model class
        $channelRule = new ChannelRules();

        // get params from post request ajax
        $channel_rules_id = $request->rchannelRulesID;

        // call function from model to delete channel rule
        $result = $channelRule->deleteChannelRule($channel_rules_id);

        
        if($result) {
             \Session::flash('flash_message','Channel rule deleted successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('channel_rules');
    }
}
