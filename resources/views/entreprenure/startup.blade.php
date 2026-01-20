@extends('layout.main')

@section('title', 'Invester Profile')

@section('main-content')

    <!-- Welcome Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 m-4">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold">Find Startup</h2>
            <p class="text-muted mb-0">Connect with Startup who match your startup's needs</p>
        </div>
    </div>
    <div class="container py-4">
        <!-- 🔍 Search + Icons Right -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input class="form-control w-75" type="search" id="startup_search"
                placeholder="Search investors by name, interests or keywords...">
            <span class="text-muted small ms-3">3 results</span>
        </div>
        <div class="row g-4">
            <!-- 🎯 FILTERS SECTION -->
            <div class="col-md-3">
                <div class="filter-box">
                    <h5 class="fw-bold mb-3">Filters</h5>

                    <p class="fw-semibold mb-1">Investment Stage</p>
                    <ul class="list-unstyled small mb-3">
                        <li>Seed</li>
                        <li>Series A</li>
                        <li>Series B</li>
                    </ul>

                    <p class="fw-semibold mb-1">Investment Interests</p>
                    <div class="d-flex flex-wrap gap-1 mb-3">
                        <span class="badge-soft">FinTech</span>
                        <span class="badge-soft">SaaS</span>
                        <span class="badge-soft">AI/ML</span>
                        <span class="badge-soft">CleanTech</span>
                        <span class="badge-soft">AgTech</span>
                        <span class="badge-soft">BioTech</span>
                        <span class="badge-soft">MedTech</span>
                    </div>

                    <p class="fw-semibold mb-1">Location</p>
                    <ul class="list-unstyled small">
                        <li>📍 San Francisco</li>
                        <li>📍 New York</li>
                        <li>📍 Boston</li>
                    </ul>
                </div>
            </div>
            <!-- 🟦 INVESTORS LIST -->
            <div class="col-md-9" style="overflow: hidden;">
                <div class="row g-4" id="card-row">
                    <!-- CARD 1 -->
                </div>
            </div>
            <div class="col-md-9" id="cardrow" style="overflow: hidden;">
                <div class="row g-4" id="cardrow">
                    <!-- serach carf------>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<!-- Main page logic for all startup to show in cards-->
 <script src="{{ asset('assets/js/dashboard.js') }}"></script>
 @endpush