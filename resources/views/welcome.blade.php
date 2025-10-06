<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/logo.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Business Nexus - Connect Entrepreneurs & Investors</title>
    <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional: Your custom CSS -->
      <link rel="stylesheet" href="styles.css">
      <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
      <link rel="stylesheet" href="{{ asset('assets/css/style.ss') }}">
  </head>
  <body>
    <!-- Example Bootstrap Content -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
          Business Nexus
        </a>
      </div>
    </nav>

    <div class="container mt-5">
      <h1>Connect Entrepreneurs & Investors</h1>
      <p class="lead">Welcome to Business Nexus! Join our platform to connect, collaborate, and grow your business network.</p>

      <!-- Example Bootstrap Button with jQuery -->
      <button id="alertBtn" class="btn btn-primary">Click me</button>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
      // Example jQuery
      $(document).ready(function() {
        $('#alertBtn').click(function() {
          alert('Hello from Business Nexus!');
        });
      });
    </script>
  </body>
</html>