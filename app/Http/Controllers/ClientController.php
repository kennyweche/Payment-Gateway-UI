<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use DB;
 

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$statusCodes = DB::table('statusCodes')->get();

        $statusCodes = DB::table('statusCodes')
                    ->Where('code', '=', 136)
                    ->orWhere('code', '=', 137)
                    ->get();

        // $clients = DB::table('clients')->get();
        // get all clients from db with pagination
        $clients = DB::table('clients')
                    ->join('statusCodes', 'statusCodes.code', '=', 'clients.status')
                    ->select('clients.*', 'statusCodes.description')
                    ->Paginate(7);

        return view('clients.index', compact('clients','statusCodes'));

        //return view('clients.index', ['statusCodes' => $statusCodes]);

    }

    public function search(Request $request) {

        // check if search request is empty
        if(empty($request->clientSearch)) {

            return redirect('clients');

        } else {
            // get params from request
            $clientSearch = $request->clientSearch;

            // run query
            $clients = DB::table('clients')
                        ->join('statusCodes', 'statusCodes.code', '=', 'clients.status')
                        ->select('clients.*', 'statusCodes.description')
                        ->where('clientName', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clientID', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clientCode', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clients.date_created', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clients.date_modified', 'like', '%'.$clientSearch.'%')
                        ->orWhere('statusCodes.description', 'like', '%'.$clientSearch.'%')
                        ->Paginate(5);

            $clientsCount = DB::table('clients')
                        ->join('statusCodes', 'statusCodes.code', '=', 'clients.status')
                        ->select('clients.*', 'statusCodes.description')
                        ->where('clientName', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clientID', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clientCode', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clients.date_created', 'like', '%'.$clientSearch.'%')
                        ->orWhere('clients.date_modified', 'like', '%'.$clientSearch.'%')
                        ->orWhere('statusCodes.description', 'like', '%'.$clientSearch.'%')
                        ->count();

            if(!$clientsCount) {
                \Session::flash('error_message','No records found.');
            }

            // get status codes for drop down
            //$statusCodes = DB::table('statusCodes')->get();

            $statusCodes = DB::table('statusCodes')
                        ->Where('code', '=', 136)
                        ->orWhere('code', '=', 137)
                        ->get();



            // return view with search results
            return view('clients.index', compact('clients','statusCodes'));

            }

            // return view with search results
            return view('clients.index', compact('clients','statusCodes'));
    }      
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $client = new Client();
        
        // get params from post request
        $clientName = $request->clientName;
        $clientCode = $request->clientCode;
        $status     = $request->statusCode;

        // call function from model to add client to database
        $result = $client->addClient($clientName, $clientCode, $status);

        if($result) {
             \Session::flash('flash_message','New client created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show()
    {
        return redirect('clients');
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
        $client = new Client();

        // get params from post request ajax
        $clientID = $request->eclientID;
        $clientName = $request->eclientName;
        $clientCode = $request->eclientCode;
        $status = $request->eclientStatus;

        // call function from model to update client data
        $result = $client->updateClient($clientID, $clientName, $clientCode, $status);

        
        if($result) {
             \Session::flash('flash_message','Client details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('clients');
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
        $client = new Client();

        // get params from post request ajax
        $clientID = $request->rclientID;

        // call function from model to deactivate client 
        $result = $client->deactivateClient($clientID);

        
        if($result) {
             \Session::flash('flash_message','Client deactivated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('clients');
    }
}
