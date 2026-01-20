<html>

@include('layout.header')

  <!-- Main Layout -->
  <div class="container-fluid" style="padding-top:60px;">
    <div class="row">
      <!-- Sidebar -->
      @include('layout.sidebar')

      <!-- Page Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('main-content')
      </main>
    </div>
  </div>

  

 <!-- Bootstrap bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!--boostrap js -->
<script src="{{ asset('assets/js/javascript/bootstrap.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.main.js') }}"></script>

<!-- Auth related (profile, token checks) -->
<script src="{{ asset('assets/js/Auth.js') }}"></script>

<!-- Layout helpers (sidebar toggle, DOM manipulations) -->
<script src="{{ asset('assets/js/layout.js') }}"></script>


<!-- Main page logic for pyment-->
 <script src="{{ asset('assets/js/billing.js') }}"></script>

  <!-- this the stack script code extended in every page --->
  @stack('scripts')

 </body>
</html>