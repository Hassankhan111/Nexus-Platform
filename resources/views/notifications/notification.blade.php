@extends('layout.main')
@section('title', 'notification');
@section('main-content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Notifications</h2>
            <p class="text-muted">Stay updated with your network activity</p>
        </div>

        <button id="markasred" class="btn btn-outline-primary btn-sm">Mark all as read</button>
    </div>

    <!-- ===== NOTIFICATION ITEM 1 (Unread) ===== -->
    <div class="card mb-3" id="new-notification">
        <div class="card-body d-flex">
            <!-- User Avatar -->
        </div>
    </div>

</div>

@endsection

@push('scripts')
  <!-- Main page logic for notification -->
 <script src="{{ asset('assets/js/notification.js') }}"></script>
@endpush