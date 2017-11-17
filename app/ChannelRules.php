<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChannelRules extends Model
{
    protected $table = 'channel_rules';
    public $primaryKey  = 'channel_rules_id';

    // function to add new channel rule
    public function addChannelRule($rule_name, $rules_endpoint, $client_channelID) {

    	$date_created = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO channel_rules(rule_name, rules_endpoint, client_channelID, date_created) VALUES (?,?,?,?)', [$rule_name, $rules_endpoint, $client_channelID, $date_created]);

    	return $result;
    }

    // function to update channel rule
    public function updateChannelRule($channel_rules_id, $rule_name, $rules_endpoint, $client_channelID) {

    	$result = DB::table('channel_rules')
		            ->where('channel_rules_id', $channel_rules_id)
		            ->update(['rule_name' => $rule_name, 'rules_endpoint' => $rules_endpoint, 'client_channelID' => $client_channelID]);

    	return $result;
    	
    }

    // function to delete channel rule
    public function deleteChannelRule($channel_rules_id) {

    	$result = DB::table('channel_rules')
		            ->where('channel_rules_id', $channel_rules_id)
		            ->delete();

    	return $result;
    	
    }
}
