@extends('layouts.master')
@section('content')

@if(Session::has('flash_message'))
    <p class="alert alert-success" id="successMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></p>
@endif
@if(Session::has('error_message'))
    <p class="alert alert-danger" id="errorMessage"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error_message') !!}</em></p>
@endif
<br>
<div class="row">
    <div class="col-md-6 pull-left">
    </div>
    <div class="col-md-6 pull right">
        <form class="form-horizontal" action="/notifications/search" method="post">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text"  name="notificationSearch" class="form-control" placeholder="Just Search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="col-md-1"></div>
                <div class=" col-md-5 form-group">
                    <input type="submit" name="notificationSearch" class="btn btn-info" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTables -->
<table class="table table-responsive table-bordered table-stripped notifications-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Request Log ID</th>
            <th>Sender ID</th>
            <th>Receiver</th>
            <th>Message</th>
            <th>Date Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td class="message_id">{{ $notification->message_id }}</td>
                <td class="requestLogID">{{ $notification->requestLogID }}</td>
                <td class="senderid">{{ $notification->senderid }}</td>
                <td class="receiver">{{ $notification->receiver }}</td>
                <td class="message">{{ $notification->message }}</td>
                <td class="date_created">{{ $notification->date_created }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- pagination -->
{{ $notifications->links() }}

@stop