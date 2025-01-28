@extends('frontend.master')
@section('title', 'notification')
@section('notification-status', 'active')
@section('content')
    <br>
    <div class="dashboard container">
        @include('frontend.dashboard.sidebar')
        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('frontend.dashboard.notification.delete-all') }}" style="margin-left: 270px"
                            class="btn btn-sm btn-danger">Delete All</a>
                    </div>
                </div>

                @forelse (Auth::user()->unreadNotifications as $notify)
                    <a href="javascript:void(0)">
                        <div class="notification alert alert-info">
                            <strong>You have a notification on post:</strong> {{ $notify->data['post_title'] }}
                            <div class="float-right">
                                <button
                                    onclick="if(confirm('Are You Sure You Want To Delete This Notification ?')){document.getElementById('deleteNotification_{{ $notify->id }}').submit()} return false"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </a>
                    <form id="deleteNotification_{{ $notify->id }}"
                        action="{{ route('frontend.dashboard.notification.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
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
    </div><br>
@endsection
