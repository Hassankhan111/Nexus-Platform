@extends('layout.main')
@section('title', 'messages Dashboard');
@section('main-content')

<div class="container">
    <div class="bg-white rounded shadow-sm border p-4 overflow: hidden;">

        <!-- ############ IF THERE ARE MESSAGES ############ -->
        <!-- Replace static items with backend loop if needed -->
        <ul class="list-group overflow-auto">
            <li class="list-group-item d-flex align-items-center">
                <img src="https://via.placeholder.com/50"
                     class="rounded-circle me-3" width="50" height="50">

                <div>
                    <strong>John Carter</strong><br>
                    <small class="text-muted">Hello, are we still on for tomorrow?</small>
                </div>
            </li>

            <li class="list-group-item d-flex align-items-center">
               <!-- <img src="https://via.placeholder.com/50"
                     class="rounded-circle me-3" width="50" height="50">

                <div>
                    <strong>Sarah Khan</strong><br>
                    <small class="text-muted">Please share the final document</small>
                </div>-->
            </li>
        </ul>


        <!-- ############ SHOW THIS WHEN NO MESSAGES ######### -->
        <!-- Remove above list-group and show only this block -->
        <div class="h-100 d-flex flex-column justify-content-center 
                    align-items-center text-center">
            <div class="bg-light p-4 rounded-circle mb-3">
                <i class="bi bi-chat text-secondary fs-3"></i>
            </div>

            <h4>No messages yet</h4>
            <p class="text-muted mt-2">
                Start connecting with entrepreneurs and investors to begin conversations
            </p>
        </div>

    </div>
</div>


@endsection