@extends('layout.main')
@section('title','entreprenure/dashboard')

@section('main-content')

    <!-- Welcome Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 m-4">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold">Welcome, Michael Rodriguez</h2>
            <p class="text-muted mb-0">Here's what's happening with your startup today</p>
        </div>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Find Investors
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4 px-4">
        @php
            $stats = [
                ['Pending Requests', 4, 'primary', 'fa-bell'],
                ['Total Connections', 4, 'success', 'fa-users'],
                ['Upcoming Meetings', 0, 'warning', 'fa-calendar-alt'],
                ['Profile Views', 0, 'info', 'fa-eye']
            ];
        @endphp

        @foreach($stats as $st)
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="p-3 rounded-circle bg-{{ $st[2] }} bg-opacity-25 me-3">
                            <i class="fas {{ $st[3] }} fa-2x text-{{ $st[2] }}"></i>
                        </div>
                        <div>
                            <p class="mb-1 fw-semibold text-{{ $st[2] }}">{{ $st[0] }}</p>
                            <h5 class="mb-0 fw-bold">{{ $st[1] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4 px-4">

        <!-- Collaboration Requests -->
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold">Collaboration Requests</h6>
                    <span class="badge bg-primary">0 pending</span>
                </div>
                <div class="card-body text-center text-muted py-5">
                    <i class="fas fa-info-circle fs-2 mb-3"></i>
                    <p class="mb-1 fw-semibold">No collaboration requests yet</p>
                    <small>Requests will appear when investors show interest in your startup.</small>
                </div>
            </div>
        </div>

        <!-- Recommended Investors -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 investor-container" style="overflow: hidden;">
                <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom">
                    <h6 class="fw-semibold mb-0">Recommended Investors</h6>
                    <a href="#" class="small fw-semibold text-decoration-none">View all</a>
                </div>
                <div class="container mt-3 mx-3" id="card_row"  style="width:700px;">
                    <!---------card investor----->
                </div>
            </div>
        </div>
    </div>
    @endsection


@push('scripts')
<!-- Main page logic for all startup and show in card or dashboard-->
 <script src="{{ asset('assets/js/dashboard.js') }}"></script>
 @endpush