<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;
use App\StatusCodes;

class StatusCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusCodes = DB::table('statusCodes')->Paginate(6);

        return view('status_codes.index', compact('statusCodes'));
    }


    public function search(Request $request) {

        // check if search request is empty
        if(empty($request->statusCodeSearch)) {

            return redirect('status_codes');

        } else {
            // get params from request
            $statusCodeSearch = $request->statusCodeSearch;

            // run query
            $statusCodes = StatusCodes::where('code', 'like', '%'.$statusCodeSearch.'%')
                        ->orWhere('description', 'like', '%'.$statusCodeSearch.'%')
                        ->orWhere('statusCodeID', 'like', '%'.$statusCodeSearch.'%')
                        ->Paginate(5);

            $statusCodesCount = StatusCodes::where('code', 'like', '%'.$statusCodeSearch.'%')
                        ->orWhere('description', 'like', '%'.$statusCodeSearch.'%')
                        ->orWhere('statusCodeID', 'like', '%'.$statusCodeSearch.'%')
                        ->count();

            if(!$statusCodesCount) {
                \Session::flash('error_message','No records found.');
            }  
        
            return view('status_codes.index', compact('statusCodes'));
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
        $statusCodes = new StatusCodes();
        
        // get params from post request
        $code = $request->code;
        $description = $request->description;

        // call function from model to add statusCodes to database
        $result = $statusCodes->addStatusCode($code, $description);

        if($result) {
             \Session::flash('flash_message','New Status Code created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('status_codes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show()
    {
        return redirect('status_codes');
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
        $statusCodes = new StatusCodes();

        // get params from post request ajax
        $estatusCodeID = $request->estatusCodeID;
        $ecode = $request->ecode;
        $edescription = $request->edescription;

        // call function from model to update statusCodes data
        $result = $statusCodes->updateStatusCode($estatusCodeID, $ecode, $edescription);

        
        if($result) {
             \Session::flash('flash_message','Status code updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('status_codes');
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
        $statusCodes = new StatusCodes();

        // get params from post request ajax
        $statusCodeID = $request->rstatusCodeID;

        // call function from model to deactivate statusCodes 
        $result = $statusCodes->deleteStatusCode($statusCodeID);

        
        if($result) {
             \Session::flash('flash_message','Status code removed successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('status_codes');
    }
}
