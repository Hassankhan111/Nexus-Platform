@extends('layout.main')
@section('title','investor')
@section('main-content')
  <div class="container py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
      <div>
        <h1 class="h3 fw-bold">Discover Startups</h1>
        <p class="text-muted">Find and connect with promising entrepreneurs</p>
      </div>
      <a href="#" class="btn btn-primary">
        <i class="fas fa-plus-circle me-2"></i> View All Startups
      </a>
    </div>
    <!-- Search & Filters -->
    <div class="row g-3 mb-4">
      <div class="col-md-8">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
          <input type="text" class="form-control" id="startup_search"
            placeholder="Search startups, industries, or keywords...">
        </div>
      </div>
      <div class="col-md-4">
        <div class="d-flex align-items-center">
          <i class="fas fa-filter text-secondary me-2"></i>
          <span class="me-2 small fw-semibold text-secondary">Filter by:</span>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-primary">FinTech</span>
            <span class="badge bg-secondary">CleanTech</span>
            <span class="badge bg-success">HealthTech</span>
            <span class="badge bg-warning text-dark">AgTech</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <div class="card border-primary">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-primary bg-opacity-25 rounded-circle me-3">
              <i class="fas fa-users text-primary"></i>
            </div>
            <div>
              <p class="mb-1 small fw-semibold text-primary">Total Startups</p>
              <h5 class="mb-0 fw-bold">4</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-success">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-success bg-opacity-25 rounded-circle me-3">
              <i class="fas fa-chart-pie text-success"></i>
            </div>
            <div>
              <p class="mb-1 small fw-semibold text-success">Industries</p>
              <h5 class="mb-0 fw-bold">4</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-warning">
          <div class="card-body d-flex align-items-center">
            <div class="p-3 bg-warning bg-opacity-25 rounded-circle me-3">
              <i class="fas fa-handshake text-warning"></i>
            </div>
            <div>
              <p class="mb-1 small fw-semibold text-warning">Your Connections</p>
              <h5 class="mb-0 fw-bold">0</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Featured Startups -->
    <div class="row g-3 mb-4">
      <!-- 🟦 INVESTORS LIST -->
      <div class="col-md-12" style="overflow: hidden;">
        <div class="row g-4" id="card-row">
          <!-- CARD 1 -->
        </div>
      </div>
      <div class="col-md-12" style="overflow: hidden;">
        <div class="row g-4" id="cardrow">
          <!-- CARD 1 -->
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<!-- Main page logic for all investor show in card and dashboard-->
 <script src="{{ asset('assets/js/dashboard.js') }}"></script>
 @endpush