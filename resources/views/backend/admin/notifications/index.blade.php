@extends('backend.admin.master')
@section('title', 'Notifications')
@section('content')
<div class="dashboard container">
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h2 class="mb-4">Notifications</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('admin.notifications.delete-all') }}" class="btn btn-sm btn-danger">Delete All</a>
                    <a href="{{ route('admin.notifications.mark-all-as-read') }}" class="btn btn-sm btn-success">Mark All as Read</a>
                </div>
            </div>

            @forelse ($notifications as $notify)
                <div class="notification alert alert-info d-flex justify-content-between align-items-center">
                    <div>
                        <strong>You Have A Notification From Contact:</strong> {{ $notify->data['contact_name'] }}
                        <small><strong class="text-danger">({{ $notify->created_at->diffForHumans() }})</strong></small>
                    </div>
                    <div>
                        <a href="javascript:void(0)" id="markAsRead_{{ $notify->id }}" onclick="document.getElementById('markNotificationAsRreadForm_{{ $notify->id }}').submit();return false;"
                            class="btn btn-sm btn-warning">Mark As Read
                        </a> 
                         
                        <a href="javascript:void(0)" data-target="#deleteModal_{{ $notify->id }}" data-toggle="modal"
                            class="btn btn-sm btn-danger">Delete
                        </a>
                    </div>
                </div>
                <!-- Delete Modal for Individual Notification -->
                <x-delete-modal title="Delete Notification!" message="Are You Sure You Want To Delete This Notification?" id="{{ $notify->id }}" formId="deleteNotification_"></x-delete-modal>
                
                <!-- Delete Form for Individual Notification -->
                <form id="deleteNotification_{{ $notify->id }}"
                    action="{{ route('admin.notifications.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="notification_id" value="{{ $notify->id }}">
                </form>

                <!-- Mark Notification As Read -->
                <form id="markNotificationAsRreadForm_{{ $notify->id }}" action="{{ route('admin.notifications.mark-as-read') }}" method="POST">
                   @csrf
                   <input type="hidden" name="notification_id" value="{{ $notify->id }}">
                </form>
            @empty
                <div class="alert alert-info">
                    There Are No Notifications
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Delete All Modal -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllModalLabel">Delete All Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Are You Sure You Want To Delete All Notifications?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <!-- Mark All as Read Form -->
<form id="markAllAsReadForm" action="{{ route('admin.notifications.mark-all-as-read') }}" method="POST" style="display: none;">
    @csrf
</form> --}}

@endsection