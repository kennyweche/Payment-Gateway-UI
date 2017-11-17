<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class NotificationTemplates extends Model
{
    protected $table = 'message_templates';
    public $primaryKey  = 'template_id';

    // function to add message template
    public function addMessageTemplate($messageChannelRef, $messageStatusCode, $messageTemplate) {
    	$date_created = date('Y-m-d H:i:s');

    	$result = DB::insert('INSERT INTO message_templates(channel_ref_id, status_code_id, template, date_created) VALUES (?,?,?,?)', [$messageChannelRef, $messageStatusCode, $messageTemplate, $date_created]);

    	return $result;
    	
    }

    // function to update message template details
    public function updateMessageTemplate($template_id, $messageChannelRef, $messageStatusCode, $messageTemplate) {

    	$result = DB::table('message_templates')
		            ->where('template_id', $template_id)
		            ->update(['channel_ref_id' => $messageChannelRef, 'status_code_id' => $messageStatusCode, 'template' => $messageTemplate]);

    	return $result;
    	
    }

    // function to delete message template 
    public function deleteMessageTemplate($template_id) {

    	$result = DB::table('message_templates')
		            ->where('template_id', $template_id)
		            ->delete();

    	return $result;
    	
    }
}
