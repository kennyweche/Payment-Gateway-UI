$(document).ready(function () {

	// Collapsible menu tree
    $('a.tree-toggler').click(function () {
        $(this).parent().children('ul.tree').toggle(300);
        $(".drop-down").removeClass("fa fa-chevron-down");
        $(".drop-down").addClass("fa fa-chevron-left");
    });

    // fade out flash message
    setTimeout(function() {
    	$('#successMessage').fadeOut('fast');
    	$('#errorMessage').fadeOut('fast');
    }, 3000);

    //===================================================================================//
    							//	Sidebar and Content Heights  // 
    //===================================================================================//
    // placing objects inside variables
	var content = $('.content');
	var sidebar = $('.sidebar');

	// get content and sidebar height in variables
	var getContentHeight = content.outerHeight();
	var getSidebarHeight = sidebar.outerHeight();

	// check if content height is bigger than sidebar
	if ( getContentHeight > getSidebarHeight ) {
		sidebar.css('min-height', getContentHeight);
	}

	// check if sidebar height is bigger than content
	if ( getSidebarHeight > getContentHeight ) {
		content.css('min-height', getSidebarHeight);
	}


	//===================================================================================//
    							//	User Management  // 
    //===================================================================================//
	
    // add user to group form validation
    $("#addToGroupForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var userID       = $("#userID").val();
		var userClientID = $("#userClientID").val();
		var userGroupID  = $("#userGroupID").val();

		if(userID == "") {
			$("#userID").after('<p class="text-danger">Please Choose User.</p>');
			$("#userID").closest('.form-group').addClass('has-error');
		} else {
			$("#userID").find('.text-danger').remove();
			$("#userID").closest('.form-group').addClass('has-success');
		}
		

		if(userClientID == "") {
			$("#userClientID").after('<p class="text-danger">Please Choose Client.</p>');
			$("#userClientID").closest('.form-group').addClass('has-error');
		} else {
			$("#userClientID").find('.text-danger').remove();
			$("#userClientID").closest('.form-group').addClass('has-success');
		}

		if(userGroupID == "") {
			$("#userGroupID").after('<p class="text-danger">Please Choose Group.</p>');
			$("#userGroupID").closest('.form-group').addClass('has-error');
		} else {
			$("#userGroupID").find('.text-danger').remove();
			$("#userGroupID").closest('.form-group').addClass('has-success');
		}

		if(userID && userClientID && userGroupID) {
			return true;
		} else {
			return false;
		}
	});// end of submit add user to group form


    // add group form validation
    $("#addGroupForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var groupName        = $("#groupName").val();
		var groupDescription = $("#groupDescription").val();

		if(groupName == "") {
			$("#groupName").after('<p class="text-danger">Please Provide Group Name.</p>');
			$("#groupName").closest('.form-group').addClass('has-error');
		} else {
			$("#groupName").find('.text-danger').remove();
			$("#groupName").closest('.form-group').addClass('has-success');
		}
		

		if(groupDescription == "") {
			$("#groupDescription").after('<p class="text-danger">Please Provide Group Description.</p>');
			$("#groupDescription").closest('.form-group').addClass('has-error');
		} else {
			$("#groupDescription").find('.text-danger').remove();
			$("#groupDescription").closest('.form-group').addClass('has-success');
		}


		if(groupName && groupDescription) {
			return true;
		} else {
			return false;
		}
	});// end of submit add group form

	// add permission form validation
    $("#addPermissionForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var permName         = $("#permName").val();
		var permDescription = $("#permDescription").val();

		if(permName == "") {
			$("#permName").after('<p class="text-danger">Please Provide Permission Name.</p>');
			$("#permName").closest('.form-group').addClass('has-error');
		} else {
			$("#permName").find('.text-danger').remove();
			$("#permName").closest('.form-group').addClass('has-success');
		}
		

		if(permDescription == "") {
			$("#permDescription").after('<p class="text-danger">Please Provide Permission Description.</p>');
			$("#permDescription").closest('.form-group').addClass('has-error');
		} else {
			$("#permDescription").find('.text-danger').remove();
			$("#permDescription").closest('.form-group').addClass('has-success');
		}


		if(permName && permDescription) {
			return true;
		} else {
			return false;
		}
	});// end of submit add permission form


    // add user form validation
    $("#addUserForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var username   = $("#username").val();
		var email   = $("#email").val();
		var userType   = $("#userType").val();
		var userGroupID  = $("#userGroupID").val();
		var userClientID = $("#userClientID").val();
		var userStatusCode = $("#userStatusCode").val();
		
		if(username == "") {
			$("#username").after('<p class="text-danger">Please Provide Username.</p>');
			$("#username").closest('.form-group').addClass('has-error');
		} else {
			$("#username").find('.text-danger').remove();
			$("#username").closest('.form-group').addClass('has-success');
		}
		

		if(email == "") {
			$("#email").after('<p class="text-danger">Please Provive Email.</p>');
			$("#email").closest('.form-group').addClass('has-error');
		} else {
			$("#email").find('.text-danger').remove();
			$("#email").closest('.form-group').addClass('has-success');
		}

		if(userType == "") {
			$("#userType").after('<p class="text-danger">Please Provide User Type.</p>');
			$("#userType").closest('.form-group').addClass('has-error');
		} else {
			$("#userType").find('.text-danger').remove();
			$("#userType").closest('.form-group').addClass('has-success');
		}

		if(userGroupID == "") {
			$("#userGroupID").after('<p class="text-danger">Please Provide User Group.</p>');
			$("#userGroupID").closest('.form-group').addClass('has-error');
		} else {
			$("#userGroupID").find('.text-danger').remove();
			$("#userGroupID").closest('.form-group').addClass('has-success');
		}

		if(userClientID == "") {
			$("#userClientID").after('<p class="text-danger">Please Provide User Client ID.</p>');
			$("#userClientID").closest('.form-group').addClass('has-error');
		} else {
			$("#userClientID").find('.text-danger').remove();
			$("#userClientID").closest('.form-group').addClass('has-success');
		}

		if(userStatusCode == "") {
			$("#userStatusCode").after('<p class="text-danger">Please Provide User Status Code.</p>');
			$("#userStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#userStatusCode").find('.text-danger').remove();
			$("#userStatusCode").closest('.form-group').addClass('has-success');
		}

	
		if(username && password && userType && userGroupID && userClientID && userStatusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit add user form

    	//===================================================================================//
    							//	Edits User Management  // 
   		//===================================================================================//

    // onclick edit user button
	$('.edit-user').click(function(){
        
        // get params on btn edit user click and populate fields on modal
        var userID = $(this).closest('tr').children('td.userID').text();
        $('#euserID').val(userID);
        
        var userName = $(this).closest('tr').children('td.username').text();
        $('#eusername').val(userName);

        var email = $(this).closest('tr').children('td.email').text();
        $('#eemail').val(email);

        var userType = $(this).closest('tr').children('td.userType').text();
        $('#euserType').val(userType);

        var userGroupID = $(this).closest('tr').children('input.userGroupID').val();
        $('#euserGroupID').val(userGroupID);

        var userClientID = $(this).closest('tr').children('input.userClientID').val();
        $('#euserClientID').val(userClientID);

        var userStatusCodeID = $(this).closest('tr').children('input.userStatusCodeID').val();
        $('#euserStatusCodeID').val(userStatusCodeID);
       
        //$("#editUserModal").find("form").attr("action",'/user_management/edit_user' + userID);

    });

    $('.edit-group').click(function(){
        
        // get params on btn edit group click and populate fields on modal
        var groupID = $(this).closest('tr').children('td.groupID').text();
        $('#egroupID').val(groupID);
        
        var groupName = $(this).closest('tr').children('td.groupName').text();
        $('#egroupName').val(groupName);

        var groupDescription = $(this).closest('tr').children('td.groupDescription').text();
        $('#egroupDescription').val(groupDescription);       

       
        //$("#editGroupModal").find("form").attr("action",'/user_management/edit_group' + groupID);

    });

    $('.edit-permission').click(function(){
        
        // get params on btn edit group click and populate fields on modal
        var permissionID = $(this).closest('tr').children('td.permissionID').text();
        $('#epermissionID').val(permissionID);
        
        var permName = $(this).closest('tr').children('td.permName').text();
        $('#epermName').val(permName);

        var permDescription = $(this).closest('tr').children('td.permDescription').text();
        $('#epermDescription').val(permDescription);       

       
        //$("#editPermissionModal").find("form").attr("action",'/user_management/edit_permission' + permissionID);

    });

	// onclick deactivate user button
	$('.deactivate-users').click(function(){
        
        // get params on btn deactivate user click and populate fields on modal
        var ruserID = $(this).closest('tr').children('td.userID').text();
        $('#rusersID').val(ruserID);

        //$("#deactivateUsersModal").find("form").attr("action",'/user_management/' + ruserID);

    });

     // onclick edit add to group button
	$('.add-to-group').click(function(){
        
        // get params on btn add user to group client click and populate fields on modal
        var userID = $(this).closest('tr').children('td.userID').text();
        $('#userID').val(userID);
        
        //$("#addToGroupModal").find("form").attr("action",'/user_management/' + userID);

    });

	// onclick activate user button
	$('.activate-users').click(function(){
        
        // get params on btn activate user click and populate fields on modal
        var auserID = $(this).closest('tr').children('td.userID').text();
        $('#auserID').val(auserID);

        //$("#activateUsersModal").find("form").attr("action",'/user_management/activate/' + auserID);

    });


    // onclick add | remove permissions button
	$('.attach-permissions').click(function(){
        
        // get params on btn attach permissions user click and populate fields on modal
        var agroupID = $(this).closest('tr').children('td.groupID').text();
        $('#agroupID').val(agroupID);

        //$("#attachPermissionsModal").find("form").attr("action",'/user_management/attach_permissions/' + agroupID);

    });

	// onclick add | remove permissions button on show group detail
	$('.attach-group-permissions').click(function(){
        
        // get params on btn attach permissions user click and populate fields on modal
        var agroupID = $("#attgroupID").val();
        $('#atgroupID').val(agroupID);

        //$("#attachPermissionsModal").find("form").attr("action",'/user_management/attach_permissions/' + agroupID);

    });



    // onclick remove permission button
	$('.remove-permission').click(function(){
        
        // get params on btn remove permission click and populate fields on modal
        var rpermissionID = $(this).closest('tr').children('td.permissionID').text();
        $('#rpermissionID').val(rpermissionID);

        //$("#removePermissionModal").find("form").attr("action",'/user_management/remove_permission/' + rpermissionID);

    });

    // onclick remove group button
	$('.remove-group').click(function(){
        
        // get params on btn remove group click and populate fields on modal
        var rgroupID = $(this).closest('tr').children('td.groupID').text();
        $('#rgroupID').val(rgroupID);

        //$("#removePermissionModal").find("form").attr("action",'/user_management/remove_group/' + rgroupID);

    });

     // edit user form validation
    $("#editUserForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var username     = $("#eusername").val();
		var userType     = $("#euserType").val();
		var userGroupID  = $("#euserGroupID").val();
		var userClientID = $("#euserClientID").val();
		var userStatusCode = $("#euserStatusCode").val();
		
		if(username == "") {
			$("#eusername").after('<p class="text-danger">Please Provide Username.</p>');
			$("#eusername").closest('.form-group').addClass('has-error');
		} else {
			$("#eusername").find('.text-danger').remove();
			$("#eusername").closest('.form-group').addClass('has-success');
		}
		

		if(password == "") {
			$("#epassword").after('<p class="text-danger">Please Provive Password.</p>');
			$("#epassword").closest('.form-group').addClass('has-error');
		} else {
			$("#epassword").find('.text-danger').remove();
			$("#epassword").closest('.form-group').addClass('has-success');
		}

		if(userType == "") {
			$("#euserType").after('<p class="text-danger">Please Provide User Type.</p>');
			$("#euserType").closest('.form-group').addClass('has-error');
		} else {
			$("#euserType").find('.text-danger').remove();
			$("#euserType").closest('.form-group').addClass('has-success');
		}

		if(userGroupID == "") {
			$("#euserGroupID").after('<p class="text-danger">Please Provide User Group.</p>');
			$("#euserGroupID").closest('.form-group').addClass('has-error');
		} else {
			$("#euserGroupID").find('.text-danger').remove();
			$("#euserGroupID").closest('.form-group').addClass('has-success');
		}

		if(userClientID == "") {
			$("#euserClientID").after('<p class="text-danger">Please Provide User Client ID.</p>');
			$("#euserClientID").closest('.form-group').addClass('has-error');
		} else {
			$("#euserClientID").find('.text-danger').remove();
			$("#euserClientID").closest('.form-group').addClass('has-success');
		}

		if(userStatusCode == "") {
			$("#euserStatusCode").after('<p class="text-danger">Please Provide User Status Code.</p>');
			$("#euserStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#euserStatusCode").find('.text-danger').remove();
			$("#euserStatusCode").closest('.form-group').addClass('has-success');
		}

	
		if(username && userType && userGroupID && userClientID && userStatusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit user form

	// edit group form validation
    $("#editGroupForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var groupName        = $("#egroupName").val();
		var groupDescription = $("#egroupDescription").val();
		
		
		if(groupName == "") {
			$("#egroupName").after('<p class="text-danger">Please Provide Group queueName.</p>');
			$("#egroupName").closest('.form-group').addClass('has-error');
		} else {
			$("#egroupName").find('.text-danger').remove();
			$("#egroupName").closest('.form-group').addClass('has-success');
		}
		

		if(groupDescription == "") {
			$("#egroupDescription").after('<p class="text-danger">Please Provive Group Description.</p>');
			$("#egroupDescription").closest('.form-group').addClass('has-error');
		} else {
			$("#egroupDescription").find('.text-danger').remove();
			$("#egroupDescription").closest('.form-group').addClass('has-success');
		}

		if(groupName && groupDescription) {
			return true;
		} else {
			return false;
		}

	});// end of submit edit group form

	// edit permission form validation
    $("#editPermissionForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var permName        = $("#epermName").val();
		var permDescription = $("#epermDescription").val();
		
		
		if(permName == "") {
			$("#epermName").after('<p class="text-danger">Please Provide Permission Name.</p>');
			$("#epermName").closest('.form-group').addClass('has-error');
		} else {
			$("#epermName").find('.text-danger').remove();
			$("#epermName").closest('.form-group').addClass('has-success');
		}
		

		if(permDescription == "") {
			$("#epermDescription").after('<p class="text-danger">Please Provive Permission Description.</p>');
			$("#epermDescription").closest('.form-group').addClass('has-error');
		} else {
			$("#epermDescription").find('.text-danger').remove();
			$("#epermDescription").closest('.form-group').addClass('has-success');
		}

		if(permName && permDescription) {
			return true;
		} else {
			return false;
		}

	});// end of submit edit permission form
	
   



    //===================================================================================//
    							//	Clients  // 
    //===================================================================================//


    // add client form validation
    $("#addClientForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var clientName   = $("#clientName").val();
		var clientCode   = $("#clientCode").val();
		var statusCode   = $("#statusCode").val();

		if(clientName == "") {
			$("#clientName").after('<p class="text-danger">Please Provide Client Name.</p>');
			$("#clientName").closest('.form-group').addClass('has-error');
		} else {
			$("#clientName").find('.text-danger').remove();
			$("#clientName").closest('.form-group').addClass('has-success');
		}
		

		if(clientCode == "") {
			$("#clientCode").after('<p class="text-danger">Please Provide Client Code.</p>');
			$("#clientCode").closest('.form-group').addClass('has-error');
		} else {
			$("#clientCode").find('.text-danger').remove();
			$("#clientCode").closest('.form-group').addClass('has-success');
		}

		if(statusCode == "") {
			$("#statusCode").after('<p class="text-danger">Please Choose Client Status.</p>');
			$("#statusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#statusCode").find('.text-danger').remove();
			$("#statusCode").closest('.form-group').addClass('has-success');
		}

		if(clientName && clientCode && statusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit add client form


    // onclick edit client button
	$('.edit-client').click(function(){
        
        // get params on btn edit client click and populate fields on modal
        var clientID = $(this).closest('tr').children('td.clientID').text();
        $('#eclientID').val(clientID);
        
        var clientName = $(this).closest('tr').children('td.clientName').text();
        $('#eclientName').val(clientName);
        
        var status = $(this).closest('tr').children('input.status').val();
        $('#eclientStatus').val(status);
        
        var clientCode = $(this).closest('tr').children('td.clientCode').text();
        $('#eclientCode').val(clientCode);
        
        var date_created = $(this).closest('tr').children('td.date_created').text();
        $('#edate_created').val(date_created);

        var date_modified = $(this).closest('tr').children('td.date_modified').text();
        $('#edate_modified').val(date_modified);

        $("#editClientModal").find("form").attr("action",'/clients/' + clientID);

    });

	// onclick deactivate client button
	$('.deactivate-client').click(function(){
        
        // get params on btn deactivate client click and populate fields on modal
        var clientID = $(this).closest('tr').children('td.clientID').text();
        $('#rclientID').val(clientID);

        $("#deactivateClientModal").find("form").attr("action",'/clients/' + clientID);

    });


     // add client form validation
    $("#editClientForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var eclientName   = $("#eclientName").val();
		var eclientCode   = $("#eclientCode").val();
		var eclientStatus   = $("#eclientStatus").val();

		if(eclientName == "") {
			$("#eclientName").after('<p class="text-danger">Please Provide Client Name.</p>');
			$("#eclientName").closest('.form-group').addClass('has-error');
		} else {
			$("#eclientName").find('.text-danger').remove();
			$("#eclientName").closest('.form-group').addClass('has-success');
		}
		

		if(eclientCode == "") {
			$("#eclientCode").after('<p class="text-danger">Please Provide Client Code.</p>');
			$("#eclientCode").closest('.form-group').addClass('has-error');
		} else {
			$("#eclientCode").find('.text-danger').remove();
			$("#eclientCode").closest('.form-group').addClass('has-success');
		}

		if(eclientStatus == "") {
			$("#eclientStatus").after('<p class="text-danger">Please Choose Client Status.</p>');
			$("#eclientStatus").closest('.form-group').addClass('has-error');
		} else {
			$("#eclientStatus").find('.text-danger').remove();
			$("#eclientStatus").closest('.form-group').addClass('has-success');
		}

		if(eclientName && eclientCode && eclientStatus) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit client form




    //===================================================================================//
    							//	Client Channel  // 
    //===================================================================================//

	 // add client channel form validation
    $("#addClientChannelForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var client          = $("#client").val();
		var clientChannel   = $("#clientChannel").val();
		var clientChannelStatusCode = $("#clientChannelStatusCode").val();
		var clientChannelName = $("#clientChannelName").val();

		if(client == "") {
			$("#client").after('<p class="text-danger">Please Choose Client Name.</p>');
			$("#client").closest('.form-group').addClass('has-error');
		} else {
			$("#client").find('.text-danger').remove();
			$("#client").closest('.form-group').addClass('has-success');
		}
		

		if(clientChannel == "") {
			$("#clientChannel").after('<p class="text-danger">Please Choose Channel.</p>');
			$("#clientChannel").closest('.form-group').addClass('has-error');
		} else {
			$("#clientChannel").find('.text-danger').remove();
			$("#clientChannel").closest('.form-group').addClass('has-success');
		}

		if(clientChannelStatusCode == "") {
			$("#clientChannelStatusCode").after('<p class="text-danger">Please Choose Client Channel Status.</p>');
			$("#clientChannelStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#clientChannelStatusCode").find('.text-danger').remove();
			$("#clientChannelStatusCode").closest('.form-group').addClass('has-success');
		}

		if(clientChannelName == "") {
			$("#clientChannelName").after('<p class="text-danger">Please Provide Client Channel Name.</p>');
			$("#clientChannelName").closest('.form-group').addClass('has-error');
		} else {
			$("#clientChannelName").find('.text-danger').remove();
			$("#clientChannelName").closest('.form-group').addClass('has-success');
		}

		if(client && clientChannel && clientChannelStatusCode && clientChannelName) {
			return true;
		} else {
			return false;
		}
	});// end of submit add client channel form


    // onclick edit client channel button
	$('.edit-client-channel').click(function(){
        
        // get params on btn edit client click and populate fields on modal
        var clientChannelID = $(this).closest('tr').children('td.eclient_channelID').text();
        $('#eclient_channelID').val(clientChannelID);
        
        var client = $(this).closest('tr').children('input.clientID').val();
        $('#eclient').val(client);

        var cchannelID = $(this).closest('tr').children('input.clientChannelChannelID').val();
        $('#cechannelID').val(cchannelID);

        var channelName = $(this).closest('tr').children('td.channelName').text();
        $('#eclientChannelName').val(channelName);
        
        var clientChannel = $(this).closest('tr').children('td.clientChannel').text();
        $('#eclientChannel').val(clientChannel);
        
        var clientChannelStatusCode = $(this).closest('tr').children('input.clientChannelStatusCode').val();
        $('#eclientChannelStatusCode').val(clientChannelStatusCode);
        
        var clientChannelName = $(this).closest('tr').children('td.clientChannelName').text();
        $('#eclientChannelName').val(clientChannelName);
        

        var clientChanneldate_created = $(this).closest('tr').children('td.clientChanneldate_created').text();
        $('#eclientChanneldate_created').val(clientChanneldate_created);

        var clientChanneldate_modified = $(this).closest('tr').children('td.clientChanneldate_modified').text();
        $('#eclientChanneldate_modified').val(clientChanneldate_modified);

        $("#editClientChannelModal").find("form").attr("action",'/client_channel/' + cchannelID);

    });

	// onclick deactivate client channel button
	$('.deactivate-client-channel').click(function(){
        
        // get params on btn deactivate client channel click and populate fields on modal
        var clientChannelID = $(this).closest('tr').children('td.eclient_channelID').text();
        $('#rclientChannelID').val(clientChannelID);

        $("#deactivateClientChannelModal").find("form").attr("action",'/client_channel/' + clientChannelID);

    });


     // edit client channel form validation
    $("#editClientChannelForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var eclient                  = $("#eclient").val();
		var cechannelID              = $("#cechannelID").val();
		var eclientChannelStatusCode = $("#eclientChannelStatusCode").val();
		var eclientChannelName       = $("#eclientChannelName").val();
		var eclientStatus            = $("#eclientStatus").val();

		if(eclient == "") {
			$("#eclient").after('<p class="text-danger">Please Choose Client Name.</p>');
			$("#eclient").closest('.form-group').addClass('has-error');
		} else {
			$("#eclient").find('.text-danger').remove();
			$("#eclient").closest('.form-group').addClass('has-success');
		}
		

		if(cechannelID == "") {
			$("#cechannelID").after('<p class="text-danger">Please Choose Channel.</p>');
			$("#cechannelID").closest('.form-group').addClass('has-error');
		} else {
			$("#cechannelID").find('.text-danger').remove();
			$("#cechannelID").closest('.form-group').addClass('has-success');
		}

		if(eclientChannelStatusCode == "") {
			$("#eclientChannelStatusCode").after('<p class="text-danger">Please Choose Client Channel Status Code.</p>');
			$("#eclientChannelStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#eclientChannelStatusCode").find('.text-danger').remove();
			$("#eclientChannelStatusCode").closest('.form-group').addClass('has-success');
		}

		if(eclientChannelName == "") {
			$("#eclientChannelName").after('<p class="text-danger">Please Provide Client Channel Name.</p>');
			$("#eclientChannelName").closest('.form-group').addClass('has-error');
		} else {
			$("#eclientChannelName").find('.text-danger').remove();
			$("#eclientChannelName").closest('.form-group').addClass('has-success');
		}


		if(eclient && echannelID && eclientChannelStatusCode && eclientChannelName) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit client channel form


    //===================================================================================//
    							//	Status Codes  // 
    //===================================================================================//

	 // add status code form validation
    $("#addStatusCodeForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var code          = $("#code").val();
		var description   = $("#description").val();
	
		if(code == "") {
			$("#code").after('<p class="text-danger">Please Provide Status Code.</p>');
			$("#code").closest('.form-group').addClass('has-error');
		} else {
			$("#code").find('.text-danger').remove();
			$("#code").closest('.form-group').addClass('has-success');
		}
		

		if(description == "") {
			$("#description").after('<p class="text-danger">Please Provide Description.</p>');
			$("#description").closest('.form-group').addClass('has-error');
		} else {
			$("#description").find('.text-danger').remove();
			$("#description").closest('.form-group').addClass('has-success');
		}

	
		if(code && description) {
			return true;
		} else {
			return false;
		}
	});// end of submit add status code form


    // onclick edit status code button
	$('.edit-status-code').click(function(){
        
        // get params on btn edit status code click and populate fields on modal
        var statusCodeID = $(this).closest('tr').children('td.statusCodeID').text();
        $('#estatusCodeID').val(statusCodeID);
        
        var code = $(this).closest('tr').children('td.code').text();
        $('#ecode').val(code);

        var description = $(this).closest('tr').children('td.description').text();
        $('#edescription').val(description);

       

        $("#editStatusCodeModal").find("form").attr("action",'/status_codes/' + statusCodeID);

    });

	// onclick deactivate status code button
	$('.deactivate-status-code').click(function(){
        
        // get params on btn deactivate client channel click and populate fields on modal
        var statusCodeID = $(this).closest('tr').children('td.statusCodeID').text();
        $('#rstatusCodeID').val(statusCodeID);

        $("#deactivateStatusCodeModal").find("form").attr("action",'/status_codes/' + statusCodeID);

    });


     // edit status code form validation
    $("#editStatusCodeForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var code          = $("#ecode").val();
		var description   = $("#edescription").val();
	
		if(code == "") {
			$("#ecode").after('<p class="text-danger">Please Provide Status Code.</p>');
			$("#ecode").closest('.form-group').addClass('has-error');
		} else {
			$("#ecode").find('.text-danger').remove();
			$("#ecode").closest('.form-group').addClass('has-success');
		}
		

		if(description == "") {
			$("#edescription").after('<p class="text-danger">Please Provide Description.</p>');
			$("#edescription").closest('.form-group').addClass('has-error');
		} else {
			$("#edescription").find('.text-danger').remove();
			$("#edescription").closest('.form-group').addClass('has-success');
		}

	
		if(code && description) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit status code form


    //===================================================================================//
    							//	Channels  // 
    //===================================================================================//

	 // add channel form validation
    $("#addChannelForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var channelName       = $("#channelName").val();
		var channelStatusCode = $("#channelStatusCode").val();
		var channelCode = $("#channelCode").val();
	
		if(channelName == "") {
			$("#channelName").after('<p class="text-danger">Please Provide Channel Name.</p>');
			$("#channelName").closest('.form-group').addClass('has-error');
		} else {
			$("#channelName").find('.text-danger').remove();
			$("#channelName").closest('.form-group').addClass('has-success');
		}
		

		if(channelStatusCode == "") {
			$("#channelStatusCode").after('<p class="text-danger">Please Choose Status Code.</p>');
			$("#channelStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#channelStatusCode").find('.text-danger').remove();
			$("#channelStatusCode").closest('.form-group').addClass('has-success');
		}

		if(channelCode == "") {
			$("#channelCode").after('<p class="text-danger">Please Provide Channel Code.</p>');
			$("#channelCode").closest('.form-group').addClass('has-error');
		} else {
			$("#channelCode").find('.text-danger').remove();
			$("#channelCode").closest('.form-group').addClass('has-success');
		}

	
		if(channelName && channelStatusCode && channelCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit add channel form


    // onclick edit channel button
	$('.edit-channel').click(function(){
        
        // get params on btn edit channel click and populate fields on modal
        var channelID = $(this).closest('tr').children('td.channelID').text();
        $('#echannelID').val(channelID);
        
        var channelName = $(this).closest('tr').children('td.channelName').text();
        $('#echannelName').val(channelName);

        var channelStatusCode = $(this).closest('tr').children('input.channelStatusCode').val();
        $('#echannelStatusCode').val(channelStatusCode);

        var channelCode = $(this).closest('tr').children('td.channelCode').text();
        $('#echannelCode').val(channelCode);

       
        $("#editChannelModal").find("form").attr("action",'/channels/' + channelID);

    });

	// onclick deactivate channel button
	$('.deactivate-channel').click(function(){
        
        // get params on btn deactivate channel click and populate fields on modal
        var rchannelID = $(this).closest('tr').children('td.rchannelID').text();
        $('#rchannelID').val(rchannelID);

        $("#deactivateChannelModal").find("form").attr("action",'/channels/' + rchannelID);

    });


     // edit channel form validation
    $("#editChannelModal").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var channelName       = $("#echannelName").val();
		var channelStatusCode = $("#echannelStatusCode").val();
		var channelCode = $("#echannelCode").val();
	
		if(channelName == "") {
			$("#echannelName").after('<p class="text-danger">Please Provide Channel Name.</p>');
			$("#echannelName").closest('.form-group').addClass('has-error');
		} else {
			$("#echannelName").find('.text-danger').remove();
			$("#echannelName").closest('.form-group').addClass('has-success');
		}
		

		if(channelStatusCode == "") {
			$("#echannelStatusCode").after('<p class="text-danger">Please Choose Status Code.</p>');
			$("#echannelStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#echannelStatusCode").find('.text-danger').remove();
			$("#echannelStatusCode").closest('.form-group').addClass('has-success');
		}

		if(channelCode == "") {
			$("#echannelCode").after('<p class="text-danger">Please Provide Channel Code.</p>');
			$("#echannelCode").closest('.form-group').addClass('has-error');
		} else {
			$("#echannelCode").find('.text-danger').remove();
			$("#echannelCode").closest('.form-group').addClass('has-success');
		}

	
		if(channelName && channelStatusCode && channelCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit channel form


	//===================================================================================//
    							//	Channel Rules  // 
    //===================================================================================//

	 // add channel rules form validation
    $("#addChannelRulesForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var ruleName        = $("#ruleName").val();
		var rulesEndpoint   = $("#rulesEndpoint").val();
		var clientChannelID = $("#clientChannelID").val();
	
		if(ruleName == "") {
			$("#ruleName").after('<p class="text-danger">Please Provide Rule Name.</p>');
			$("#ruleName").closest('.form-group').addClass('has-error');
		} else {
			$("#ruleName").find('.text-danger').remove();
			$("#ruleName").closest('.form-group').addClass('has-success');
		}
		

		if(rulesEndpoint == "") {
			$("#rulesEndpoint").after('<p class="text-danger">Please Provive Rule Endpoint.</p>');
			$("#rulesEndpoint").closest('.form-group').addClass('has-error');
		} else {
			$("#rulesEndpoint").find('.text-danger').remove();
			$("#rulesEndpoint").closest('.form-group').addClass('has-success');
		}

		if(clientChannelID == "") {
			$("#clientChannelID").after('<p class="text-danger">Please Provide Client Channel ID.</p>');
			$("#clientChannelID").closest('.form-group').addClass('has-error');
		} else {
			$("#clientChannelID").find('.text-danger').remove();
			$("#clientChannelID").closest('.form-group').addClass('has-success');
		}

	
		if(ruleName && rulesEndpoint && clientChannelID) {
			return true;
		} else {
			return false;
		}
	});// end of submit add channel form


    // onclick edit channel rule button
	$('.edit-channel-rules').click(function(){
        
        // get params on btn edit channel rule click and populate fields on modal
        var channelRulesID = $(this).closest('tr').children('td.channelRulesID').text();
        $('#echannelRulesID').val(channelRulesID);
        
        var ruleName = $(this).closest('tr').children('td.ruleName').text();
        $('#eruleName').val(ruleName);

        var rulesEndpoint = $(this).closest('tr').children('td.rulesEndpoint').text();
        $('#erulesEndpoint').val(rulesEndpoint);

        var clientChannelID = $(this).closest('tr').children('input.clientChannelID').val();
        $('#eclientChannelID').val(clientChannelID);

        
        var channelRuledate_created = $(this).closest('tr').children('td.channelRuledate_created').text();
        $('#echannelRuledate_created').val(channelRuledate_created);

        var channelRuledate_modified = $(this).closest('tr').children('td.channelRuledate_modified').text();
        $('#echannelRuledate_modified').val(channelRuledate_modified);

       
        $("#editChannelRuleModal").find("form").attr("action",'/channel_rules/' + channelRulesID);

    });

	// onclick deactivate channel rule button
	$('.deactivate-channel-rule').click(function(){
        
        // get params on btn deactivate channel rule click and populate fields on modal
        var rchannelRulesID = $(this).closest('tr').children('td.channelRulesID').text();
        $('#rchannelRulesID').val(rchannelRulesID);

        $("#deactivateChannelRulesModal").find("form").attr("action",'/channel_rules/' + rchannelRulesID);

    });


     // edit channel rule form validation
    $("#editChannelRuleForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var ruleName        = $("#eruleName").val();
		var rulesEndpoint   = $("#erulesEndpoint").val();
		var clientChannelID = $("#eclientChannelID").val();
	
		if(ruleName == "") {
			$("#eruleName").after('<p class="text-danger">Please Provide Rule Name.</p>');
			$("#eruleName").closest('.form-group').addClass('has-error');
		} else {
			$("#eruleName").find('.text-danger').remove();
			$("#eruleName").closest('.form-group').addClass('has-success');
		}
		

		if(rulesEndpoint == "") {
			$("#erulesEndpoint").after('<p class="text-danger">Please Provive Rule Endpoint.</p>');
			$("#erulesEndpoint").closest('.form-group').addClass('has-error');
		} else {
			$("#erulesEndpoint").find('.text-danger').remove();
			$("#erulesEndpoint").closest('.form-group').addClass('has-success');
		}

		if(clientChannelID == "") {
			$("#eclientChannelID").after('<p class="text-danger">Please Provide Client Channel ID.</p>');
			$("#eclientChannelID").closest('.form-group').addClass('has-error');
		} else {
			$("#eclientChannelID").find('.text-danger').remove();
			$("#eclientChannelID").closest('.form-group').addClass('has-success');
		}

	
		if(ruleName && rulesEndpoint && clientChannelID) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit channel rule form


    //===================================================================================//
    							//	Notifications Templates  // 
    //===================================================================================//

	 // add message template form validation
    $("#addMessageTemplateForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var messageTemplate     = $("#messageTemplate").val();
		var messageChannelRef   = $("#messageChannelRef").val();
		var messageStatusCode   = $("#messageStatusCode").val();
		
		
		if(messageTemplate == "") {
			$("#messageTemplate").after('<p class="text-danger">Please Provide Message.</p>');
			$("#messageTemplate").closest('.form-group').addClass('has-error');
		} else {
			$("#messageTemplate").find('.text-danger').remove();
			$("#messageTemplate").closest('.form-group').addClass('has-success');
		}
		

		if(messageChannelRef == "") {
			$("#messageChannelRef").after('<p class="text-danger">Please Choose Channel Reference.</p>');
			$("#messageChannelRef").closest('.form-group').addClass('has-error');
		} else {
			$("#messageChannelRef").find('.text-danger').remove();
			$("#messageChannelRef").closest('.form-group').addClass('has-success');
		}

		if(messageStatusCode == "") {
			$("#messageStatusCode").after('<p class="text-danger">Please Choose Status Code.</p>');
			$("#messageStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#messageStatusCode").find('.text-danger').remove();
			$("#messageStatusCode").closest('.form-group').addClass('has-success');
		}

	
		if(messageTemplate && messageChannelRef && messageStatusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit add message template form


    // onclick edit message template button
	$('.edit-message-template').click(function(){
        
        // get params on btn edit user click and populate fields on modal
        var template_id = $(this).closest('tr').children('td.template_id').text();
        $('#etemplate_id').val(template_id);
        
     	var messageTemplate = $(this).closest('tr').children('td.template').text();
        $('#emessageTemplate').val(messageTemplate);

        var notifications_channel_ref_id = $(this).closest('tr').children('input.notifications_channel_ref_id').val();
        $('#emessageChannelRef').val(notifications_channel_ref_id);

        var notifications_status_code_id = $(this).closest('tr').children('input.notifications_status_code_id').val();
        $('#emessageStatusCode').val(notifications_status_code_id);
        
        var notifications_date_created = $(this).closest('tr').children('td.notifications_date_created').text();
        $('#enotifications_date_created').val(notifications_date_created);

        var notifications_date_modified = $(this).closest('tr').children('td.notifications_date_modified').text();
        $('#enotifications_date_modified').val(notifications_date_modified);

       
        $("#editMessageTemplateModal").find("form").attr("action",'/notifications_templates/' + template_id);

    });


     // edit message template form validation
    $("#editMessageTemplateForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var messageTemplate     = $("#emessageTemplate").val();
		var messageChannelRef   = $("#emessageChannelRef").val();
		var messageStatusCode   = $("#emessageStatusCode").val();
		
		
		if(messageTemplate == "") {
			$("#emessageTemplate").after('<p class="text-danger">Please Provide Message.</p>');
			$("#emessageTemplate").closest('.form-group').addClass('has-error');
		} else {
			$("#emessageTemplate").find('.text-danger').remove();
			$("#emessageTemplate").closest('.form-group').addClass('has-success');
		}
		

		if(messageChannelRef == "") {
			$("#emessageChannelRef").after('<p class="text-danger">Please Choose Channel Reference.</p>');
			$("#emessageChannelRef").closest('.form-group').addClass('has-error');
		} else {
			$("#emessageChannelRef").find('.text-danger').remove();
			$("#emessageChannelRef").closest('.form-group').addClass('has-success');
		}

		if(messageStatusCode == "") {
			$("#emessageStatusCode").after('<p class="text-danger">Please Choose Status Code.</p>');
			$("#emessageStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#emessageStatusCode").find('.text-danger').remove();
			$("#emessageStatusCode").closest('.form-group').addClass('has-success');
		}

	
		if(messageTemplate && messageChannelRef && messageStatusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit message template form

	// onclick delete message template button
	$('.delete-message-template').click(function(){
        
        // get params on btn delete message template click and populate fields on modal
        var rtemplate_id = $(this).closest('tr').children('td.template_id').text();
        $('#rtemplate_id').val(rtemplate_id);

        $("#deleteTemplateModal").find("form").attr("action",'/notifications_templates/' + rtemplate_id);

    });


	 //===================================================================================//
    							//	Client Channel Reference  // 
    //===================================================================================//

	 // add client channel reference form validation
    $("#addClientChannelReferenceForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var source        = $("#ccrSource").val();
		var destination   = $("#ccrDestination").val();
		var clientChannel = $("#ccrclientChannelID").val();
		var queueName     = $("#queue_name").val();
		var channelCode   = $("#ccrchannelCode").val();
		var endpoint      = $("#endpoint").val();
		var callback      = $("#callback").val();
		var statusCode    = $("#ccrStatusCode").val();
		
		
		if(source == "") {
			$("#ccrSource").after('<p class="text-danger">Please Choose Source.</p>');
			$("#ccrSource").closest('.form-group').addClass('has-error');
		} else {
			$("#ccrSource").find('.text-danger').remove();
			$("#ccrSource").closest('.form-group').addClass('has-success');
		}
		

		if(destination == "") {
			$("#ccrDestination").after('<p class="text-danger">Please Choose Destination.</p>');
			$("#ccrDestination").closest('.form-group').addClass('has-error');
		} else {
			$("#ccrDestination").find('.text-danger').remove();
			$("#ccrDestination").closest('.form-group').addClass('has-success');
		}

		if(clientChannel == "") {
			$("#ccrclientChannelID").after('<p class="text-danger">Please Choose Client Channel.</p>');
			$("#ccrclientChannelID").closest('.form-group').addClass('has-error');
		} else {
			$("#ccrclientChannelID").find('.text-danger').remove();
			$("#ccrclientChannelID").closest('.form-group').addClass('has-success');
		}

		if(queueName == "") {
			$("#queue_name").after('<p class="text-danger">Please Provide Queue Name.</p>');
			$("#queue_name").closest('.form-group').addClass('has-error');
		} else {
			$("#queue_name").find('.text-danger').remove();
			$("#queue_name").closest('.form-group').addClass('has-success');
		}

		if(channelCode == "") {
			$("#ccrchannelCode").after('<p class="text-danger">Please Provide Channel Code.</p>');
			$("#ccrchannelCode").closest('.form-group').addClass('has-error');
		} else {
			$("#ccrchannelCode").find('.text-danger').remove();
			$("#ccrchannelCode").closest('.form-group').addClass('has-success');
		}

		if(endpoint == "") {
			$("#endpoint").after('<p class="text-danger">Please Provide Endpoint.</p>');
			$("#endpoint").closest('.form-group').addClass('has-error');
		} else {
			$("#endpoint").find('.text-danger').remove();
			$("#endpoint").closest('.form-group').addClass('has-success');
		}

		if(callback == "") {
			$("#callback").after('<p class="text-danger">Please Provide Callback.</p>');
			$("#callback").closest('.form-group').addClass('has-error');
		} else {
			$("#callback").find('.text-danger').remove();
			$("#callback").closest('.form-group').addClass('has-success');
		}

		if(statusCode == "") {
			$("#ccrStatusCode").after('<p class="text-danger">Please Choose Status Code.</p>');
			$("#ccrStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#ccrStatusCode").find('.text-danger').remove();
			$("#ccrStatusCode").closest('.form-group').addClass('has-success');
		}

	
		if(source && destination && clientChannel && queueName && channelCode && endpoint && callback && statusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit add client channel reference form


    // onclick edit client channel reference button
	$('.edit-client-channel-reference').click(function(){
        
        // get params on btn edit client channel reference click and populate fields on modal
        var channel_ref_id = $(this).closest('tr').children('td.channel_ref_id').text();
        $('#echannel_ref_id').val(channel_ref_id);

        var ccrclient_ChannelID = $(this).closest('tr').children('input.ccrclient_ChannelID').val();
        $('#eccrclientChannelID').val(ccrclient_ChannelID);

        var ccrSource = $(this).closest('tr').children('input.ccrclientID').val();
        $('#eccrSource').val(ccrSource);

        var ccrDestination = $(this).closest('tr').children('input.ccrdestinationClientID').val();
        $('#eccrDestination').val(ccrDestination);

         var ccrStatusCode = $(this).closest('tr').children('input.ccrstatusCode').val();
        $('#eccrStatusCode').val(ccrStatusCode);
        
     	var queue_name = $(this).closest('tr').children('td.queue_name').text();
        $('#equeue_name').val(queue_name);

        var ccrchannelCode = $(this).closest('tr').children('td.ccrchannelCode').text();
        $('#eccrchannelCode').val(ccrchannelCode);

        var endpoint = $(this).closest('tr').children('td.endpoint').text();
        $('#eendpoint').val(endpoint);

        var callback = $(this).closest('tr').children('td.callback').text();
        $('#ecallback').val(callback);

        var notifications_date_created = $(this).closest('tr').children('td.notifications_date_created').text();
        $('#enotifications_date_created').val(notifications_date_created);

        var notifications_channel_ref_id = $(this).closest('tr').children('input.notifications_channel_ref_id').val();
        $('#emessageChannelRef').val(notifications_channel_ref_id);

        
        var ccrdate_created = $(this).closest('tr').children('td.ccrdate_created').text();
        $('#eccrdate_created').val(ccrdate_created);

        var ccrdate_modified = $(this).closest('tr').children('td.ccrdate_modified').text();
        $('#eccrdate_modified').val(ccrdate_modified);

       
        $("#editClientChannelReferenceModal").find("form").attr("action",'/client_channel_reference/' + channel_ref_id);

    });


     // edit client channel reference form validation
    $("#editClientChannelReferenceForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var source        = $("#eccrSource").val();
		var destination   = $("#eccrDestination").val();
		var clientChannel = $("#eccrclientChannelID").val();
		var queueName     = $("#equeue_name").val();
		var channelCode   = $("#eccrchannelCode").val();
		var endpoint      = $("#eendpoint").val();
		var callback      = $("#ecallback").val();
		var statusCode    = $("#eccrStatusCode").val();
		
		
		if(source == "") {
			$("#eccrSource").after('<p class="text-danger">Please Choose Source.</p>');
			$("#eccrSource").closest('.form-group').addClass('has-error');
		} else {
			$("#eccrSource").find('.text-danger').remove();
			$("#eccrSource").closest('.form-group').addClass('has-success');
		}
		

		if(destination == "") {
			$("#eccrDestination").after('<p class="text-danger">Please Choose Destination.</p>');
			$("#eccrDestination").closest('.form-group').addClass('has-error');
		} else {
			$("#eccrDestination").find('.text-danger').remove();
			$("#eccrDestination").closest('.form-group').addClass('has-success');
		}

		if(clientChannel == "") {
			$("#eccrclientChannelID").after('<p class="text-danger">Please Choose Client Channel.</p>');
			$("#eccrclientChannelID").closest('.form-group').addClass('has-error');
		} else {
			$("#eccrclientChannelID").find('.text-danger').remove();
			$("#eccrclientChannelID").closest('.form-group').addClass('has-success');
		}

		if(queueName == "") {
			$("#equeue_name").after('<p class="text-danger">Please Provide Queue Name.</p>');
			$("#equeue_name").closest('.form-group').addClass('has-error');
		} else {
			$("#equeue_name").find('.text-danger').remove();
			$("#equeue_name").closest('.form-group').addClass('has-success');
		}

		if(channelCode == "") {
			$("#eccrchannelCode").after('<p class="text-danger">Please Provide Channel Code.</p>');
			$("#eccrchannelCode").closest('.form-group').addClass('has-error');
		} else {
			$("#eccrchannelCode").find('.text-danger').remove();
			$("#eccrchannelCode").closest('.form-group').addClass('has-success');
		}

		if(endpoint == "") {
			$("#eendpoint").after('<p class="text-danger">Please Provide Endpoint.</p>');
			$("#eendpoint").closest('.form-group').addClass('has-error');
		} else {
			$("#eendpoint").find('.text-danger').remove();
			$("#eendpoint").closest('.form-group').addClass('has-success');
		}

		if(callback == "") {
			$("#ecallback").after('<p class="text-danger">Please Provide Callback.</p>');
			$("#ecallback").closest('.form-group').addClass('has-error');
		} else {
			$("#ecallback").find('.text-danger').remove();
			$("#ecallback").closest('.form-group').addClass('has-success');
		}

		if(statusCode == "") {
			$("#eccrStatusCode").after('<p class="text-danger">Please Provide Status Code.</p>');
			$("#eccrStatusCode").closest('.form-group').addClass('has-error');
		} else {
			$("#eccrStatusCode").find('.text-danger').remove();
			$("#eccrStatusCode").closest('.form-group').addClass('has-success');
		}

	
		if(source && destination && clientChannel && queueName && channelCode && endpoint && callback && statusCode) {
			return true;
		} else {
			return false;
		}
	});// end of submit edit client channel reference form

	// onclick deactivate client channel reference template button
	$('.deactivate-client-channel-reference').click(function(){
        
        // get params on btn delete client channel reference  click and populate fields on modal
        var rchannel_ref_id = $(this).closest('tr').children('td.channel_ref_id').text();
        $('#rchannel_ref_id').val(rchannel_ref_id);

        $("#deactivateClientChannelReferenceModal").find("form").attr("action",'/client_channel_reference/' + rchannel_ref_id);

    });

    //===================================================================================//
    							//	Reports  // 
    //===================================================================================//

	// show reports section on click submit
	$("#reportsSearchBtn" ).click(function() {
	  	$("#report-section").find('.reports-section').remove();
	});

	// submit report search form validation
    $("#reportsSearchForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		
		var fromclientID = $("#fromclientID").val();
		var toclientID   = $("#toclientID").val();
		var fromDate     = $("#fromDate").val();
		var toDate       = $("#toDate").val();
		
		
		if(fromclientID == "") {
			$("#fromclientID").after('<p class="text-danger">Please Choose Source Client.</p>');
			$("#fromclientID").closest('.form-group').addClass('has-error');
		} else {
			$("#fromclientID").find('.text-danger').remove();
			$("#fromclientID").closest('.form-group').addClass('has-success');
		}

		if(toclientID == "") {
			$("#toclientID").after('<p class="text-danger">Please Choose Source Client.</p>');
			$("#toclientID").closest('.form-group').addClass('has-error');
		} else {
			$("#toclientID").find('.text-danger').remove();
			$("#toclientID").closest('.form-group').addClass('has-success');
		}

		if(fromDate == "") {
			$("#fromDate").after('<p class="text-danger">Please Choose From Date.</p>');
			$("#fromDate").closest('.form-group').addClass('has-error');
		} else {
			$("#fromDate").find('.text-danger').remove();
			$("#fromDate").closest('.form-group').addClass('has-success');
		}

		if(toDate == "") {
			$("#toDate").after('<p class="text-danger">Please Choose To Date.</p>');
			$("#toDate").closest('.form-group').addClass('has-error');
		} else {
			$("#toDate").find('.text-danger').remove();
			$("#toDate").closest('.form-group').addClass('has-success');
		}
		
		
	
		if(fromclientID) {
			if(fromclientID == toclientID) {
				$("#toclientID").after('<p class="text-danger">Please Choose Different Client.</p>');
				$("#toclientID").closest('.form-group').addClass('has-error');
				return false;
			} else {
				$("#toclientID").find('.text-danger').remove();
				$("#toclientID").closest('.form-group').addClass('has-success');
				return true;
			}
			return true;
		} else {
			return false;
		}
	});// end of submit search report form

	//===================================================================================//
    							//	Payments  // 
    //===================================================================================//


	// submit payments search form validation
    $("#paymentSearchForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		

		var paymentFromClientID = $("#paymentFromClientID").val();
		var paymentToClientID   = $("#paymentToClientID").val();
		var sourceAccount       = $("#sourceAccount").val();
		var refNo               = $("#refNo").val();
		var paymentFromDate     = $("#paymentFromDate").val();
		var paymentToDate       = $("#paymentToDate").val();

		
		if(paymentFromClientID == "") {
			$("#paymentFromClientID").after('<p class="text-danger">Please Choose Source Client.</p>');
			$("#paymentFromClientID").closest('.form-group').addClass('has-error');
		} else {
			$("#paymentFromClientID").find('.text-danger').remove();
			$("#paymentFromClientID").closest('.form-group').addClass('has-success');
		}

		if(paymentToClientID == "") {
			$("#paymentToClientID").after('<p class="text-danger">Please Choose Destination Client.</p>');
			$("#paymentToClientID").closest('.form-group').addClass('has-error');
		} else {
			$("#paymentToClientID").find('.text-danger').remove();
			$("#paymentToClientID").closest('.form-group').addClass('has-success');
		}

		if(refNo == "") {
			$("#refNo").after('<p class="text-danger">Please Provide Ref No.</p>');
			$("#refNo").closest('.form-group').addClass('has-error');
		} else {
			$("#refNo").find('.text-danger').remove();
			$("#refNo").closest('.form-group').addClass('has-success');
		}
		
		if(sourceAccount == "") {
			$("#sourceAccount").after('<p class="text-danger">Please Choose Source Account.</p>');
			$("#sourceAccount").closest('.form-group').addClass('has-error');
		} else {
			$("#sourceAccount").find('.text-danger').remove();
			$("#sourceAccount").closest('.form-group').addClass('has-success');
		}

		if(paymentFromDate == "") {
			$("#paymentFromDate").after('<p class="text-danger">Please Choose From Date.</p>');
			$("#paymentFromDate").closest('.form-group').addClass('has-error');
		} else {
			$("#paymentFromDate").find('.text-danger').remove();
			$("#paymentFromDate").closest('.form-group').addClass('has-success');
		}

		if(paymentToDate == "") {
			$("#paymentToDate").after('<p class="text-danger">Please Choose To Date.</p>');
			$("#paymentToDate").closest('.form-group').addClass('has-error');
		} else {
			$("#paymentToDate").find('.text-danger').remove();
			$("#paymentToDate").closest('.form-group').addClass('has-success');
		}
		
		
	
		if(paymentFromClientID) {
			if(paymentFromClientID == paymentToClientID) {
				$("#paymentToClientID").after('<p class="text-danger">Please Choose Different Client.</p>');
				$("#paymentToClientID").closest('.form-group').addClass('has-error');
				return false;
			} else {
				$("#paymentToClientID").find('.text-danger').remove();
				$("#paymentToClientID").closest('.form-group').addClass('has-success');
				return true;
			}
			return true;
		} else {
			return false;
		}
	});// end of submit search payment form

	//===================================================================================//
    							//	Change Password  // 
    //===================================================================================//


	// change password form validation
    $("#changePasswordForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		

		var currentPassword = $("#currentPassword").val();
		var newPassword     = $("#newPassword").val();
		var confirmPassword = $("#confirmPassword").val();
		

		
		if(currentPassword == "") {
			$("#currentPassword").after('<p class="text-danger">Please Enter Current Password</p>');
			$("#currentPassword").closest('.form-group').addClass('has-error');
		} else {
			$("#currentPassword").find('.text-danger').remove();
			$("#currentPassword").closest('.form-group').addClass('has-success');
		}

		if(newPassword == "") {
			$("#newPassword").after('<p class="text-danger">Please Enter New Password.</p>');
			$("#newPassword").closest('.form-group').addClass('has-error');
		} else {
			$("#newPassword").find('.text-danger').remove();
			$("#newPassword").closest('.form-group').addClass('has-success');
		}
		
		if(confirmPassword == "") {
			$("#confirmPassword").after('<p class="text-danger">Please Confirm Your Password.</p>');
			$("#confirmPassword").closest('.form-group').addClass('has-error');
		} else {
			$("#confirmPassword").find('.text-danger').remove();
			$("#confirmPassword").closest('.form-group').addClass('has-success');
		}
				
		if(currentPassword && newPassword && confirmPassword) {
			if(newPassword != confirmPassword) {
				$("#confirmPassword").after('<p class="text-danger">New passwords do not match.</p>');
				$("#confirmPassword").closest('.form-group').addClass('has-error');
				return false;
			} else {
				$("#confirmPassword").find('.text-danger').remove();
				$("#confirmPassword").closest('.form-group').addClass('has-success');
				return true;
			}
			return true;
		} else {
			return false;
		}
	});// end of submit change password form


});
