<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationTemplates;
use DB;

class NotificationTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$statusCodes = DB::table('statusCodes')->get();

        $statusCodes = DB::table('statusCodes')->get();

        // get all clients from db
        $channelRefs = DB::table('client_channels_reference')->get();

        
        // get all message templates from db
        $notificationTemplates = DB::table('message_templates')
                ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'message_templates.channel_ref_id')
                ->join('statusCodes', 'statusCodes.code', '=', 'message_templates.status_code_id')
                ->select('message_templates.*', 'client_channels_reference.code', 'statusCodes.description')
                ->Paginate(6);

        return view('notifications_templates.index', compact('notificationTemplates','channelRefs','statusCodes'));
    }

    public function search(Request $request, $id) {
        // check if search request is empty
        if(empty($request->notificationTemplateSearch)) {

            return redirect('notifications_templates');

        } else {
            // get params from request
            $notificationTemplateSearch = $request->notificationTemplateSearch;

             $statusCodes = DB::table('statusCodes')->get();

            // get all clients from db
            $channelRefs = DB::table('client_channels_reference')->get();

            
            // get all message templates from db
            $notificationTemplates = DB::table('message_templates')
                    ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'message_templates.channel_ref_id')
                    ->join('statusCodes', 'statusCodes.code', '=', 'message_templates.status_code_id')
                    ->select('message_templates.*', 'client_channels_reference.code', 'statusCodes.description')
                    ->where('message_templates.template_id', '=', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.channel_ref_id', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.status_code_id', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.template', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.date_created', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.date_modified', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('statusCodes.description', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('client_channels_reference.code', 'like', '%'.$notificationTemplateSearch.'%')
                    ->Paginate(6);

            $notifications_templates_count = DB::table('message_templates')
                    ->join('client_channels_reference', 'client_channels_reference.channel_ref_id', '=', 'message_templates.channel_ref_id')
                    ->join('statusCodes', 'statusCodes.code', '=', 'message_templates.status_code_id')
                    ->select('message_templates.*', 'client_channels_reference.code', 'statusCodes.description')
                    ->where('message_templates.template_id', '=', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.channel_ref_id', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.status_code_id', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.template', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.date_created', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('message_templates.date_modified', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('statusCodes.description', 'like', '%'.$notificationTemplateSearch.'%')
                    ->orWhere('client_channels_reference.code', 'like', '%'.$notificationTemplateSearch.'%')
                    ->count();


            if(!$notifications_templates_count) {
                \Session::flash('error_message','No records found.');
            }  

            // return view with search results
            
            return view('notifications_templates.index', compact('notificationTemplates','channelRefs','statusCodes'));

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
        $notificationTemplate = new NotificationTemplates();
        
        // get params from post request
        $messageTemplate  = $request->messageTemplate;
        $messageChannelRef  = $request->messageChannelRef;
        $messageStatusCode  = $request->messageStatusCode;
        
        // call function from model to add messageTemplate to database
        $result = $notificationTemplate->addMessageTemplate($messageChannelRef, $messageStatusCode, $messageTemplate);

        if($result) {
             \Session::flash('flash_message','New message template created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('notifications_templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show()
    {
        return redirect('notifications_templates');
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
        $notificationTemplate = new NotificationTemplates();

        // get params from post request
        $template_id = $request->etemplate_id;
        $messageTemplate  = $request->emessageTemplate;
        $messageChannelRef  = $request->emessageChannelRef;
        $messageStatusCode  = $request->emessageStatusCode;
        

        // call function from model to update message template data
        $result =  $notificationTemplate->updateMessageTemplate($template_id, $messageChannelRef, $messageStatusCode, $messageTemplate);

        
        if($result) {
             \Session::flash('flash_message','Message template updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('notifications_templates');
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
        $notificationTemplates = new NotificationTemplates();

        // get params from post request ajax
        $template_id = $request->rtemplate_id;

        // call function from model to delete message template 
        $result = $notificationTemplates->deleteMessageTemplate($template_id);

        
        if($result) {
             \Session::flash('flash_message','Message template deleted successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after delete
        return redirect('notifications_templates');
    }
}
