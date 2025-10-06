@extends('layout.main')

@section('main-content')

<style>
  body {
    background-color: #f4f6f9;
  }

  .profile-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease-in-out;
  }

  .profile-card:hover {
    transform: translateY(-3px);
  }

  .profile-header {
    background: linear-gradient(135deg, #007bff, #6610f2);
    color: #fff;
    padding: 2rem;
    text-align: center;
    position: relative;
  }

  .profile-header img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid #fff;
    object-fit: cover;
    position: absolute;
    bottom: -60px;
    left: 50%;
    transform: translateX(-50%);
  }

  .profile-body {
    padding: 4rem 2rem 2rem;
  }

  .data-label {
    color: #6c757d;
    font-weight: 500;
    font-size: 0.9rem;
  }

  .data-value {
    font-weight: 600;
    color: #212529;
    font-size: 1rem;
  }

  .summary-card {
    background: #f8f9fa;
    border-left: 4px solid #0d6efd;
    border-radius: 10px;
    padding: 1rem;
  }

  .badge-custom {
    background-color: #e7f1ff;
    color: #0d6efd;
    font-weight: 600;
  }

  .btn-action {
    border-radius: 50px;
    font-weight: 500;
    padding: 0.5rem 1.2rem;
  }
</style>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="profile-card">

        <!-- Profile Header -->
        <div class="profile-header">
          <h3 class="fw-bold mb-0" id="inv_name">Khan Mohammad</h3>
          <p class="text-light mb-1" id="company">Home Work Ltd.</p>
          <span class="badge badge-custom" id="inv_industry">FinTech</span>
          <img id="inv_image" src="https://via.placeholder.com/150" alt="Investor Image">
        </div>

        <!-- Profile Body -->
        <div class="profile-body">

          <div class="row mb-4">
            <div class="col-md-6">
              <p class="data-label mb-1">📍 Location</p>
              <p class="data-value" id="inv_location">Peshawar, Pakistan</p>
            </div>
            <div class="col-md-6">
              <p class="data-label mb-1">🏢 Company</p>
              <p class="data-value" id="company_name">Home Work Ltd.</p>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <p class="data-label mb-1">👥 Team Size</p>
              <p class="data-value" id="inv_teamsize">12</p>
            </div>
            <div class="col-md-6">
              <p class="data-label mb-1">💰 Funding Needed</p>
              <p class="data-value" id="funding_ned">$150,000</p>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <p class="data-label mb-1">📅 Founded Year</p>
              <p class="data-value" id="year">2021</p>
            </div>
            <div class="col-md-6">
              <p class="data-label mb-1">📊 Industry</p>
              <p class="data-value" id="industry">Technology</p>
            </div>
          </div>

          <div class="summary-card mb-4">
            <h6 class="fw-bold mb-2">Investment Pitch Summary</h6>
            <p class="text-muted mb-0" id="pitch_summ">
              We are building a data-driven AI platform connecting startups with investors for smart funding opportunities.
            </p>
          </div>

          <div class="text-center">
            <button class="btn btn-primary btn-action me-2"><i class="bi bi-pencil-square"></i> Edit</button>
            <button class="btn btn-outline-secondary btn-action"><i class="bi bi-arrow-left-circle"></i> Back</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", async function() {
  const token = localStorage.getItem("api_token");
  if (!token) {
    window.location.href = "/";
    return;
  }

  try {
    const response = await fetch("/api/investor/show", {
      method: "GET",
      headers: { "Authorization": "Bearer " + token }
    });
    const data = await response.json();

    if (data.status && data.investor) {
      const inv = data.investor;
      document.getElementById("inv_name").innerText = inv.inv_name || '—';
      document.getElementById("company").innerText = inv.company || '—';
      document.getElementById("inv_location").innerText = inv.inv_location || '—';
      document.getElementById("industry").innerText = inv.inv_industry || '—';
      document.getElementById("year").innerText = inv.year || '—';
      document.getElementById("inv_teamsize").innerText = inv.inv_teamsize || '—';
      document.getElementById("funding_ned").innerText = inv.funding_ned ? `$${inv.funding_ned}` : '—';
      document.getElementById("pitch_summ").innerText = inv.pitch_summ || '';
      document.getElementById("inv_image").src = inv.inv_image
        ? `/storage/${inv.inv_image}`
        : "https://via.placeholder.com/150";
    }
  } catch (error) {
    console.error("Error loading investor:", error);
  }
});
</script>
@endpush

@endsection
