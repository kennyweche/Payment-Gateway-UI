<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Users;

class UsersController extends Controller
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

        // get all clients from db
        $clients = DB::table('clients')->get();

        // get all user groups from db
        $userGroups = DB::table('user_groups')->get();

        // get all users from db
        $users = DB::table('users')
                ->join('clients', 'clients.clientID', '=', 'users.clientID')
                ->join('statusCodes', 'statusCodes.code', '=', 'users.status')
                ->join('user_groups', 'user_groups.id', '=', 'users.userGroup')
                ->select('users.*', 'clients.clientName', 'user_groups.name', 'statusCodes.description')
                ->Paginate(6);

        return view('users.index', compact('users','clients','userGroups','statusCodes'));

        //return view('clients.index', ['statusCodes' => $statusCodes]);

    }

    public function search(Request $request) {

        // check if search request is empty
        if(empty($request->userSearch)) {

            return redirect('users');

        } else {
            // get params from request
            $userSearch = $request->userSearch;

            // run query
            $users = DB::table('users')
                        ->join('clients', 'clients.clientID', '=', 'users.clientID')
                        ->join('statusCodes', 'statusCodes.code', '=', 'users.status')
                        ->join('user_groups', 'user_groups.user_group_id', '=', 'users.user_group')
                        ->select('users.*', 'statusCodes.description', 'clients.clientName')
                        ->where('users.username', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.userID', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.userGroup', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.userType', 'like', '%'.$userSearch.'%')
                        ->orWhere('clientCode', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.date_created', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.date_modified', 'like', '%'.$userSearch.'%')
                        ->orWhere('statusCodes.description', 'like', '%'.$userSearch.'%')
                        ->orWhere('user_groups.userType', 'like', '%'.$userSearch.'%')
                        ->orWhere('clients.clientName', 'like', '%'.$userSearch.'%')
                        ->Paginate(5);

            $usersCount = DB::table('users')
                        ->join('clients', 'clients.clientID', '=', 'users.clientID')
                        ->join('statusCodes', 'statusCodes.code', '=', 'users.status')
                        ->join('user_groups', 'user_groups.user_group_id', '=', 'users.user_group')
                        ->select('users.*', 'statusCodes.description', 'clients.clientName', 'user_groups.userType')
                        ->where('users.username', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.userID', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.userGroup', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.userType', 'like', '%'.$userSearch.'%')
                        ->orWhere('clientCode', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.date_created', 'like', '%'.$userSearch.'%')
                        ->orWhere('users.date_modified', 'like', '%'.$userSearch.'%')
                        ->orWhere('statusCodes.description', 'like', '%'.$userSearch.'%')
                        ->orWhere('user_groups.userType', 'like', '%'.$userSearch.'%')
                        ->orWhere('clients.clientName', 'like', '%'.$userSearch.'%')
                        ->count();

            // get status codes for drop down
            //$statusCodes = DB::table('statusCodes')->get();

            $statusCodes = DB::table('statusCodes')
                        ->Where('code', '=', 136)
                        ->orWhere('code', '=', 137)
                        ->get();

            // get all clients from db
            $clients = DB::table('clients')->get();

            // get all user groups from db
            $userGroups = DB::table('user_groups')->get();


            if(!$usersCount) {
                \Session::flash('error_message','No records found.');
            }  

            // return view with search results
            return view('users.index', compact('users','clients','userGroups','statusCodes'));

        }      
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
             \Session::flash('flash_message','New user created successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show()
    {
        return redirect('users');
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
        $user = new Users();

        // get params from post request
        $userID    = $request->euserID;
        $username  = $request->eusername;
        $userType  = $request->euserType;
        $clientID  = $request->euserClientID;
        $status    = $request->euserStatusCode;
        $userGroup = $request->euserGroup;

        // call function from model to update user data
        $result =  $user->updateUser($userID, $username, $userType, $clientID, $status, $userGroup);

        
        if($result) {
             \Session::flash('flash_message','User details updated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('users');
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
        $user = new Users();

        // get params from post request ajax
        $userID = $request->ruserID;

        // call function from model to deactivate user 
        $result = $user->deactivateUser($userID);

        
        if($result) {
             \Session::flash('flash_message','User deactivated successfully.');
        } else {
             \Session::flash('error_message','Error in handling request.');
        }

        // redirect to index after save
        return redirect('users');
    }
}
