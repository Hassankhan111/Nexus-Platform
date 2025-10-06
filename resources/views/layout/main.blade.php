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

  @push('scripts')

  @endpush

</body>

</html>