@extends('layout.main')
@section('title','profile')

@section('main-content')
<div class="container-fluid py-4">
      <!-- Header -->
      <div class="mb-4">
        <h1 class="h3 fw-bold">Find Entreprenure</h1>
        <p class="text-muted">Connect with entreprenure who match your startup's needs</p>
      </div>
      <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
          <div class="card shadow-sm p-3">
            <h5 class="mb-3">Filters</h5>
            <div class="filter-section">
              <h6>Industry</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="filter-link">FinTech</a></li>
                <li><a href="#" class="filter-link">CleanTech</a></li>
                <li><a href="#" class="filter-link">HealthTech</a></li>
                <li><a href="#" class="filter-link">AgTech</a></li>
              </ul>
            </div>
            <div class="filter-section">
              <h6>Funding Range</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="filter-link">&lt; $500K</a></li>
                <li><a href="#" class="filter-link">$500K - $1M</a></li>
                <li><a href="#" class="filter-link">$1M - $5M</a></li>
                <li><a href="#" class="filter-link">&gt; $5M</a></li>
              </ul>
            </div>
            <div class="filter-section">
              <h6>Location</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="filter-link">San Francisco, CA</a></li>
                <li><a href="#" class="filter-link">New York, NY</a></li>
                <li><a href="#" class="filter-link">Boston, MA</a></li>
                <li><a href="#" class="filter-link">Chicago, IL</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="d-flex align-items-center mb-3">
            <input type="text" id="entreprnure_search" class="form-control me-3" placeholder="Search startups by name, industry, or keywords...">
            <span class="entreprenure_data text-muted">4 results</span>
          </div>

          <div id="startup_profile" class="row g-3">
            <!-- Startup Card -->
           
          </div>
        </div>

      </div>
    </div>
@endsection
