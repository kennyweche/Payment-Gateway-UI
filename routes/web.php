<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes with permissions //


Route::get('', function() {
	return view('home');
});

Route::get('/home', function() {
	return view('home');
});

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');


Route::post('/login_user', 'LoginController@login');

Auth::routes();


Route::group(['middleware' => ['auth']], function () {


	// Auth routes
    Route::get('/logout', 'Auth\LoginController@logout');



    // System Routes
    // perm:permission_id

    Route::group(['middleware' => 'perm:2'], function() {
		Route::resource('/dashboard', 'DashboardController');
		Route::post('/dashboard/search', 'DashboardController@search');
	});

	Route::group(['middleware' => 'perm:4'], function() {
		Route::resource('client_set_up_wizzard', 'ClientSetUpWizzardController');
		Route::post('/client_set_up_wizzard/client', 'ClientSetUpWizzardController@addNewClient');
		Route::post('/client_set_up_wizzard/client_channel', 'ClientSetUpWizzardController@addNewClientChannel');
		Route::post('/client_set_up_wizzard/client_channel_reference', 'ClientSetUpWizzardController@addNewClientChannelReference');
		Route::post('/client_set_up_wizzard/add_client_users', 'ClientSetUpWizzardController@addNewClientUser');

	});

	Route::group(['middleware' => 'perm:4'], function() {
		Route::resource('clients', 'ClientController');
		Route::post('/clients/search', 'ClientController@search');
		Route::get('/clients/search', 'ClientController@index');
	});

	Route::group(['middleware' => 'perm:4'], function() {
		Route::resource('client_channel', 'ClientChannelController');
		Route::post('/client_channel/search', 'ClientChannelController@search');
		Route::get('/client_channel/search', 'ClientChannelController@index');
	});

	Route::group(['middleware' => 'perm:5'], function() {
		Route::resource('status_codes', 'StatusCodesController');
		Route::post('/status_codes/search', 'StatusCodesController@search');
		Route::get('/status_codes/search', 'StatusCodesController@index');
	});

	Route::group(['middleware' => 'perm:4'], function() {
		Route::resource('channels', 'ChannelController');
		Route::post('/channels/search', 'ChannelController@search');
		Route::get('/channels/search', 'ChannelController@index');
	});

	Route::group(['middleware' => 'perm:1'], function() {
		Route::resource('channel_rules', 'ChannelRulesController');
		Route::post('/channel_rules/search', 'ChannelRulesController@search');
		Route::get('/channel_rules/search', 'ChannelRulesController@index');
	});

	Route::group(['middleware' => 'perm:6'], function() {
		Route::resource('users', 'UsersController');
		Route::post('/users/search', 'UsersController@search');
		Route::get('/users/search', 'UsersController@index');
	});

	Route::group(['middleware' => 'perm:6'], function() {
		Route::resource('user_management', 'UserManagementController');
		Route::post('/user_management/search', 'UserManagementController@search');
		Route::get('/user_management/search', 'UserManagementController@index');
		Route::post('/user_management/add_user', 'UserManagementController@addUsers');
		Route::post('/user_management/add_user_to_group', 'UserManagementController@addUserToGroup');
		Route::post('/user_management/deactivate_user', 'UserManagementController@deactivateUsers');
		Route::post('/user_management/activate_user', 'UserManagementController@activateUser');
		Route::post('/user_management/attach_permissions', 'UserManagementController@attachPermissions');
		Route::post('/user_management/add_group', 'UserManagementController@addGroup');
		Route::post('/user_management/add_permission', 'UserManagementController@addPermission');
		Route::post('/user_management/edit_user', 'UserManagementController@editUser');
		Route::post('/user_management/edit_group', 'UserManagementController@editGroup');
		Route::post('/user_management/edit_permission', 'UserManagementController@editPermission');
		Route::post('/user_management/remove_group', 'UserManagementController@removeGroup');
		Route::post('/user_management/remove_permission', 'UserManagementController@removePermission');
		Route::post('/user_management/change_password', 'UserManagementController@changePassword');
		Route::get('group/{id}', ['as' => 'group.show' , 'uses' => 'UserManagementController@show']);
	});

	Route::group(['middleware' => 'perm:1'], function() {
		Route::resource('payments', 'PaymentsController');
		Route::post('/payments/search', 'PaymentsController@paymentSearch');
		Route::get('/payments/search', 'PaymentsController@index');
	});

	Route::group(['middleware' => 'perm:3'], function() {
		Route::resource('reports', 'ReportsController');
		Route::post('/reports/search', 'ReportsController@search');
		Route::get('/reports/search', 'ReportsController@index');
		Route::post('/reports/generate-report', 'ReportsController@exportPDF');
	});

	Route::group(['middleware' => 'perm:7,8'], function() {
		Route::resource('notifications', 'NotificationsController');
		Route::post('/notifications/search', 'NotificationsController@search');
		Route::get('/notifications/search', 'NotificationsController@index');
	});

	Route::group(['middleware' => 'perm:1'], function() {
		Route::resource('dashboard', 'DashboardController');
		Route::post('/dashboard/search', 'DashboardController@search');
		Route::get('/dashboard/search', 'DashboardController@index');
	});

	Route::group(['middleware' => 'perm:7,8'], function() {
		Route::resource('notifications_templates', 'NotificationTemplatesController');
		Route::post('/notifications_templates/search', 'NotificationTemplatesController@search');
		Route::get('/notifications_templates/search', 'NotificationTemplatesController@index');
	});

	Route::group(['middleware' => 'perm:1'], function() {
		Route::resource('client_channel_reference', 'ClientChannelReferenceController');
		Route::post('/client_channel_reference/search', 'ClientChannelReferenceController@search');
	});
});


